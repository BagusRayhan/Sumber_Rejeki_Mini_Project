<?php

namespace App\Http\Controllers;

use App\Models\Fitur;
use App\Models\Proreq;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProjectrequestController extends Controller
{
    public function projectreq(){
        $admin = User::where('role', 'admin')->first();
        $projectreq = Proreq::where('status','pending')->get();
        return view('Admin.projectreq', [
            'projectreq'=>$projectreq,
            'admin' =>$admin
        ]);
    }

    public function detailproreq($id){
        $admin = User::where('role', 'admin')->first();
        $data = Proreq::all()->find($id);
        $dataa = Fitur::where('project_id', $id)->get();
        return view('Admin.detailproreq', [
            'data' => $data,
            'admin' =>$admin,
            'dataa' =>$dataa
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
    $fitur = Fitur::findOrFail($id);

    $fitur->hargafitur = $request->input('hargafitur');

    $fitur->save();

    return back();
}

public function alasantolak(Request $request)
{
    $id = $request->dataid;
    $pro = Proreq::findOrFail($id);

    $pro->alasan = $request->input('alasan');
    $pro->status = 'tolak';

    $pro->save();

    return redirect()->route('projectreq')->with('sukses', 'Data berhasil ditolak');
}

public function updateproreqa($id)
{
    $setuju = Proreq::findOrFail($id);

    $setuju->status = null;
    $setuju->statusbayar = 'menunggu pembayaran';

    $setuju->save();

    return redirect()->route('projectreq')->with('sukses', 'Data berhasil disetujui');
}


    public function projectselesai(){
        $admin = User::where('role', 'admin')->first();
        return view('Admin.projectselesai', [
            'admin' =>$admin
        ]);
    }

    public function revisiproselesai(){
        $admin = User::where('role', 'admin')->first();
        return view('Admin.revisiproselesai', [
            'admin' =>$admin
        ]);
    }

    public function editproselesai(){
        $admin = User::where('role', 'admin')->first();
        return view('Admin.editproselesai', [
            'admin' =>$admin
        ]);
    }


}
