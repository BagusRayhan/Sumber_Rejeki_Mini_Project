<?php

namespace App\Http\Controllers;

use App\Models\Bank;
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
        return view('Admin.pembayaran-digital', [
            'banks' => $banks
        ]);
    }

    public function getRekening($id) {

    }

    public function editRekening(Request $request, $id) {
        
    }
}
