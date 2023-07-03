<?php

namespace App\Http\Controllers;

use App\Models\Proreq;
use App\Models\Fitur;
use App\Models\Sosmed;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class IndexcController extends Controller
{
    public function indexclient()
        {  
        $sosmed = Sosmed::all();
        return view('Client.index', compact('sosmed'));
        }

    public function drequestclient(){
        $data = Proreq::all();
        $sosmed = Sosmed::all();
        return view('Client.clientproreq',compact('data','sosmed'));
    }

    public function createproreq(){
        $sosmed = Sosmed::all();
        $fitur = Fitur::all();
        return view ('Client.createproreq', compact('sosmed','fitur'));
    }

 public function simpann(Request $request)
{
    $this->validate($request,[
        'nama' => 'required|min:5|max:30',
        'napro' => 'required',
        'bukti' => 'mimes:pdf,png,jpeg',
        'deadline' => 'required',
    ], [
        'nama.required' => 'Nama tidak boleh kosong',
        'napro.required' => 'Nama project tidak boleh kosong',
        'bukti.mimes' => 'Dokumen harus pdf/png/jpeg',
        'deadline.required' => 'deadline harus terisi',
    ]);

    $data = Proreq::all();
    $namaFile = null; // Inisialisasi $namaFile dengan nilai null

    if ($request->hasFile('bukti')) {
        $nm = $request->bukti;
        $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();
        $nm->move(public_path() . '/gambar', $namaFile);
    }

    $dtUpload = new Proreq();
    $dtUpload->nama = $request->nama;
    $dtUpload->napro = $request->napro;
    $dtUpload->bukti = $namaFile;
    $dtUpload->deadline = $request->deadline;

    $dtUpload->save();
    $id = $dtUpload->id;
    return redirect()->route('editproreq', ['id' => $id]);
}


     public function showproj(Request $request){
        return view('Client.createproreq');
    }

    public function simpannn(Request $request, $id)
    {
        $sosmed = Sosmed::all();
        $data = Proreq::findOrFail($id);
        $project_id = $data->id;  

        Fitur::create([
            'project_id' => $project_id,
            'namafitur' => $request->namafitur,
            'deskripsi' => $request->deskripsi
        ]);
            
        return redirect()->route('editproreq', $id)->with(compact('data', 'sosmed'));
    }


    public function update(Request $request, $id){
    $ubah = Proreq::findorfail($id);
    $awal = $ubah->bukti;

    if ($request->hasFile('bukti')) {
        if (File::exists(public_path().'/gambar/'.$awal)) {
            File::delete(public_path().'/gambar/'.$awal);
        }

        $awal = $request->bukti->hashName();
        $request->bukti->move(public_path().'/gambar', $awal);
    }

    $data = [
        'nama' => $request['nama'],
        'napro' => $request['napro'],
        'bukti' => $awal,
        'deadline' => $request['deadline'],
        'status' => 'pending',    
    ];

    $ubah->update($data);
    $project_id = $ubah->id;
    return redirect('drequestclient')->with('success', 'Project Berhasil dikirim!');
    }
    

    public function editproreq($id){
        $sosmed = Sosmed::all();
        $data = Proreq::findorfail($id);
        $dataa = Fitur::where('project_id', $id)->get();
        
        return view('Client.editproreq',compact('data','sosmed','dataa'));
    }

public function showFormModal($id)
{
    $data = Fitur::findOrFail($id);
    return view('Client.editproreq', compact('data'));
}

public function updateFitur(Request $request, $id)
{
    $fitur = Fitur::findOrFail($id);

    $fitur->namafitur = $request->input('namafitur');
    $fitur->deskripsi = $request->input('deskripsi');

    $fitur->save();

    return back();
}

public function destroyfitur($id)
{
    $data = Fitur::findOrFail($id);
    $data->delete();
    return redirect()->route('editproreq', ['id' => $data->project_id]);
}


}
