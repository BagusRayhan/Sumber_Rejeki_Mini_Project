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
            $filename = $file->store('gambar'); 
            $file->move(public_path() . '/gambar', $filename);
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
            $filename = $file->store('gambar'); 
            $file->move(public_path() . '/gambar', $filename);
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

        public function bayar2client()
        {
            $client = User::where('role', 'client')->first();
            $sosmed = Sosmed::all();
            $data = Proreq::all();
            $bayar2 = Proreq::whereIn('statusbayar', ['lunas','belum lunas'])->get();
            return view('Client.bayar2', compact('sosmed','bayar2','client','data'));
        }
}
