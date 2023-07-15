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
            $data = Proreq::where('napro', 'like', '%'.$keyword.'%')->where('user_id', Auth::user()->id)->paginate(5);
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

        if ($request->hasFile('buktipembayaran')) {
            $file = $request->file('buktipembayaran');
            $filename = $file->store('gambar/bukti');
            $file->move(public_path() . '/gambar/bukti', $filename);
            $data->buktipembayaran = $filename;
        }

        $data->status = null;
        $data->metodepembayaran = $request->input('metodepembayaran');
        $data->metode = $request->input('metode');
        $data->statusbayar = 'pending';
        $data->tanggalpembayaran = now();
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

        if ($request->hasFile('buktipembayaran2')) {
            $file = $request->file('buktipembayaran2');
            $filename = $file->store('gambar/bukti');
            $file->move(public_path() . '/gambar/bukti', $filename);
            $data->buktipembayaran2 = $filename;
        }

        $data->status = null;
        $data->metodepembayaran2 = $request->input('metodepembayaran2');
        $data->metode2 = $request->input('metode2');
        $data->statusbayar = 'pending2';
        $data->tanggalpembayaran2 = now();
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


            public function updatebayarr(Request $request, $id){
            $client = User::find(Auth::user()->id);
            $sosmed = Sosmed::all();
            $data = Proreq::findOrFail($id);

            $data->status = null;
            $data->metodepembayaran = $request->input('metodepembayaran');
            $data->statusbayar = 'pending';
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
