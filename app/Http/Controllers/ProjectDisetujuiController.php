<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Fitur;
use Illuminate\Http\Request;
use App\Models\ProjectDisetujui;
use App\Models\Proreq;
use App\Models\Sosmed;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProjectDisetujuiController extends Controller
{
    public function disetujui(Request $request) {
        $admin = User::where('role', 'admin')->first();
        $keyword = $request->searchKeyword;
        $project = proreq::where('status','setuju')->where('napro', 'LIKE', '%'.$keyword.'%')->paginate(3);
        return view('Admin.project-disetujui', [
            'project' => $project,
            'admin' => $admin
        ]);
    }

    public function detailDisetujui($id) {
        $admin = User::where('role', 'admin')->first();
        $detail = Proreq::find($id);
        $fitur = Fitur::where('project_id', $id)->get();
        $done = Fitur::where('project_id', $id)->where('status', 'selesai')->count();
        $progress = (100 / count($fitur)) * $done;
        $chats = Chat::where('project_id', $id)->get();
        return view('Admin.detail-project-disetujui', [
            'detail' => $detail,
            'progress' => $progress,
            'fitur' => $fitur,
            'chats' => $chats,
            'done' => $done,
            'admin' =>$admin
        ]);
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
        $pro->update([
            'status' => 'selesai'
        ]);
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
        $client = User::where('role', 'client')->first();
        $sosmed = Sosmed::all();
        $project = Proreq::where('status','setuju')->get();
        return view('Client.disetujui', compact('project', 'sosmed','client'));
    }

    public function detailDisetujuiClient($id) {
        $client = User::where('role', 'client')->first();
        $detail = Proreq::find($id);
        $fitur = Fitur::where('project_id', $id)->get();
        $done = Fitur::where('project_id', $id)->where('status', 'selesai')->count();
        $progress = (100 / count($fitur)) * $done;
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
            'client' =>$client
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
}
