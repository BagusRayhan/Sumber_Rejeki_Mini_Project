<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Proreq;
use App\Models\Fitur;
use App\Models\Sosmed;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class IndexcController extends Controller
{
    public function indexclient()
        {
        $client = User::find(Auth::user()->id);
        $setujuCounter = Proreq::where('status', 'setuju')->count();
        $tolakCounter = Proreq::where('status', 'tolak')->count();
        $kerjaCounter = Proreq::where('status', 'setuju')->count();
        $selesaiCounter = Proreq::where('status', 'selesai')->count();
        $pesancht = Chat::all();
        $sosmed = Sosmed::all();
        return view('Client.index',[

            'setujuCounter' => $setujuCounter,
            'tolakCounter' => $tolakCounter,
            'kerjaCounter' => $kerjaCounter,
            'selesaiCounter' => $selesaiCounter,
            'pesancht' => $pesancht,
            'sosmed' => $sosmed,
            'client' => $client
        ]);
        }

    public function drequestclient(){
        $client = User::where('role', 'client')->first();
        $data = Proreq::where('status', 'draft')->orWhere('status', 'pending')->get();
        $sosmed = Sosmed::all();
        return view('Client.clientproreq',compact('data','sosmed','client'));
    }


    public function createproreq(){
        $sosmed = Sosmed::all();
        $fitur = Fitur::all();
        return view ('Client.createproreq', compact('sosmed','fitur'));
    }

 public function simpann(Request $request)
{
    $this->validate($request,[
        'napro' => 'required',
        'deadline' => 'required',
    ], [
        'napro.required' => 'Nama project tidak boleh kosong',
        'deadline.required' => 'Isi deadline terlebih dahulu',
    ]);
    $dtUpload = new Proreq();
    if ($request->has('dokumen')) {
        $file = $request->file('dokumen');
        $newFile = $file->hashName();
        $file->move(public_path('document/'), $newFile);
        $dtUpload->dokumen = $newFile;
    }
    $dtUpload->user_id = Auth()->user()->id;
    $dtUpload->nama = Auth()->user()->name;
    $dtUpload->napro = $request->napro;
    $dtUpload->status = 'draft';
    $dtUpload->deadline = $request->deadline;
    $dtUpload->save();
    $id = $dtUpload->id;
    return redirect()->route('editproreq', ['id' => $id]);
}


     public function showproj(Request $request){
        $client = User::where('role', 'client')->first();
        $userid = Auth::user()->id;
        $username = User::where('id', $userid)->value('name');
        return view('Client.createproreq',compact('client','username'));
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


    public function update(Request $request){
        $upProject = [];
        $id = $request->projectid;
        $project = Proreq::findorfail($id);
        if ($request->has('dokumen')) {
            if (File::exists(public_path().'document/' . $project->dokumen)) {
                unlink(public_path().'document/' . $project->dokumen);
            }
            $newFile = $request->file('dokumen');
            $newDocs = $newFile->hashName();
            $newFile->move(public_path('document/'), $newDocs);
            $upProject['dokumen'] = $newDocs;
        }
        $upProject['nama'] = Auth()->user()->name;
        $upProject['napro'] = $request->napro;
        $upProject['deadline'] = $request->deadline;
        $upProject['status'] = $request->status;
        $project->update($upProject);
        return redirect('drequestclient')->with('success', 'Project Berhasil dikirim!');
    }


    public function editproreq($id){
        $client = User::where('role', 'client')->first();
        $sosmed = Sosmed::all();
        $data = Proreq::findorfail($id);
        $dataa = Fitur::where('project_id', $id)->get();

        return view('Client.editproreq',compact('data','sosmed','dataa','client'));
    }

    public function sendRequest($id) {
        $pro = Proreq::find($id);
        $pro->update([
            'status' => 'pending'
        ]);
        return redirect(route('drequestclient'))->with('success', 'data berhasil dikirim');
    }

    public function destroyRequest(Request $request) {
        Proreq::find($request->project_id)->delete();
        return back();
    }

public function showFormModal($id)
{
    $client = User::where('role', 'client')->first();
    $data = Fitur::findOrFail($id);
    return view('Client.editproreq', compact('data','client'));
}

public function updateFitur(Request $request, $id)
{
    $fitur = Fitur::findOrFail($id);

    $fitur->namafitur = $request->input('namafitur');
    $fitur->deskripsi = $request->input('deskripsi');

    $fitur->save();

    return back();
}

public function updateProfile(Request $request)
{
    $updateProfile = [];
    $client = User::where('role', 'client')->first();

    if ($request->has('fileInputA')) {
        if (File::exists(public_path('gambar/user-profile/' . $client->profil))) {
            File::delete(public_path('gambar/user-profile/' . $client->profil));
        }

        $file = $request->file('fileInputA');
        $newFile = $file->hashName();
        $file->move(public_path('gambar/user-profile/'), $newFile);
        $updateProfile['profil'] = $newFile;
    }

    $updateProfile['name'] = $request->input('name');
    $updateProfile['email'] = $request->input('email');
    $updateProfile['no_tlp'] = $request->input('no_tlp');
    $updateProfile['nama_perusahaan'] = $request->input('nama_perusahaan');
    $updateProfile['alamat_perusahaan'] = $request->input('alamat_perusahaan');

    $client->update($updateProfile);

    return redirect()->back()->with('success', 'Profil berhasil diperbarui');
}



public function destroyfitur($id)
{
    $data = Fitur::findOrFail($id);
    $data->delete();
    return redirect()->route('editproreq', ['id' => $data->project_id]);
}


}

