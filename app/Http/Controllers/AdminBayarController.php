<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\EWallet;
use Illuminate\Http\Request;

class AdminBayarController extends Controller
{
    public function pending() {
        return view('Admin.pembayaran-pending');
    }
    public function disetujui() {
        return view('Admin.pembayaran-disetujui');
    }

    public function pembayaranDigital() {
        $banks = Bank::all();
        $ewallet = EWallet::all();
        return view('Admin.pembayaran-digital', [
            'banks' => $banks,
            'ewallet' => $ewallet
        ]);
    }

    public function simpanRekening(Request $request, $id) {
        
    }
}
