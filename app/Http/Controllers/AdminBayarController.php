<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\EWallet;
use App\Models\User;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminBayarController extends Controller
{
    public function pending() {
        $admin = User::where('role', 'admin')->first();
        $propend = Pembayaran::where('status', 'pending')->get();
        return view('Admin.pembayaran-pending', compact('propend', 'admin'));
    }

    public function setujuiPembayaran(Request $request) {
        $project = Pembayaran::find($request->idpropend);
        $project->update([
            'status' => 'disetujui'
        ]);
        return back();
    }

    public function disetujui() {
        $admin = User::where('role', 'admin')->first();
        $approved = Pembayaran::where('status', 'disetujui')->get();
        return view('Admin.pembayaran-disetujui', compact('approved', 'admin'));
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

    public function updateEWallet(Request $request) {
        $upQR = [];
        $ewallet = EWallet::find($request->idewallet);
        if ($request->has('qrcode')) {
            // $request->validate([
            //     'qrcode' => 'mimes:jpg,jpeg,png'
            // ], [
            //     'qrcode.mimes' => 'QR tidak valid'
            // ]);
            if (File::exists(public_path('gambar/qr/' . $ewallet->qrcode))) {
                unlink(public_path('gambar/qr/' . $ewallet->qrcode));
            }
            $file = $request->file('qrcode');
            $newQRCode = $file->hashName();
            $file->move(public_path('gambar/qr/'), $newQRCode);
            $upQR['qrcode'] = $newQRCode;
            $ewallet->update($upQR);
        }
        return back();
    }
}
