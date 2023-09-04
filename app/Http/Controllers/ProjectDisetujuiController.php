<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Fitur;
use App\Models\Proreq;
use App\Models\Sosmed;
use App\Mail\RevisiSelesai;
use App\Mail\ProjectSelesai;
use App\Models\Notification;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProjectDisetujuiController extends Controller
{
    public function disetujui(Request $request ) {
        $admin = User::where('role', 'admin')->first();
        $today = date('Y-m-d');
        Proreq::whereDate('deadline', '<', $today)->update(['status2' => 'telat']);
        Proreq::whereDate('deadline', '>', $today)->update(['status2' => 'proses']);
        if ($request->ajax()) {
            $data = Proreq::latest()->get();
            return Datatables::of($data)->make(true);
        }
        $query = $request->input('query');
        $notification = Notification::where('role', 'admin')->limit(4)->latest()->get();
        $projects = Proreq::where('status', 'setuju')->where('napro', 'LIKE', '%'.$query.'%')->paginate(4);
        $projects->appends(['query' => $query]);
        return view('Admin.project-disetujui', [
            'project' => $projects,
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
        $statFeatures = Fitur::where('project_id', $id)->pluck('status');
        $doneFitur = $statFeatures->every(function($status) {
            return $status == 'selesai';
        });
        $done = Fitur::where('project_id', $id)->where('status', 'selesai')->count();
        $chats = Chat::where('project_id', $id)->get();
        $progress = 0;
        if ($detail == null) {
            return back();
        }
        if ($detail->status !== 'setuju') {
            return back();
        }
        if ($detail->status2 == 'telat') {
            return back()->with('error','Project sudah melebihi deadline');
        }
        if ($fitur->count() > 0) {
            $progress = (100 / $fitur->count()) * $done;
        }
        return view('Admin.detail-project-disetujui', [
            'detail' => $detail,
            'progress' => $progress,
            'fitur' => $fitur,
            'chats' => $chats,
            'done' => $done,
            'admin' => $admin,
            'notification' => $notification,
            'id' => $id,
            'doneFeatures' => $doneFitur
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
    $request->validate([
        'estimasi' => [
            'required',
            'date',
            'after_or_equal:today',
            function ($attribute, $value, $fail) use ($request) {
                $deadline = Proreq::where('id', $request->project_id)->value('deadline');

                if ($value > $deadline) {
                    $fail('Estimasi tidak boleh melebihi tanggal deadline');
                }
            },
        ],
    ], [
        'estimasi.required' => 'Isi estimasi terlebih dahulu',
        'estimasi.date' => 'Format estimasi tidak valid',
        'estimasi.after_or_equal' => 'Estimasi tidak boleh hari kemarin',
    ]);

    $pro = Proreq::find($request->project_id);
    $pro->update([
        'estimasi' => $request->estimasi
    ]);
    return back();
}


    public function doneProject(Request $request) {
        $pro = Proreq::find($request->project_id);
        $user = User::findOrFail($pro->user_id);
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
            Mail::to($user->email)->send(new ProjectSelesai($pro));
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
            Mail::to($user->email)->send(new RevisiSelesai($pro));
        }
        return redirect(route('project-disetujui-admin'))->with('success', 'Berhasil menyelesaikan project');
    }

    public function projectChat(Request $request) {
        $id = $request->input('project_id');
        if ($request->chat == '') {
            return back();
        }
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
        $today = date('Y-m-d');
        Proreq::whereDate('deadline', '<', $today)->update(['status2' => 'telat']);
        Proreq::whereDate('deadline', '>', $today)->update(['status2' => 'proses']);
        $notification = Notification::where('role', 'client')->where('user_id', Auth::user()->id)->limit(4)->latest()->get();
        $sosmed = Sosmed::all();;
        $project = Proreq::where('status', 'setuju')->where('user_id', Auth::user()->id)->paginate(4);
        return view('Client.disetujui', compact('project', 'sosmed','client','notification'));
    }

    public function refundRequestClient(Request $request, $id) {
        $request->validate([
            'nomorRefund' => 'required|gt:0|between:10,15'
        ],[
            'nomorRefund.required' => 'Nomor tidak boleh kosong',
            'nomorRefund.gt' => 'Nomor tidak valid',
            'nomorRefund.between' => 'Nomor minimal 10 karakter maksimal 15 karakter'
        ]);
        $pro = Proreq::findOrFail($id);
        $pro->update([
            'status' => 'refund',
            'metodeRefund' => $request->metodeRefund,
            'layananRefund' => $request->layananRefund,
            'nomorRefund' => $request->nomorRefund
        ]);
        $msg = 'Pengajuan Refund';
        $notifDesk = $pro->napro;
        Notification::create([
            'role' => 'admin',
            'user_id' => $pro->user_id,
            'notif' => $msg,
            'deskripsi' => $notifDesk,
            'kategori' => 'Pengajuan Refund'
        ]);
        return back()->with('success','Berhasil mengajukan Refund');
    }

    public function cancelRevisionClient(Request $request) {
        $pro = Proreq::findOrFail($request->project_id);
        Fitur::where('project_id', $pro->id)->where('status2', 'revisi')->delete();
        Fitur::where('project_id', $pro->id)->where('status', 'revisi')->update([
            'status' => 'selesai'
        ]);
        $pro->update([
            'status' => 'selesai',
            'status2' => null,
            'biayatambahan' => null,
            'progress' => 100,
        ]);
        $msg = 'Pembatalan Revisi';
        $notifDesk = $pro->napro;
        Notification::create([
            'role' => 'admin',
            'user_id' => $pro->user_id,
            'notif' => $msg,
            'deskripsi' => $notifDesk,
            'kategori' => 'Pembatalan Revisi'
        ]);
        return back()->with('success', 'Berhasil membatalkan revisi');
    }

    public function detailDisetujuiClient($id) {
        $client = User::find(Auth::user()->id);
        $notification = Notification::where('role', 'client')->where('user_id', Auth::user()->id)->limit(4)->latest()->get();
        $detail = Proreq::find($id);
        $fitur = Fitur::where('project_id', $id)->get();
        $done = Fitur::where('project_id', $id)->where('status', 'selesai')->count();
        $progress = 0;
        $chats = Chat::where('project_id', $id)->get();
        $sosmed = Sosmed::all();
        if ($detail == null) {
            return back();
        }
        if (Auth::user()->id !== $detail->user_id || $detail->status !== 'setuju') {
            return back();
        }
        if (count($fitur) > 0) {
            $progress = (100 / count($fitur)) * $done;
        }
        return view('Client.detailsetujui', [
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
        if ($request->chat == '') {
            return back();
        }
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
