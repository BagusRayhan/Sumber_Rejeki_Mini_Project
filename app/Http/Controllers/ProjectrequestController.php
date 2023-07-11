<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Fitur;
use App\Models\Proreq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Builder;

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
        $data = Proreq::find($id);
        $dataa = Fitur::where('project_id', $data->id)->orderBy('project_id')->get();
        return view('Admin.detailproreq', [
            'data' => $data,
            'admin' => $admin,
            'dataa' => $dataa
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
    $proreq = Proreq::findOrFail($id);
    $fitur = Fitur::where('project_id', $proreq->id)->get();
    
    $totalHarga = $fitur->sum('hargafitur');

    $proreq->harga = $totalHarga;
    $proreq->status = null;
    $proreq->statusbayar = 'menunggu pembayaran';

    $proreq->save();

    return redirect()->route('projectreq')->with('sukses', 'Data berhasil disetujui');
}



    public function projectselesai(Request $request){
        $keyword = $request->searchKeyword;
        $admin = User::where('role', 'admin')->first();
        $selesai = proreq::whereIn('status', ['selesai', 'revisi'])->where('napro', 'LIKE', '%'.$keyword.'%')->paginate(3);
        return view('Admin.projectselesai', compact('selesai','admin'));
    }

    public function revisiproselesai($id)
    {
        $admin = User::where('role', 'admin')->first();
        $fitur = Fitur::where('project_id', $id)->get();
        $data = Proreq::find($id);
        $chats = Chat::where('project_id', $id)->get();
        return view('Admin.revisiproselesai', [
            'data' => $data,
            'fitur' => $fitur,
            'chats' => $chats,
            'admin' =>$admin
        ]);
    }
    

    public function editproselesai($id){
        $admin = User::where('role', 'admin')->first();
        $data = Proreq::find($id);
        $fitur = Fitur::where('project_id', $id);
        return view('Admin.editproselesai', [
            'admin' =>$admin,
            'data' => $data,
            'fitur' => $fitur
        ]);
    }

    public function updateProreq(Request $request) {
        Proreq::find($request->project_id)->update([
            'napro' => $request->napro,
        ]);
        return redirect()->route('projectselesai')->with('success', 'Berhasil mengajukan perubahan');
    }

    public function savefitur(Request $request, $id)
    {
        $data = Proreq::findOrFail($id);
        $project_id = $data->id;

        Fitur::create([
            'project_id' => $project_id,
            'namafitur' => $request->namafitur,
            'hargafitur' => $request->hargafitur,
            'deskripsi' => $request->deskripsi
        ]);

        return back()->with('success', 'Berhasil menambahkan fitur');
    }

    public function updateFitur(Request $request, $id) {
    $fitur = Fitur::findOrFail($id);
    $fitur->update([
        'namafitur' => $request->namafitur,
        'hargafitur' => $request->hargafitur,
        'deskripsi' => $request->deskripsi
    ]);
    return back();
}
    public function destroyFitur(Request $request) {
        Fitur::find($request->fitur_id)->delete();
        return back()->with('success', 'Fitur berhasil dihapus');
    }

}
