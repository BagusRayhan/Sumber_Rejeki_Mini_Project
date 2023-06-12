<?php

namespace App\Http\Controllers;

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
        return view('Admin.pembayaran-digital');
    }
}
