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
            return view('Client.bayar', compact('sosmed','client','data','bank','ewallet'));
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
