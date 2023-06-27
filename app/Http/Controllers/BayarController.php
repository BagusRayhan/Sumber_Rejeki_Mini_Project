<?php

namespace App\Http\Controllers;

use App\Models\Sosmed;
use App\Models\transaksi;
use Illuminate\Http\Request;

class BayarController extends Controller
{
        public function bayarclient()
        {
            $sosmed = Sosmed::all();
            $bayar1 = transaksi::where('status', ['menunggu pembayaran'])->get();
            return view('Client.bayar', compact('sosmed','bayar1'));
        }

        public function bayar2client()
        {
            $sosmed = Sosmed::all();
            $bayar2 = transaksi::whereIn('status', ['lunas','belum lunas'])->get();
            return view('Client.bayar2', compact('sosmed','bayar2'));
        }
}
