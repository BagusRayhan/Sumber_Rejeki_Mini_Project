<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\User;
use App\Models\proreq;
use App\Models\EWallet;
use App\Models\Pembayaran;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminBayarController extends Controller
{
    public function pending() {
        $admin = User::where('role', 'admin')->first();
        $notification = Notification::where('role', 'admin')->limit(4)->latest()->get();
        $propend = proreq::where('statusbayar', 'pending')->orWhere('status','pending2')->get();
        return view('Admin.pembayaran-pending', compact('propend', 'admin', 'notification'));
    }

    public function setujuiPembayaran(Request $request, $id) {
        $project = Proreq::findOrFail($id);
        $project->status = 'setuju';
        $project->statusbayar = null;
        $project->save();

        $msg = 'Pembayaran Disetujui';
        $notifDesk = $project->napro;
        Notification::create([
            'role' => 'client',
            'user_id' => $project->user_id,
            'notif' => $msg,
            'deskripsi' => $notifDesk,
            'kategori' => 'Pembayaran Disetujui'
        ]);
        return back();
    }

    public function tolakPembayaran(Request $request, $id) {
        $projectol = Proreq::findOrFail($id);

        $projectol->statusbayar = 'menunggu pembayaran';
        $projectol->metodepembayaran = null;
        $projectol->metode = null;
        $projectol->buktipembayaran = null;
        $projectol->tanggalpembayaran = null;
        $projectol->save();

        $msg = 'Pembayaran Ditolak';
        $notifDesk = $projectol->napro;
        Notification::create([
            'role' => 'client',
            'user_id' => $projectol->user_id,
            'notif' => $msg,
            'deskripsi' => $notifDesk,
            'kategori' => 'Pembayaran Ditolak'
        ]);

        return back();
    }

    public function disetujui() {
        $admin = User::where('role', 'admin')->first();
        $notification = Notification::where('role', 'admin')->limit(4)->latest()->get();
        $approved = Pembayaran::where('status', 'disetujui')->get();
        return view('Admin.pembayaran-disetujui', compact('approved', 'admin', 'notification'));
    }

    public function pembayaranDigital() {
        $admin = User::where('role', 'admin')->first();
        $notification = Notification::where('role', 'admin')->limit(4)->latest()->get();
        $banks = Bank::all();
        $ewallet = EWallet::all();
        return view('Admin.pembayaran-digital', [
            'banks' => $banks,
            'ewallet' => $ewallet,
            'admin' =>$admin,
            'notification' => $notification
        ]);
    }

    public function updateBank(Request $request) {
        $bank = Bank::findOrFail($request->idrekening);
        $valid = $request->validate([
            'rekening' => 'required|numeric'
        ], [
            'rekening.required' => 'Rekening tidak boleh kosong',
            'rekening.numeric' => 'Rekening tidak valid'
        ]);
        $bank->update([
            'rekening' => $request->rekening
        ]);
        return back();
    }

    public function updateEWallet(Request $request) {
        $upQR = [];
        $ewallet = EWallet::find($request->idewallet);
        $request->validate([
            'qrcode' => 'mimes:jpg,png'
        ], [
            'qrcode.mimes' => 'Foto tidak valid',
        ]);
        if ($request->has('qrcode')) {
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
