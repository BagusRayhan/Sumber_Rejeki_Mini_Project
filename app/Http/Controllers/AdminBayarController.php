<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminBayarController extends Controller
{
    public function persetujuan() {
        return view('Admin.persetujuan-pembayaran');
    }

    public function pembayaranDigital() {
        return view('Admin.pembayaran-digital');
    }
}
