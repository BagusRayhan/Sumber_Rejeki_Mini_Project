<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\User;
use App\Models\Proreq;
use App\Models\Sosmed;
use App\Models\EWallet;
use App\Models\transaksi;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BayarController extends Controller
{
        public function bayarclient(Request $request)
        {
            $client = User::find(Auth::user()->id);
            $notification = Notification::where('role', 'client')->where('user_id', Auth::user()->id)->limit(4)->latest()->get();
            $sosmed = Sosmed::all();
            $keyword = $request->input('keyword');
            $data = Proreq::where('napro', 'like', '%'.$keyword.'%')
            ->where('statusbayar','menunggu pembayaran')
            ->where('user_id', Auth::user()->id)
            ->paginate(6);
            $bank = Bank::all();
            $ewallet = EWallet::all();
            return view('Client.bayar', compact('sosmed','client','data','bank','ewallet','notification'));
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

        if ($request->input('metodepembayaran') !== 'cash') {
            $rules['metode'] = 'required';

            if ($request->input('metodepembayaran') === 'bank') {
                $rules['buktipembayaran'] = 'required|mimes:jpg,jpeg,png,pdf|max:2048';
            } elseif ($request->input('metodepembayaran') === 'ewallet') {
                $rules['buktipembayaran'] = 'required|mimes:jpg,jpeg,png,pdf|max:2048';
            }
        }

        $messages = [
            'metodepembayaran.required' => 'Pilih metode pembayaran.',
            'metode.required' => 'Isi layanan pembayaran.',
            'buktipembayaran.required' => 'Unggah bukti pembayaran.',
            'buktipembayaran.mimes' => 'Format file bukti pembayaran harus JPG,PNG,PDF.',
            'buktipembayaran.max' => 'Ukuran file bukti pembayaran maksimal 2 MB.',
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
        Notification::create([
            'role' => 'admin',
            'user_id' => $data->user_id,
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

        if ($request->input('metodepembayaran2') !== 'cash') {
            $rules['metode2'] = 'required';

            if ($request->input('metodepembayaran2') === 'bank') {
                $rules['buktipembayaran2'] = 'required|mimes:jpg,jpeg,png,pdf|max:2048';
            } elseif ($request->input('metodepembayaran2') === 'ewallet') {
                $rules['buktipembayaran2'] = 'required|mimes:jpg,jpeg,png,pdf|max:2048';
            }
        }

        $messages = [
            'metodepembayaran2.required' => 'Pilih metode pembayaran.',
            'metode2.required' => 'Isi layanan pembayaran.',
            'buktipembayaran2.required' => 'Unggah bukti pembayaran.',
            'buktipembayaran2.mimes' => 'Format file bukti pembayaran harus JPG,PNG,PDF.',
            'buktipembayaran2.max' => 'Ukuran file bukti pembayaran maksimal 2 MB.',
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
        Notification::create([
            'role' => 'admin',
            'user_id' => $data->user_id,
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

        if ($request->input('metodepembayaran3') !== 'cash') {
            $rules['metode3'] = 'required';

            if ($request->input('metodepembayaran3') === 'bank') {
                $rules['buktipembayaran3'] = 'required|mimes:jpg,jpeg,png,pdf|max:2048';
            } elseif ($request->input('metodepembayaran3') === 'ewallet') {
                $rules['buktipembayaran3'] = 'required|mimes:jpg,jpeg,png,pdf|max:2048';
            }
        }

        $messages = [
            'metodepembayaran3.required' => 'Pilih metode pembayaran.',
            'metode3.required' => 'Isi layanan pembayaran.',
            'buktipembayaran3.required' => 'Unggah bukti pembayaran.',
            'buktipembayaran3.mimes' => 'Format file bukti pembayaran harus JPG,PNG,PDF.',
            'buktipembayaran3.max' => 'Ukuran file bukti pembayaran maksimal 2 MB.',
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
        Notification::create([
            'role' => 'admin',
            'user_id' => $data->user_id,
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

public function bayar2client(Request $request)
{
    $client = User::find(Auth::user()->id);
    $notification = Notification::where('role', 'client')->where('user_id', Auth::user()->id)->limit(4)->latest()->get();
    $sosmed = Sosmed::all();
    $keyword = $request->input('keyword');
    $bayar2 = Proreq::whereIn('statusbayar', ['lunas','belum lunas'])
                    ->where('napro', 'like', '%'.$keyword.'%')
                    ->where('user_id', Auth::user()->id)
                    ->paginate(5);
    return view('Client.bayar2', compact('sosmed', 'bayar2', 'client','notification'));
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
