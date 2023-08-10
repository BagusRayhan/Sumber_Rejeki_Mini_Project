<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Fitur;
use App\Models\Proreq;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Builder;

class ProjectrequestController extends Controller
{
public function projectreq(Request $request)
{
    $admin = User::where('role', 'admin')->first();

    $notification = Notification::where('role', 'admin')->limit(4)->latest()->get();
    $query = $request->input('query');

    $projectreq = Proreq::where('status', 'pending')
        ->where(function (Builder $builder) use ($query) {
            $builder->where('napro', 'like', '%' . $query . '%');
        })->paginate(6);

    $projectreq->appends(['query' => $query]);

    return view('Admin.projectreq', [
        'projectreq' => $projectreq,
        'admin' => $admin,
        'notification' => $notification
    ]);
}


    public function search(Request $request)
    {
        $query = $request->input('query');

        if (empty($query)) {
            return redirect('/projectreq');
        }

        $admin = User::where('role', 'admin')->first();
        $notification = Notification::where('role', 'admin')->limit(4)->latest()->get();
        $projectreq = Proreq::where('status', 'pending')
            ->where(function (Builder $builder) use ($query) {
                $builder->where('napro', 'like', '%' . $query . '%');
            })
            ->paginate(6);

        return view('Admin.projectreq', [
            'projectreq' => $projectreq,
            'admin' => $admin,
            'query' => $query,
            'notification' => $notification,
        ]);
    }





    public function detailproreq($id){
        $notification = Notification::where('role', 'admin')->limit(4)->latest()->get();
        $admin = User::where('role', 'admin')->first();
        $data = Proreq::find($id);
        if ($data == null) {
            return back();
        }
        if ($data->status !== 'pending') {
            return back();
        }
        $dataa = Fitur::where('project_id', $data->id)->orderBy('project_id')->get();
        return view('Admin.detailproreq', [
            'data' => $data,
            'admin' => $admin,
            'dataa' => $dataa,
            'notification' => $notification
        ]);
    }

    public function downloadSuppDocs($dokumen = null) {
        $file = public_path('document/' . $dokumen);
        if (file_exists($file)) {
            return response()->download($file, $dokumen);
        }
    }


    public function simpanharga(Request $request, $id)
    {
        $request->validate([
            'harga' => 'required|numeric|gt:0'
        ], [
            'harga.required' => 'Harga tidak boleh kosong',
            'harga.numeric' => 'Harga tidak valid',
            'harga.gt' => 'Harga tidak valid',
        ]);
        $proreg = Proreq::findOrFail($id);
        $proreg->update([
            'status' => null,
            'statusbayar' => 'menunggu pembayaran',
            'harga' => $request->harga
        ]);
        $msg = 'Project Disetujui';
        $notifDesk = $proreg->napro.' disetujui admin';
        Notification::create([
            'role' => 'client',
            'user_id' => $proreg->user_id,
            'notif' => $msg,
            'deskripsi' => $notifDesk,
            'kategori' => 'Project Disetujui'
        ]);
        return redirect()->route('projectreq')->with('success', 'Berhasil menyetujui project');
    }

    public function simpanfiturr(Request $request, $id)
{
    $fitur = Fitur::findOrFail($id);
    $request->validate([
        'hargafitur' => 'required|numeric|gt:0'
    ],[
        'hargafitur.required' => 'Harga tidak boleh kosong',
        'hargafitur.numeric' => 'Harga tidak valid',
        'hargafitur.gt' => 'Harga tidak valid',
    ]);
    $fitur->hargafitur = $request->hargafitur;
    $fitur->save();

    return back();
}

public function alasantolak(Request $request)
{
    $request->validate([
        'alasan' => 'required'
    ],[
        'alasan.required' => 'Alasan tidak boleh kosong'
    ]);
    $id = $request->dataid;
    $pro = Proreq::findOrFail($id);
    if (File::exists(public_path().'document/'.$pro->dokumen)) {
        unlink(public_path('document/'.$pro->document));
    }
    $pro->alasan = $request->input('alasan');
    $pro->status = 'tolak';
    $pro->save();
    $msg = 'Project Ditolak';
    $notifDesk = $pro->napro.' Ditolak';
    Notification::create([
        'role' => 'client',
        'user_id' => $pro->user_id,
        'notif' => $msg,
        'deskripsi' => $notifDesk,
        'kategori' => 'Project Ditolak'
    ]);

    return redirect()->route('projectreq')->with('success', 'Project berhasil ditolak');
}

public function updateproreqa($id)
{

    $proreq = Proreq::findOrFail($id);
    $fitur = Fitur::where('project_id', $proreq->id)->get();
    $hrgFitur = Fitur::where('project_id', $proreq->id)->pluck('hargafitur');
    $totalHarga = $fitur->sum('hargafitur');
    if ($hrgFitur->contains(null)) {
        return back()->with('error', 'Masukkan harga terlebih dahulu');
    }
    $proreq->harga = $totalHarga;
    $proreq->status = null;
    $proreq->statusbayar = 'menunggu pembayaran';
    $proreq->save();

    $msg = 'Project Disetujui';
    $notifDesk = $proreq->napro.' disetujui admin';
    Notification::create([
        'role' => 'client',
        'user_id' => $proreq->user_id,
        'notif' => $msg,
        'deskripsi' => $notifDesk,
        'kategori' => 'Project Disetujui'
    ]);

    return redirect()->route('projectreq')->with('success', 'Project berhasil disetujui');
}

    public function projectselesai(Request $request){
        $notification = Notification::where('role', 'admin')->limit(4)->latest()->get();
        $admin = User::where('role', 'admin')->first();
         $query = $request->input('query');
        $selesai = proreq::whereIn('status', ['selesai','pengajuan revisi','revisi'])->where('napro', 'LIKE', '%'.$query.'%')->paginate(6);
        $selesai->appends(['query' => $query]);
        return view('Admin.projectselesai', compact('selesai','admin','notification'));
    }


    // public function updateproselesai(Request $request, $id)
    // {
    //     $proreq = Proreq::findOrFail($id);

    //     $request->validate([
    //         'napro' => 'required',
    //         'deadline' => 'required|date|after_or_equal:today',
    //     ], [
    //         'napro.required' => 'Nama project tidak boleh kosong',
    //         'deadline.required' => 'Isi deadline terlebih dahulu',
    //         'deadline.date' => 'Format deadline tidak valid',
    //         'deadline.after_or_equal' => 'Deadline tidak boleh hari kemarin',
    //     ]);

    //     $proreq->napro = $request->napro;
    //     $proreq->deadline = $request->deadline;
    //     $proreq->save();

    //     return redirect()->route('revisiproselesai')->with('success', 'Data berhasil diperbarui.');
    // }

    public function revisiproselesai($id)
    {

        $notification = Notification::where('role', 'admin')->limit(4)->latest()->get();
        $admin = User::where('role', 'admin')->first();
        $fitur = Fitur::where('project_id', $id)->get();
        $data = Proreq::find($id);
        if ($data == null) {
            return back();
        }
        if ($data->status !== 'pengajuan revisi' ) {
            return back();
        }
        $chats = Chat::where('project_id', $id)->get();
        return view('Admin.revisiproselesai', [
            'data' => $data,
            'fitur' => $fitur,
            'chats' => $chats,
            'admin' =>$admin,
            'notification' => $notification
        ]);
    }


    public function editproselesai($id){
        $notification = Notification::where('role', 'admin')->limit(4)->latest()->get();
        $admin = User::where('role', 'admin')->first();
        $data = Proreq::find($id);
        $fitur = Fitur::where('project_id', $id);
        return view('Admin.editproselesai', [
            'admin' =>$admin,
            'data' => $data,
            'fitur' => $fitur,
            'notification' => $notification,
        ]);
    }

    public function updateProreq(Request $request, $id)
    {

        $proreq = Proreq::findOrFail($id);
        $request->validate([
            'napro' => 'required',
            'deadline' => 'required|date|after_or_equal:today',
        ], [
            'napro.required' => 'Nama project tidak boleh kosong',
            'deadline.required' => 'Isi deadline terlebih dahulu',
            'deadline.date' => 'Format deadline tidak valid',
            'deadline.after_or_equal' => 'Deadline tidak boleh hari kemarin',
        ]);

        $fitur = Fitur::where('project_id', $proreq->id)->get();
        $totalBiayaTambahan = $fitur->sum('biayatambahan');
        $proreq->napro = $request->napro;
        $proreq->deadline = $request->deadline;
        $proreq->biayatambahan = $totalBiayaTambahan;
        $proreq->status = 'revisi';
        $proreq->statusbayar = null;
        $proreq->progress = null;
        $proreq->save();

        $msg = 'Project Direvisi';
        $notifDesk = $proreq->napro.' diubah oleh admin';
        Notification::create([
            'role' => 'client',
            'user_id' => $proreq->user_id,
            'notif' => $msg,
            'deskripsi' => $notifDesk,
            'kategori' => 'Project Direvisi'
        ]);

        return redirect()->route('projectselesai')->with('success', 'Berhasil mengajukan perubahan');
    }

    public function savefitur(Request $request, $id)
    {
        $this->validate($request,[
            'namafitur' => 'required',
            'biayatambahan' => 'required|numeric|gt:0',
            'deskripsi' => 'required',
        ],[
            'namafitur.required' => 'Fitur tidak boleh kosong',
            'biayatambahan.required' => 'Biaya tidak boleh kosong',
            'biayatambahan.numeric' => 'Harga tidak valid',
            'biayatambahan.gt' => 'Harga tidak valid',
            'deskripsi' => 'Deskripsi tidak boleh kosong',
        ]);
        $data = Proreq::findOrFail($id);
        $project_id = $data->id;
        Fitur::create([
            'project_id' => $project_id,
            'namafitur' => $request->namafitur,
            'biayatambahan' => $request->biayatambahan,
            'status2' => 'revisi',
            'deskripsi' => $request->deskripsi
        ]);

        return back()->with('success', 'Berhasil menambahkan fitur');
    }

    public function updateFitur(Request $request, $id) {
        $this->validate($request,[
            'namafitur' => 'required',
            'hargafitur' => 'required|numeric|gt:0',
            'deskripsi' => 'required',
        ],[
            'namafitur.required' => 'Fitur tidak boleh kosong',
            'hargafitur.required' => 'Biaya tidak boleh kosong',
            'hargafitur.numeric' => 'Harga tidak valid',
            'hargafitur.gt' => 'Harga tidak valid',
            'deskripsi' => 'Deskripsi tidak boleh kosong',
        ]);
        $fitur = Fitur::findOrFail($id);
        $inputData = [
            'namafitur' => $request->namafitur,
            'deskripsi' => $request->deskripsi
        ];

        if ($request->has('hargafitur')) {
            $inputData['biayatambahan'] = $request->hargafitur;
            $inputData['hargafitur'] = null;
        }

        $fitur->update($inputData);
        $fitur->status = 'Revisi';
        $fitur->save();

        return redirect()->back()->with('success','Berhasil mengedit fitur!');
    }


    public function destroyFitur(Request $request) {
        Fitur::find($request->fitur_id)->delete();
        return back()->with('success', 'Fitur berhasil dihapus');
    }

}
