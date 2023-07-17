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
    public function projectreq()
    {
        $admin = User::where('role', 'admin')->first();

        $notification = Notification::where('role', 'admin')->limit(4)->latest()->get();
        $projectreq = Proreq::where('status','pending')->paginate(6);
        return view('Admin.projectreq', [
            'projectreq'=>$projectreq,
            'admin' =>$admin,
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
        $notification = Notification::where('role', 'admin')->latest()->get();
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
        $notification = Notification::where('role', 'admin')->latest()->get();
        $admin = User::where('role', 'admin')->first();
        $data = Proreq::find($id);
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
            'harga' => 'required|numeric|min:1'
        ], [
            'harga.required' => 'harga tidak boleh kosong!',
        ]);

        $proreg = Proreq::findOrFail($id);

        $proreg->harga = $request->input('harga');
        $proreg->update([
            'status' => null,
            'statusbayar' => 'menunggu pembayaran'
        ]);


        $proreg->save();

        return redirect()->route('projectreq');
    }

public function simpanfitur(Request $request, $id)
{
    $fitur = Fitur::findOrFail($id);
    $fitur->hargafitur = $request->input('hargafitur');
    $fitur->save();

    return back();
}


public function alasantolak(Request $request)
{
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

    return redirect()->route('projectreq')->with('sukses', 'Project berhasil ditolak');
}

public function updateproreqa($id)
{

    $proreq = Proreq::findOrFail($id);
    $fitur = Fitur::where('project_id', $proreq->id)->get();
    $totalHarga = $fitur->sum('hargafitur');
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

    return redirect()->route('projectreq')->with('sukses', 'Data berhasil disetujui');
}

    public function projectselesai(Request $request){
        $keyword = $request->searchKeyword;
        $notification = Notification::where('role', 'admin')->latest()->get();
        $admin = User::where('role', 'admin')->first();
        $selesai = proreq::whereIn('status', ['selesai', 'pengajuan revisi', 'revisi'])->where('napro', 'LIKE', '%'.$keyword.'%')->paginate(3);
        return view('Admin.projectselesai', compact('selesai','admin','notification'));
    }

    public function revisiproselesai($id)
    {
        $notification = Notification::where('role', 'admin')->latest()->get();
        $admin = User::where('role', 'admin')->first();
        $fitur = Fitur::where('project_id', $id)->get();
        $data = Proreq::find($id);
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
        $notification = Notification::where('role', 'admin')->latest()->get();
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

    public function updateProreq(Request $request)
    {
        $id = $request->project_id;
        $proreq = Proreq::findOrFail($id);
        $proreq->update([
            'napro' => $request->napro,
            'deadline' => $request->deadline
        ]);
        $fitur = Fitur::where('project_id', $proreq->id)->get();
        $totalBiayaTambahan = $fitur->sum('biayatambahan');
    
        $proreq->biayatambahan = $totalBiayaTambahan;
        $proreq->status = 'revisi';
        $proreq->statusbayar = null;
        $proreq->save();
    
        return redirect()->route('projectselesai')->with('success', 'Berhasil mengajukan perubahan');
    }    

    public function savefitur(Request $request, $id)
    {
        $data = Proreq::findOrFail($id);
        $project_id = $data->id;

        Fitur::create([
            'project_id' => $project_id,
            'namafitur' => $request->namafitur,
            'biayatambahan' => $request->biayatambahan,
            'deskripsi' => $request->deskripsi
        ]);

        return back()->with('success', 'Berhasil menambahkan fitur');
    }

    public function updateFitur(Request $request, $id) {
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
        $fitur->status = 'belum selesai';
        $fitur->save();
    
        return redirect()->back();
    }
    

    public function destroyFitur(Request $request) {
        Fitur::find($request->fitur_id)->delete();
        return back()->with('success', 'Fitur berhasil dihapus');
    }

}
