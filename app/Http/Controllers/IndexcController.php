<?php

namespace App\Http\Controllers;

use App\Models\Proreq;
use App\Models\Fitur;
use App\Models\Sosmed;
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

    public function simpann(Request $request){
        $data = Proreq::all();
        $nm = $request->bukti;
        $namaFile =time().rand(100,999).".".$nm->getClientOriginalExtension();
        
        $dtUpload = new Proreq();
        $dtUpload->nama= $request->nama;
        $dtUpload->napro= $request->napro;
	    $dtUpload->bukti = $namaFile;
        $dtUpload->deadline= $request->deadline;
        


        $nm->move(public_path().'/gambar',$namaFile);
        $dtUpload->save();
        return redirect('drequestclient');
    }

     public function showproj(Request $request){
        return view('Client.createproreq');
    }

    public function simpannn(Request $request, $id)
    {
        $sosmed = Sosmed::all();
        $data = Proreq::findorfail($id);
        $dataa = Fitur::where('project_id', $id)->get();
        $project_id = $data->id;  
        Fitur::create([
            'project_id' => $project_id,
            'namafitur' => $request->namafitur,
            'deskripsi' => $request->deskripsi
        ]);
            
           return view('Client.editproreq',compact('data','sosmed','dataa'));                
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
        
    ];

    $ubah->update($data);
    $project_id = $ubah->id;
    return redirect('drequestclient');
    }
    

    public function editproreq($id){
        $sosmed = Sosmed::all();
        $data = Proreq::findorfail($id);
        $dataa = Fitur::where('project_id', $id)->get();
        return view('Client.editproreq',compact('data','sosmed','dataa'));
    }

}
