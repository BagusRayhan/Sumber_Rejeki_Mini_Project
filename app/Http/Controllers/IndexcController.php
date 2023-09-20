<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Proreq;
use App\Models\Fitur;
use App\Models\Notification;
use App\Models\Sosmed;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class IndexcController extends Controller
{
    public function indexclient()
        {
        $client = User::find(Auth::user()->id);
        $notification = Notification::where('role', 'client')->where('user_id', Auth::user()->id)->limit(4)->latest()->get();
        $setujuCounter = Proreq::where('status', 'setuju')->where('user_id', Auth::user()->id)->count();
        $tolakCounter = Proreq::where('status', 'tolak')->where('user_id', Auth::user()->id)->count();
        $kerjaCounter = Proreq::where('status', 'setuju')->where('user_id', Auth::user()->id)->count();
        $selesaiCounter = Proreq::where('status', 'selesai')->where('user_id', Auth::user()->id)->count();
        $notifikasi = Proreq::all();
        $estimasi = Proreq::where('status','setuju')->where('user_id', Auth::user()->id)->limit(4)->get();
        $fitur = Fitur::where('project_id', $client->id)->get();
        $done = Fitur::where('project_id')->where('status', 'selesai')->count();
        $progress = 0;
        if (count($fitur) > 0) {
            $progress = (100 / count($fitur)) * $done;
        }
        $admin = User::find(1);
        $message = Proreq::whereHas('projectchat')->with('projectchat')->limit(4)->latest()->get();
        // $message = Chat::whereHas('user', function($query) {
        //     $query->where('role', 'admin');
        //     })->limit(4)->latest()->get();

            // dd($message);


            // $message = Proreq::query()
            // ->whereHas('projectchat')
            // ->with('projectchat')
            // ->limit(4)
            // ->latest()
            // ->get();

        $sosmed = Sosmed::all();
        return view('Client.index',[
            'notification' => $notification,
            'setujuCounter' => $setujuCounter,
            'tolakCounter' => $tolakCounter,
            'kerjaCounter' => $kerjaCounter,
            'selesaiCounter' => $selesaiCounter,
            'notifikasi' => $notifikasi,
            'estimasi' => $estimasi,
            'admin' => $admin,
            'admin_id' => $admin->id,
            'message' => $message,
            'sosmed' => $sosmed,
            'client' => $client,
            'fitur' => $fitur,
            'done' => $done,
            'progress' => $progress
        ]);
    }

    public function notifRedirectClient($id) {
        $notif = Notification::findOrFail($id);
        if ($notif->kategori == 'Project Disetujui' || $notif->kategori == 'Pembayaran Awal Ditolak') {
            $notif->delete();
            return redirect()->route('bayarclient');
        } elseif ($notif->kategori == 'Project Ditolak') {
            $notif->delete();
            return redirect()->route('ditolakclient');
        } elseif ($notif->kategori == 'Pembayaran Awal Disetujui') {
            $notif->delete();
            return redirect()->route('setujuclient');
        } elseif ($notif->kategori == 'Project Selesai' || $notif->kategori == 'Pembayaran Akhir Ditolak' || $notif->kategori == 'Pembayaran Revisi Disetujui' || $notif->kategori = 'Refund Masuk') {
            $notif->delete();
            return redirect()->route('bayar2client');
        } elseif ($notif->kategori == 'Pembayaran Akhir Disetujui') {
            $notif->delete();
            return redirect()->route('selesaiclient');
        } elseif ($notif->kategori == 'Project Direvisi') {
            $notif->delete();
            return redirect()->route('revisiclient');
        }
    }

    public function readAllNotifClient() {
        Notification::where('role','client')->where('user_id', Auth::user()->id)->delete();
        return back();
    }


    // public function pesanchtRedirect($id) {
    //     $pesancht = Chat::findOrFail($id);
    //     if ($pesancht->chat == 'detailproreq') {
    //         $pesancht->delete();
    //         return redirect()->route('detailsetujui');
    //     }
    // }

    public function drequestclient(Request $request){
        $client = User::find(Auth::user()->id);
        $notification = Notification::where('role', 'client')->where('user_id', Auth::user()->id)->limit(4)->latest()->get();
        $search = $request->input('search');
        $data = Proreq::whereIn('status', ['draft', 'pending'])
               ->where('user_id', Auth::user()->id)
               ->when(request()->has('search'), function ($query) {
                   $search = request('search');
                   $query->where(function ($subquery) use ($search) {
                       $subquery->where('napro', 'like', '%' . $search . '%')
                                ->orWhere('harga', 'like', '%' . $search . '%');
                   });
               })
               ->paginate(6);
         $data->appends(['search' => $search]);
        $sosmed = Sosmed::all();
        return view('Client.clientproreq',compact('data','sosmed','client','notification'));
    }


    public function createproreq(){
        $notification = Notification::where('role', 'client')->where('user_id', Auth::user()->id)->limit(4)->latest()->get();
        $client = User::find(Auth::user()->id);
        $sosmed = Sosmed::all();
        $fitur = Fitur::all();
        return view ('Client.createproreq', compact('sosmed','fitur','notification','client'));
    }

 public function simpann(Request $request)
{
    $request->validate([
        'napro' => 'required|max:100',
        'deadline' => 'required|regex:/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/|after_or_equal:today',
        'dokumen' => 'nullable|mimes:pdf,txt'
    ], [
        'napro.required' => 'Nama project tidak boleh kosong',
        'napro.max' => 'Nama project tidak lebih dari 100 karakter',
        'deadline.required' => 'Isi deadline terlebih dahulu',
        'deadline.regex' => 'Format deadline tidak valid',
        'deadline.after_or_equal' => 'Deadline tidak boleh hari kemarin',
        'dokumen.mimes' => 'Dokumen pendukung harus berformat: pdf, txt'
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

     public function showproj(Request $request)
     {
        $sosmed = Sosmed::all();
        $client = User::find(Auth::user()->id);
        $notification = Notification::where('role', 'client')->where('user_id', Auth::user()->id)->limit(4)->latest()->get();
        $userid = Auth::user()->id;
        $username = User::where('id', $userid)->value('name');
        return view('Client.createproreq',compact('client','username','notification','sosmed'));
    }

    public function simpannn(Request $request, $id)
    {
        $this->validate($request,[
            'namafitur' => 'required|max:30',
            'deskripsi' => 'required',
        ],[
            'namafitur.required' => 'Fitur tidak boleh kosong',
            'namafitur.max' => 'Nama fitur tidak boleh lebih dari 30 character',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
        ]);

        $sosmed = Sosmed::all();
        $data = Proreq::findOrFail($id);
        $project_id = $data->id;

        Fitur::create([
            'project_id' => $project_id,
            'namafitur' => $request->namafitur,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('editproreq', $id)->with(compact('data', 'sosmed'))->with('success','Berhasil menambahkan fitur!');
    }

    public function update(Request $request){

        $request->validate([
            'napro' => 'required|max:30',
            'deadline' => 'required|regex:/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/|after_or_equal:today',
            'dokumen' => 'nullable|mimes:pdf,txt'
        ], [
            'napro.required' => 'Nama project harus diisi',
            'napro.max' => 'Nama project tidak boleh lebih dari 30',
            'deadline.required' => 'Isi deadline terlebih dahulu',
            'deadline.regex' => 'Format deadline tidak valid',
            'deadline.after_or_equal' => 'Deadline tidak boleh hari kemarin',
            'dokumen.mimes' => 'Dokumen pendukung harus berformat:pdf, txt'
        ]);

        $upProject = [];
        $id = $request->projectid;
        $fitur = Fitur::where('project_id', $id)->count();
        $project = Proreq::findOrFail($id);
        if ($request->has('dokumen')) {
            if (File::exists(public_path().'document/'.$project->dokumen)) {
                unlink(public_path('document/'.$project->dokumen));
            }
            $newFile = $request->file('dokumen');
            $newDocs = $newFile->hashName();
            $newFile->move(public_path('document/'), $newDocs);
            $upProject['dokumen'] = $newDocs;
        } elseif ($fitur == 0 && $project->dokumen == null) {
            return back()->with('error', 'Tambahkan dokumen atau fitur terlebih dahulu');
        }
        $upProject['nama'] = Auth()->user()->name;
        $upProject['napro'] = $request->napro;
        $upProject['deadline'] = $request->deadline;
        $upProject['status'] = 'pending';
        $project->update($upProject);
        $msg = 'Project Masuk';
        $notifDesk = $project->napro.' dari '.$project->nama;
        Notification::where('project_id', $project->id)->delete();
        Notification::create([
            'role' => 'admin',
            'user_id' => $project->user_id,
            'project_id' => $project->id,
            'notif' => $msg,
            'deskripsi' => $notifDesk,
            'kategori' => 'Project Masuk'
        ]);
        return redirect('drequestclient')->with('success', 'Project Berhasil dikirim!');
    }

                    // edit proreq 1

    public function editProreq(Request $request,$id){

        $client = User::find(Auth::user()->id);
        $notification = Notification::where('role', 'client')->where('user_id', Auth::user()->id)->limit(4)->latest()->get();
        $sosmed = Sosmed::all();
        $data = Proreq::findOrFail($id);
        $dataa = Fitur::where('project_id', $id)->get();
        if (Auth::user()->id != $data->user_id || $data->status != 'pending' && $data->status != 'draft' ) {
            return back();
        }
        return view('Client.editproreq',compact('data','sosmed','dataa','client','notification'));
    }

    public function destroyRequest(Request $request) {
        Proreq::find($request->project_id)->delete();
        return back()->with('success','Berhasil Membatalkan Project');
    }
                       // edit proreq 2

    // public function editProreq(Request $request, $id) {
    //     $client = User::find(Auth::user()->id);
    //     $notification = Notification::where('role', 'client')
    //         ->where('user_id', Auth::user()->id)
    //         ->limit(4)
    //         ->latest()
    //         ->get();
    //     $sosmed = Sosmed::all();
    //     $data = Proreq::findOrFail($id);
    //     $dataa = Fitur::where('project_id', $id)->get();

    //     if (Auth::user()->id !== $data->user_id || !in_array($data->status, ['pending', 'draft'])) {
    //         return redirect()->back()->with('error', 'Anda tidak diizinkan untuk mengedit permintaan ini.');
    //     }

    //     return view('Client.editproreq', compact('data', 'sosmed', 'dataa', 'client', 'notification'));
    // }

    // public function destroyRequest(Request $request) {
    //     $project = Proreq::find($request->project_id);

    //     if ($project) {
    //         $project->delete();
    //         return redirect()->back()->with('success', 'Permintaan berhasil dihapus.');
    //     } else {
    //         return redirect()->back()->with('error', 'Permintaan tidak ditemukan.');
    //     }
    // }


public function showFormModal($id)
{
    $client = User::find(Auth::user()->id);
    $data = Fitur::findOrFail($id);
    return view('Client.editproreq', compact('data','client'));
}

public function updateFitur(Request $request, $id)
{
    $this->validate($request,[
        'namafitur' => 'required|max:30',
        'deskripsi' => 'required',
    ],[
        'namafitur.required' => 'Fitur tidak boleh kosong',
        'namafitur.max' => 'Nama fitur tidak boleh lebih dari 30 character',
        'deskripsi.required' => 'Deskripsi tidak boleh kosong',
    ]);

    $fitur = Fitur::findOrFail($id);

    $fitur->namafitur = $request->input('namafitur');
    $fitur->deskripsi = $request->input('deskripsi');

    $fitur->save();

    return back()->with('success','Berhasil mengubah fitur');
}



public function updateProfile(Request $request)
{
    $client = User::find(Auth::user()->id);

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:30',
        'email' => 'required|email|max:40|unique:users,email,' . $client->id,
        'fileInputA' => 'image|mimes:jpeg,jpg,png|max:2048',
        'no_tlp' => 'nullable|min:11|max:14|regex:/^[0-9]+$/',
        'nama_perusahaan' => 'nullable|min:5|max:100',
        'alamat_perusahaan' => 'nullable|min:10|max:255',
    ], [
        'name.required' => 'Nama harus diisi.',
        'name.max' => 'Nama maksimal 30 karakter.',
        'name.string' => 'Nama harus berupa karakter',
        'email.required' => 'Email harus diisi.',
        'email.max' => 'Email maksimal 40 karakter',
        'email.email' => 'Email harus berupa alamat email yang valid.',
        'email.unique' => 'Email sudah digunakan oleh pengguna lain.',
        'fileInputA.image' => 'Profil harus berupa format jpg jpeg png',
        'fileInputA.mimes' => '',
        'fileInputA.max' => 'Ukuran gambar profil tidak boleh melebihi 2 MB.',
        'no_tlp.min' => 'Nomer Telpon Minimal 11',
        'no_tlp.max' => 'Nomer Telpon Maksimal 14',
        'no_tlp.regex' => 'Masukkan format nomor telepon yang benar',
        'nama_perusahaan.min' => 'Nama perusahaan tidak valid',
        'nama_perusahaan.max' => 'Nama perusahaan maksimal 255 karakter',
        'alamat_perusahaan.min' => 'Alamat perusahaan tidak valid',
        'alamat_perusahaan.max' => 'Alamat perusahaan maksimal 255 karakter'
    ]);


    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $updateProfile = [
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'no_tlp' => $request->input('no_tlp'),
        'nama_perusahaan' => $request->input('nama_perusahaan'),
        'alamat_perusahaan' => $request->input('alamat_perusahaan'),
    ];

    if ($request->hasFile('fileInputA')) {
        $oldProfile = $client->profil;

        if ($oldProfile != 'user.jpg') {
            File::delete(public_path('gambar/user-profile/' . $oldProfile));
        }

        $file = $request->file('fileInputA');
        $newFile = $file->hashName();
        $file->move(public_path('gambar/user-profile/'), $newFile);
        $updateProfile['profil'] = $newFile;
    }

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

