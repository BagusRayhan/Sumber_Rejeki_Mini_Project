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
        public function bayarclient()
        {
            $client = User::where('role', 'client')->first();
            $sosmed = Sosmed::all();
            $data = Proreq::all();
            $bank = Bank::all();
            $ewallet = EWallet::all();
            $dana = EWallet::where('nama', 'dana')->first();
            $ovo = EWallet::where('nama', 'ovo')->first();
            $gopay = EWallet::where('nama', 'gopay')->first();
            $linkaja = EWallet::where('nama', 'linkaja')->first();
            $bri = Bank::where('nama','Bank BRI')->first();
            $bca = Bank::where('nama','Bank BCA')->first();
            $mandiri = Bank::where('nama','Bank Mandiri')->first();
            return view('Client.bayar', compact('sosmed','client','data','bank','ewallet', 'dana', 'ovo', 'gopay', 'linkaja','bri','bca','mandiri'));
        }

        public function updatebayar(Request $request, $id){
        $client = User::where('role', 'client')->first();
        $sosmed = Sosmed::all();
        $data = Proreq::findOrFail($id);

        // Mengunggah file gambar
        if ($request->hasFile('buktipembayaran')) {
            $file = $request->file('buktipembayaran');
            $filename = $file->store('gambar'); // Ubah "path/to/storage" sesuai dengan lokasi penyimpanan yang diinginkan
            $file->move(public_path() . '/gambar', $filename);
            $data->buktipembayaran = $filename;
        }

        $data->status = null;
        $data->metodepembayaran = $request->input('metodepembayaran');
        $data->metode = $request->input('metode');
        $data->statusbayar = 'pending';
        $data->save();

        return redirect()->route('bayarclient')->with('success', 'Berhasil di bayar!')->with(compact('sosmed', 'client', 'data'));
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

        public function bayar2client()
        {
            $client = User::where('role', 'client')->first();
            $sosmed = Sosmed::all();
            $data = Proreq::all();
            $bayar2 = transaksi::whereIn('status', ['lunas','belum lunas'])->get();
            return view('Client.bayar2', compact('sosmed','bayar2','client','data'));
        }
}
