<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\EWallet;
use App\Models\User;
use Illuminate\Http\Request;

class AdminBayarController extends Controller
{
    public function pending() {
        $admin = User::where('role', 'admin')->first();
        return view('Admin.pembayaran-pending', [
            'admin' =>$admin
        ]);
    }
    public function disetujui() {
        $admin = User::where('role', 'admin')->first();
        return view('Admin.pembayaran-disetujui', [
            'admin' =>$admin
        ]);
    }

    public function pembayaranDigital() {
        $admin = User::where('role', 'admin')->first();
        $banks = Bank::all();
        $ewallet = EWallet::all();
        return view('Admin.pembayaran-digital', [
            'banks' => $banks,
            'ewallet' => $ewallet,
            'admin' =>$admin
        ]);
    }

    public function updateBank(Request $request) {
        $bank = Bank::findOrFail($request->idrekening);
        $bank->update([
            'rekening' => $request->rekening
        ]);
        return back();
    }
}
