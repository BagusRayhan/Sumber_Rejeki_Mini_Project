<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\User;

use App\Mail\Selesai;
use App\Models\Proreq;
use App\Models\Sosmed;
use App\Models\EWallet;
use App\Models\transaksi;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BayarController extends Controller
{
        public function bayarclient(Request $request)
        {
            $client = User::find(Auth::user()->id);
            $notification = Notification::where('role', 'client')->where('user_id', Auth::user()->id)->limit(4)->latest()->get();
            $sosmed = Sosmed::all();
            $keyword = $request->input('keyword');
            $data = Proreq::whereIn('statusbayar', ['menunggu pembayaran','pembayaran awal'])
            ->where('napro', 'like', '%'.$keyword.'%')
            ->where('user_id', Auth::user()->id)
            ->paginate(6);
             $data->appends(['keyword' => $keyword]);
            $bank = Bank::all();
            $ewallet = EWallet::all();
            $dana = EWallet::findOrFail(1);
            $ovo = EWallet::findOrFail(2);
            $gopay = EWallet::findOrFail(3);
            $linkaja = EWallet::findOrFail(4);
            // $mailData = [
            //     'title' => 'Mail from Admin',
            //     'body' => 'Project telah disetujui'
            // ];

            return view('Client.bayar', compact('sosmed','client','data','bank','ewallet','notification','dana','ovo','gopay','linkaja'));
        }

        public function ambilrek(Request $request){
            $rek = Bank::where('nama',$request->id)->first();
            return $rek->rekening;
        }

        public function updatebayar(Request $request, $id){
        $client = User::find(Auth::user()->id);
        $sosmed = Sosmed::all();
        $data = Proreq::findOrFail($id);

        $rules = [
            'metodepembayaran' => 'required',
        ];

        if ($request->input('metodepembayaran') != 'cash') {
            $rules['metode'] = 'required';

            if ($request->input('metodepembayaran') === 'bank' || $request->input('metodepembayaran') === 'ewallet') {
                $rules['buktipembayaran'] = 'required|mimes:jpg,jpeg,png|max:2048';
            }
        }

        $rules['tanggalpembayaran'] = 'date|after_or_equal:today';

        $messages = [
            'metodepembayaran.required' => 'Pilih metode pembayaran.',
            'metode.required' => 'Isi layanan pembayaran.',
            'buktipembayaran.required' => 'Unggah bukti pembayaran.',
            'buktipembayaran.mimes' => 'Format file bukti pembayaran harus JPG, PNG, atau JPEG.',
            'buktipembayaran.max' => 'Ukuran file bukti pembayaran maksimal 2 MB.',
            'tanggalpembayaran.required' => 'Isi tanggal pembayaran.',
            'tanggalpembayaran.date' => 'Format tanggal pembayaran tidak valid.',
            'tanggalpembayaran.after_or_equal' => 'Tanggal pembayaran tidak boleh hari kemarin.',
        ];

        $request->validate($rules, $messages);


        if ($request->hasFile('buktipembayaran')) {
            $file = $request->file('buktipembayaran');
            $fileName = $file->hashName();
            $file->move(public_path('gambar/bukti/'), $fileName);
            $data->buktipembayaran = $fileName;
        }

        $data->status = null;
        $data->metodepembayaran = $request->input('metodepembayaran');
        $data->metode = $request->input('metode');
        $tanggalpembayaran = $request->input('tanggalpembayaran');
        $data->statusbayar = 'pembayaran awal';
        if($tanggalpembayaran){
            $data->tanggalpembayaran = $tanggalpembayaran;
        } else {
            $data->tanggalpembayaran = now();
        }
        $data->save();

        $msg = 'Pembayaran Masuk';
        $notifDesk = 'Biaya awal '.$data->napro;
        Notification::where('project_id', $data->id)->delete();
        Notification::create([
            'role' => 'admin',
            'user_id' => $data->user_id,
            'project_id' => $data->id,
            'notif' => $msg,
            'deskripsi' => $notifDesk,
            'kategori' => 'Pembayaran Masuk'
        ]);

        return redirect()->route('bayarclient')->with('success', 'Berhasil di bayar!')->with(compact('sosmed', 'client', 'data'));
    }

        public function updatebayarakhir(Request $request, $id){
        $client = User::find(Auth::user()->id);
        $sosmed = Sosmed::all();
        $data = Proreq::findOrFail($id);

        $rules = [
            'metodepembayaran2' => 'required',
        ];

        if ($request->input('metodepembayaran2') != 'cash') {
            $rules['metode2'] = 'required';

            if ($request->input('metodepembayaran2') === 'bank' || $request->input('metodepembayaran2') === 'ewallet') {
                $rules['buktipembayaran2'] = 'required|mimes:jpg,jpeg,png|max:2048';
            }
        }

        $rules['tanggalpembayaran2'] = 'date|after_or_equal:today';

        $messages = [
            'metodepembayaran2.required' => 'Pilih metode pembayaran.',
            'metode2.required' => 'Isi layanan pembayaran.',
            'buktipembayaran2.required' => 'Unggah bukti pembayaran.',
            'buktipembayaran2.mimes' => 'Format file bukti pembayaran harus JPG, PNG, atau JPEG.',
            'buktipembayaran2.max' => 'Ukuran file bukti pembayaran maksimal 2 MB.',
            'tanggalpembayaran2.required' => 'Isi tanggal pembayaran.',
            'tanggalpembayaran2.date' => 'Format tanggal pembayaran tidak valid.',
            'tanggalpembayaran2.after_or_equal' => 'Tanggal pembayaran tidak boleh hari kemarin.',
        ];

        $request->validate($rules, $messages);


        if ($request->hasFile('buktipembayaran2')) {
            $file = $request->file('buktipembayaran2');
            $fileName = $file->hashName();
            $file->move(public_path('gambar/bukti/'), $fileName);
            $data->buktipembayaran2 = $fileName;
        }

        $data->status = null;
        $data->metodepembayaran2 = $request->input('metodepembayaran2');
        $data->metode2 = $request->input('metode2');
        $tanggalpembayaran2 = $request->input('tanggalpembayaran2');
        $data->statusbayar = 'pembayaran akhir';
        if($tanggalpembayaran2){
            $data->tanggalpembayaran2 = $tanggalpembayaran2;
        } else {
            $data->tanggalpembayaran2 = now();
        }
        $data->save();

        $msg = 'Pembayaran Masuk';
        $notifDesk = 'Biaya akhir '.$data->napro;
        Notification::where('project_id', $data->id)->delete();
        Notification::create([
            'role' => 'admin',
            'user_id' => $data->user_id,
            'project_id' => $data->id,
            'notif' => $msg,
            'deskripsi' => $notifDesk,
            'kategori' => 'Pembayaran Masuk'
        ]);


        return redirect()->route('bayar2client')->with('success', 'Berhasil di bayar!')->with(compact('sosmed', 'client', 'data'));
    }

    public function updatebayarrevisi(Request $request, $id){
        $client = User::find(Auth::user()->id);
        $sosmed = Sosmed::all();
        $data = Proreq::findOrFail($id);

        $rules = [
            'metodepembayaran3' => 'required',
        ];

        if ($request->input('metodepembayaran3') != 'cash') {
            $rules['metode3'] = 'required';

            if ($request->input('metodepembayaran3') === 'bank' || $request->input('metodepembayaran3') === 'ewallet') {
                $rules['buktipembayaran3'] = 'required|mimes:jpg,jpeg,png|max:2048';
            }
        }

        $rules['tanggalpembayaran3'] = 'date|after_or_equal:today';

        $messages = [
            'metodepembayaran3.required' => 'Pilih metode pembayaran.',
            'metode3.required' => 'Isi layanan pembayaran.',
            'buktipembayaran3.required' => 'Unggah bukti pembayaran.',
            'buktipembayaran3.mimes' => 'Format file bukti pembayaran harus JPG, PNG, atau JPEG.',
            'buktipembayaran3.max' => 'Ukuran file bukti pembayaran maksimal 2 MB.',
            'tanggalpembayaran3.required' => 'Isi tanggal pembayaran.',
            'tanggalpembayaran3.date' => 'Format tanggal pembayaran tidak valid.',
            'tanggalpembayaran3.after_or_equal' => 'Tanggal pembayaran tidak boleh hari kemarin.',
        ];

        $request->validate($rules, $messages);

        if ($request->hasFile('buktipembayaran3')) {
            $file = $request->file('buktipembayaran3');
            $fileName = $file->hashName();
            $file->move(public_path('gambar/bukti/'), $fileName);
            $data->buktipembayaran3 = $fileName;
        }

        $data->status = null;
        $data->metodepembayaran3 = $request->input('metodepembayaran3');
        $data->metode3 = $request->input('metode3');
        $tanggalpembayaran3 = $request->input('tanggalpembayaran3');
        $data->statusbayar = 'pembayaran revisi';
        if($tanggalpembayaran3){
            $data->tanggalpembayaran3 = $tanggalpembayaran3;
        } else {
            $data->tanggalpembayaran3 = now();
        }
        $data->save();

        $msg = 'Pembayaran Masuk';
        $notifDesk = 'Biaya Revisi '.$data->napro;
        Notification::where('project_id', $data->id)->delete();
        Notification::create([
            'role' => 'admin',
            'user_id' => $data->user_id,
            'project_id' => $data->id,
            'notif' => $msg,
            'deskripsi' => $notifDesk,
            'kategori' => 'Pembayaran Masuk'
        ]);


        return redirect()->route('bayar2client')->with('success', 'Berhasil di bayar!')->with(compact('sosmed', 'client', 'data'));
    }

            public function updatebayarr(Request $request, $id){
            $client = User::find(Auth::user()->id);
            $sosmed = Sosmed::all();
            $data = Proreq::findOrFail($id);

            $data->status = null;
            $data->metodepembayaran = $request->input('metodepembayaran');
            $data->statusbayar = 'pembayaran awal';
            $data->save();

            return redirect()->route('bayarclient')->with('success', 'Berhasil di bayar!')->with(compact('sosmed', 'client', 'data'));
        }


// public function bayar2client(Request $request)
// {
//     $client = User::find(Auth::user()->id);
//     $notification = Notification::where('role', 'client')->where('user_id', Auth::user()->id)->limit(4)->latest()->get();
//     $sosmed = Sosmed::all();
//     $keyword = $request->input('keyword');
//     $data = Proreq::all();
//     $dana = EWallet::find(1);
//     $ovo = EWallet::find(2);
//     $gopay = EWallet::find(3);
//     $linkaja = EWallet::find(4);
//     $bayar2 = Proreq::whereIn('statusbayar', ['lunas','belum lunas','pembayaran akhir','pembayaran revisi'])
//                     ->orWhere('status', 'refund pending')
//                     ->where('napro', 'like', '%'.$keyword.'%')
//                     ->where('user_id', Auth::user()->id)
//                     ->paginate(5);
//      $bayar2->appends(['keyword' => $keyword]);
//     return view('Client.bayar2', compact('sosmed', 'bayar2', 'client','notification','data','dana','ovo','gopay','linkaja'));
// }

public function bayar2client(Request $request)
{
    $user_id = Auth::user()->id;

    $client = User::find($user_id);
    $notification = Notification::where('role', 'client')
        ->where('user_id', $user_id)
        ->limit(4)
        ->latest()
        ->get();

    $sosmed = Sosmed::all();
    $keyword = $request->input('keyword');
    $data = Proreq::all();
    $dana = EWallet::find(1);
    $ovo = EWallet::find(2);
    $gopay = EWallet::find(3);
    $linkaja = EWallet::find(4);

    $bayar2 = Proreq::where(function ($query) use ($user_id) {
            $query->whereIn('statusbayar', ['lunas','belum lunas', 'pembayaran akhir', 'pembayaran revisi'])
                ->orWhere('status', 'refund pending');
        })
        ->where('napro', 'like', '%' . $keyword . '%')
        ->where('user_id', $user_id)
        ->paginate(5);

    $bayar2->appends(['keyword' => $keyword]);

    return view('Client.bayar2', compact('sosmed', 'bayar2', 'client','notification','data','dana','ovo','gopay','linkaja'));
}


public function deleteproj($id)
{
    $data = Proreq::findOrFail($id);
    $data->delete();
    return redirect()->route('bayarclient');
}

public function deleteAll(Request $request)
{
    $ids = $request->ids;
    Proreq::whereIn('id',$ids)->delete();
    return response()->json(["succes"=>"data berhasil dihapus"]);
}

    public function ambildata($id){
    $proreq = Proreq::findOrFail($id);

    $data = [
        'napro' => $proreq->napro,
        'harga' => $proreq->harga,
    ];

    return response()->json($data);

}


}
