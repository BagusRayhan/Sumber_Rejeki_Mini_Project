<?php

namespace App\Http\Controllers;

use App\Models\Proreq;
use App\Models\clientproreq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class IndexcController extends Controller
{
    public function indexclient()
        {
            return view('Client.index');
        }

    public function drequestclient(){
        $data = Proreq::all();
        return view('Client.clientproreq',compact('data'));
    }

    public function createproreq(){
        return view ('Client.createproreq');
    }
    public function simpan(Request $request){
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

    public function editproreq($id){
        $data = Proreq::findorfail($id);
        return view('Client.editproreq',compact('data'));
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

    return redirect('drequestclient');
    }
    
}
