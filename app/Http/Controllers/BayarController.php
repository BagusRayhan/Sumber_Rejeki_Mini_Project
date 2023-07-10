<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\User;
use App\Models\Proreq;
use App\Models\Sosmed;
use App\Models\EWallet;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BayarController extends Controller
{
        public function bayarclient(Request $request)
        {
            $client = User::where('role', 'client')->first();
            $sosmed = Sosmed::all();
            $keyword = $request->input('keyword');
            $data = Proreq::where('napro', 'like', '%'.$keyword.'%')->paginate(5);
            $bank = Bank::all();
            $ewallet = EWallet::all();
            return view('Client.bayar', compact('sosmed','client','data','bank','ewallet'));
        }

        public function ambilrek(Request $request){
            $rek = Bank::where('nama',$request->id)->first();
            return $rek->rekening;
        }

        public function updatebayar(Request $request, $id){
        $client = User::where('role', 'client')->first();
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

        return redirect()->route('bayarclient')->with('success', 'Berhasil di bayar!')->with(compact('sosmed', 'client', 'data'));
    }

        public function updatebayarakhir(Request $request, $id){
        $client = User::where('role', 'client')->first();
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
        $data->statusbayar = 'pending';
        $data->tanggalpembayaran2 = now();
        $data->save();
      

        return redirect()->route('bayar2client')->with('success', 'Berhasil di bayar!')->with(compact('sosmed', 'client', 'data'));
    }


            public function updatebayarr(Request $request, $id){
            $client = User::where('role', 'client')->first();
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
    $client = User::where('role', 'client')->first();
    $sosmed = Sosmed::all();
    $data = Proreq::all();
    $keyword = $request->input('keyword');
    $bayar2 = Proreq::whereIn('statusbayar', ['lunas','belum lunas'])
                    ->where('napro', 'like', '%'.$keyword.'%')
                    ->paginate(5);
    return view('Client.bayar2', compact('sosmed', 'bayar2', 'client', 'data'));
}

public function deleteproj($id)
{
    $data = Proreq::findOrFail($id);
    $data->delete();
    return redirect()->route('bayarclient');
}

public function deleteAll(Request $request)
{
    $ids = $request->input('ids');

    if (!is_array($ids)) {
        return redirect()->back()->with('error', 'Data yang dipilih tidak valid');
    }

    Proreq::whereIn('id', $ids)->delete();

    return redirect()->back()->with('success', 'Data berhasil dihapus');
}


    public function ambildata($id){
    // Ambil data proyek berdasarkan ID
    $proreq = Proreq::findOrFail($id);

    // Buat array dengan data yang akan dikembalikan sebagai respons JSON
    $data = [
        'napro' => $proreq->napro,
        'harga' => $proreq->harga,
    ];

    // Kembalikan data dalam format JSON
    return response()->json($data);

}


}