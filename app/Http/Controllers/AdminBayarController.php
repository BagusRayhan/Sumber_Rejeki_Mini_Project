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
        $propend = proreq::where('statusbayar', 'pembayaran awal')->orWhere('statusbayar','pembayaran akhir')->orWhere('statusbayar','pembayaran revisi')->paginate(6);
        return view('Admin.pembayaran-pending', compact('propend', 'admin', 'notification'));
    }
 
    public function setujuiPembayaran(Request $request, $id)
    {
        $project = Proreq::findOrFail($id);
    
        if ($project->statusbayar === 'pembayaran awal') {
            $project->status = 'setuju';
            $project->statusbayar = null;
            $msg = 'Pembayaran Awal Disetujui';
            $notifDesk = $project->napro;
            Notification::create([
                'role' => 'client',
                'user_id' => $project->user_id,
                'notif' => $msg,
                'deskripsi' => $notifDesk,
                'kategori' => 'Pembayaran Awal Disetujui'
            ]);
        } elseif ($project->statusbayar === 'pembayaran akhir') {
            $project->status = 'selesai';
            $project->statusbayar = 'lunas';
            $msg = 'Pembayaran Akhir Disetujui';
            $notifDesk = $project->napro;
            Notification::create([
                'role' => 'client',
                'user_id' => $project->user_id,
                'notif' => $msg,
                'deskripsi' => $notifDesk,
                'kategori' => 'Pembayaran Akhir Disetujui'
            ]);
        } elseif ($project->statusbayar === 'pembayaran revisi') {
            $project->status = 'selesai';
            $project->statusbayar = 'lunas';
            $project->metode3 = null;
            $msg = 'Pembayaran Revisi Disetujui';
            $notifDesk = $project->napro;
            Notification::create([
                'role' => 'client',
                'user_id' => $project->user_id,
                'notif' => $msg,
                'deskripsi' => $notifDesk,
                'kategori' => 'Pembayaran Revisi Disetujui'
            ]);
        }
        $project->save();
        return back();
    }    

    public function tolakPembayaran(Request $request, $id) {
        $projectol = Proreq::findOrFail($id);
        if ($projectol->statusbayar == 'pembayaran awal') {
            if ($projectol->metodepembayaran !== 'cash') {
                unlink(public_path('gambar/bukti/' . $projectol->buktipembayaran));
            }
            $projectol->statusbayar = 'menunggu pembayaran';
            $projectol->metodepembayaran = null;
            $projectol->metode = null;
            $projectol->buktipembayaran = null;
            $projectol->tanggalpembayaran = null;
            $msg = 'Pembayaran Awal Ditolak';
            $notifDesk = $projectol->napro;
            Notification::create([
                'role' => 'client',
                'user_id' => $projectol->user_id,
                'notif' => $msg,
                'deskripsi' => $notifDesk,
                'kategori' => 'Pembayaran Awal Ditolak'
            ]);
        } elseif ($projectol->statusbayar == 'pembayaran akhir') {
            if ($projectol->metodepembayaran !== 'cash') {
                unlink(public_path('gambar/bukti/' . $projectol->buktipembayaran));
            }
            $projectol->statusbayar = 'belum lunas';
            $projectol->metodepembayaran2 = null;
            $projectol->metode2 = null;
            $projectol->buktipembayaran2 = null;
            $projectol->tanggalpembayaran2 = null;
            $msg = 'Pembayaran Akhir Ditolak';
            $notifDesk = $projectol->napro;
            Notification::create([
                'role' => 'client',
                'user_id' => $projectol->user_id,
                'notif' => $msg,
                'deskripsi' => $notifDesk,
                'kategori' => 'Pembayaran Akhir Ditolak'
            ]);
        } elseif ($projectol->statusbayar == 'pembayaran revisi') {
            if ($projectol->metodepembayaran !== 'cash') {
                unlink(public_path('gambar/bukti/' . $projectol->buktipembayaran));
            }
            $projectol->statusbayar = 'belum lunas';
            $projectol->metodepembayaran3 = null;
            $projectol->metode3 = null;
            $projectol->buktipembayaran3 = null;
            $projectol->tanggalpembayaran3 = null;
            $msg = 'Pembayaran Revisi Ditolak';
            $notifDesk = $projectol->napro;
            Notification::create([
                'role' => 'client',
                'user_id' => $projectol->user_id,
                'notif' => $msg,
                'deskripsi' => $notifDesk,
                'kategori' => 'Pembayaran Revisi Ditolak'
            ]);
        }
        $projectol->save();
        return back();
    }

    public function disetujui() {
        $admin = User::where('role', 'admin')->first();
        $notification = Notification::where('role', 'admin')->limit(4)->latest()->get();
        $approved = Proreq::where('statusbayar', 'lunas')->get();
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

    public function deleteProjectHistory(Request $request) {
        $pro = Proreq::findOrFail($request->project_id);
        $pro->delete();
        return back()->with('success', 'Berhasil menghapus project');
    }
}
