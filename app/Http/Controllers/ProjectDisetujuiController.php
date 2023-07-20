<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Fitur;
use App\Models\Proreq;
use App\Models\Sosmed;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\ProjectDisetujui;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ProjectDisetujuiController extends Controller
{
    public function disetujui(Request $request) {
        if ($request->ajax()) {
            $data = Proreq::latest()->get();
            return Datatables::of($data)->make(true);
        }
    
        $admin = User::where('role', 'admin')->first();
        $keyword = $request->searchKeyword;
        $notification = Notification::where('role', 'admin')->limit(4)->latest()->get();
        $project = proreq::where('status','setuju')->where('napro', 'LIKE', '%'.$keyword.'%')->paginate(3);
        return view('Admin.project-disetujui', [
            'project' => $project,
            'admin' => $admin,
            'notification' => $notification
        ]);
    }
        

    public function detailDisetujui($id)
    {
        $notification = Notification::where('role', 'admin')->limit(4)->latest()->get();
        $admin = User::where('role', 'admin')->first();
        $detail = Proreq::find($id);
        $fitur = Fitur::where('project_id', $id)->get();
        $done = Fitur::where('project_id', $id)->where('status', 'selesai')->count();
        $progress = 0;
    
        if ($fitur->count() > 0) {
            $progress = (100 / $fitur->count()) * $done;
        }
    
        $chats = Chat::where('project_id', $id)->get();
    
        return view('Admin.detail-project-disetujui', [
            'detail' => $detail,
            'progress' => $progress,
            'fitur' => $fitur,
            'chats' => $chats,
            'done' => $done,
            'admin' => $admin,
            'notification' => $notification,
            'id' => $id
        ]);
    }    

    public function updateProgressrange(Request $request)
    {
        $id = $request->input('featureId');
        $progress = $request->input('progress');
        $proreq = Proreq::where('id', $id)->first();
    
        if (!$proreq) {
            return response()->json(['message' => 'Proreq tidak ditemukan'], 404);
        }
    
        // Update progress pada proreq
        $proreq->progress = $progress;
        $proreq->save();
    
        return response()->json(['message' => 'Progress berhasil diperbarui'], 200);
    }  

       

    public function updateStatusFitur($id, Request $request)
{
      
     $feature = Fitur::findOrFail($id);

    $feature->status = $request->input('status', 'belum selesai');
    $feature->save();

    return response()->json(['message' => 'Status fitur berhasil diperbarui.']);
}



    public function updateProgress($id) {
        $fitur = Fitur::where('project_id', $id)->get();
        $done = Fitur::where('project_id', $id)->where('status', 'selesai')->count();
        $progress = (100 / count($fitur)) * $done;
        return response()->json(['progress' => $progress]);
    }

    public function statusFitur(Request $request) {
        $status = Fitur::find($request->fitur_id);
        $status->update([
            'status' => $request->status
        ]);
    }

    public function allStatusFitur(Request $request) {
        $status = Fitur::where('project_id', $request->project_id);
        $status->update([
            'status' => $request->status
        ]);
    }

    public function upEstimasi(Request $request) {
        $pro = Proreq::find($request->project_id);
        $pro->update([
            'estimasi' => $request->estimasi
        ]);
        return back();
    }

    public function doneProject(Request $request) {
        $pro = Proreq::find($request->project_id);
        $rev = $pro->pluck('tanggalpembayaran3')->first();
        if ($rev == null) {
            $pro->update([
                'status' => null,
                'statusbayar' => 'belum lunas'
            ]);
            $msg = 'Project Selesai';
            $notifDesk = $pro->napro.' telah selesai';
            Notification::create([
                'role' => 'client',
                'user_id' => $pro->user_id,
                'notif' => $msg,
                'deskripsi' => $notifDesk,
                'kategori' => 'Project Selesai'
            ]);
        } else {
            $pro->update([
                'status' => null,
                'statusbayar' => 'belum lunas'
            ]);
            $msg = 'Revisi Project Selesai';
            $notifDesk = $pro->napro.' telah selesai';
            Notification::create([
                'role' => 'client',
                'user_id' => $pro->user_id,
                'notif' => $msg,
                'deskripsi' => $notifDesk,
                'kategori' => 'Revisi Project Selesai'
            ]);
        }
        return redirect(route('project-disetujui-admin'))->with('success', 'Berhasil menyelesaikan project');
    }

    public function projectChat(Request $request) {
        $id = $request->input('project_id');
        Chat::create([
            'user_id' => Auth()->user()->id,
            'project_id' => $request->project_id,
            'chat' => $request->chat,
            'chat_time' => $request->chat_time
        ]);
        return back();
    }

    public function disetujuiClient() {
        $client = User::find(Auth::user()->id);
        $notification = Notification::where('role', 'client')->where('user_id', Auth::user()->id)->limit(4)->latest()->get();
        $sosmed = Sosmed::all();;
        $project = Proreq::where('status', 'setuju')->where('user_id', Auth::user()->id)->paginate(5);
        return view('Client.disetujui', compact('project', 'sosmed','client','notification'));
    }
    

    public function detailDisetujuiClient($id) {
        $client = User::find(Auth::user()->id);
        $notification = Notification::where('role', 'client')->where('user_id', Auth::user()->id)->limit(4)->latest()->get();
        $detail = Proreq::find($id);
        $fitur = Fitur::where('project_id', $id)->get();
        $done = Fitur::where('project_id', $id)->where('status', 'selesai')->count();
        $progress = 0;
        if (count($fitur) > 0) {
        $progress = (100 / count($fitur)) * $done;
    }          
        $chats = Chat::where('project_id', $id)->get();
        $sosmed = Sosmed::all();
        return view('Client.detailsetujui',
        [
            'userid' => Auth()->user()->id,
            'detail' => $detail,
            'progress' => $progress,
            'fitur' => $fitur,
            'chats' => $chats,
            'sosmed' => $sosmed,
            'client' =>$client,
            'notification' => $notification
        ]);
    }

    public function projectChatClient(Request $request) {
        $projectid = $request->input('project_id');
        Chat::create([
            'user_id' => Auth()->user()->id,
            'project_id' => $projectid,
            'chat' => $request->chat,
            'chat_time' => $request->chat_time
        ]);
        return back();
    }

    public function saveProgress(Request $request)
    {
        $featureId = $request->input('featureId');
        $progress = $request->input('progress');

        Proreq::where('id', $featureId)->update(['progress' => $progress]);
        return redirect()->back()->with('success', 'Progres berhasil disimpan!');
    }


}