<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\User;
use App\Models\Proreq;
use App\Models\EWallet;
use App\Models\Pembayaran;
use App\Mail\PembayaranAwal;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Mail\PembayaranAkhir;
use App\Mail\PembayaranRevisi;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class AdminBayarController extends Controller
{
    public function pending(Request $request) {
        $admin = User::where('role', 'admin')->first();
        $notification = Notification::where('role', 'admin')->limit(4)->latest()->get();
        $query = $request->input('query');
        $propend = Proreq::where('statusbayar', 'pembayaran awal')->where('napro', 'LIKE', '%'.$query.'%')->orWhere('statusbayar','pembayaran akhir')->orWhere('statusbayar','pembayaran revisi')->paginate(5);
        $propend->appends(['query' => $query]);
        return view('Admin.pembayaran-pending', compact('propend', 'admin', 'notification'));
    }

    public function setujuiPembayaran(Request $request, $id)
    {
        $project = Proreq::findOrFail($id);
        $user = User::find($project->user_id);

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
            Mail::to($user->email)->send(new PembayaranAwal($project));
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
            Mail::to($user->email)->send(new PembayaranAkhir($project));
        } elseif ($project->statusbayar === 'pembayaran revisi') {
            $project->status = 'selesai';
            $project->statusbayar = 'lunas';
            // $project->tanggalpembayaran3 = null;
            $msg = 'Pembayaran Revisi Disetujui';
            $notifDesk = $project->napro;
            Notification::create([
                'role' => 'client',
                'user_id' => $project->user_id,
                'notif' => $msg,
                'deskripsi' => $notifDesk,
                'kategori' => 'Pembayaran Revisi Disetujui'
            ]);
            Mail::to($user->email)->send(new PembayaranRevisi($project));
        }
        $project->save();
        return back()->with('success', 'Berhasil menyetujui pembayaran');
    }

    public function tolakPembayaran(Request $request, $id) {
        $projectol = Proreq::findOrFail($id);
        if ($projectol->statusbayar == 'pembayaran awal') {
            if ($projectol->metodepembayaran != 'cash') {
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
            if ($projectol->metodepembayaran != 'cash') {
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
            if ($projectol->metodepembayaran != 'cash') {
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
        return back()->with('success','Berhasil menolak pembayaran');
    }

 public function disetujui(Request $request) {
    $admin = User::where('role', 'admin')->first();
    $query = $request->input('query');
    $notification = Notification::where('role', 'admin')->limit(4)->latest()->get();
    $approved = Proreq::where('statusbayar', 'lunas')->where('napro', 'LIKE', '%'.$query.'%')->paginate(10);
    $approved->appends(['query' => $query]);
    return view('Admin.pembayaran-disetujui', compact('approved', 'admin', 'notification', 'query'));
}

    public function pengajuanRefund(Request $request) {
        $admin = User::where('role', 'admin')->first();
        $query = $request->input('query');
        $notification = Notification::where('role', 'admin')->limit(4)->latest()->get();
        $projectRefund = Proreq::whereIn('status', ['refund','refund pending'])->where('napro', 'LIKE', '%'.$query.'%')->paginate(6);
        $projectRefund->appends(['query' => $query]);
        return view('Admin.pengajuan-refund', compact('projectRefund','notification','admin'));
    }

    public function payRefund(Request $request) {
        $request->validate([
            'buktiRefund' => 'required|mimes:png,jpg'
        ],[
            'buktiRefund.required' => 'Bukti tidak boleh kosong',
            'buktiRefund.mimes' => 'Bukti tidak valid'
        ]);
        $pro = Proreq::findOrFail($request->project_id);
        $file = $request->file('buktiRefund');
        $fileName = $file->hashName();
        $file->move(public_path('gambar/bukti/'), $fileName);
        $pro->update([
            'status' => 'selesai',
            'statusbayar' => 'lunas',
            'buktiRefund' => $fileName
        ]);

        $msg = 'Refund Masuk';
        $notifDesk = $pro->napro;
        Notification::create([
            'role' => 'client',
            'user_id' => $pro->user_id,
            'notif' => $msg,
            'deskripsi' => $notifDesk,
            'kategori' => 'Refund Masuk'
        ]);

        return back()->with('success','Berhasil melakukan pembayaran');
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
            'rekening' => 'required|min:10|max:18|regex:/^[0-9]+$/'
        ], [
            'rekening.required' => 'Rekening tidak boleh kosong',
            'rekening.min' => 'Rekening tidak valid',
            'rekening.max' => 'Rekening tidak valid',
            'rekening.regex' => 'Rekening tidak valid'
        ]);
        $bank->update([
            'rekening' => $request->rekening
        ]);
        return back()->with('success', 'Berhasil mengubah Rekening');
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
        return back()->with('success', 'Berhasil mengubah E-Wallet');
    }

    public function deleteProjectHistory(Request $request) {
        $pro = Proreq::findOrFail($request->project_id);
        $pro->delete();
        return back()->with('success', 'Berhasil menghapus project');
    }
}
