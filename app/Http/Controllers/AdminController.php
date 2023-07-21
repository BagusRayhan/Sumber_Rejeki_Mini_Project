<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\Proreq;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Charts\AnnualyDoneChart;
use App\Charts\MonthlyUsersChart;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(MonthlyUsersChart $chart, AnnualyDoneChart $ychart) {
        $selesaiProjects = Proreq::where('status', 'selesai')
        ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count')
        ->toArray();

        $chartData = $chart->build()->addData('Project Selesai', $selesaiProjects);
        // $admin = User::where('role', 'admin')->first();
        $admin = User::find(Auth::user()->id);
        $clientCounter = User::where('role', 'client')->count();
        $tolakCounter = Proreq::where('status', 'tolak')->count();
        $progressCounter = Proreq::where('status', 'setuju')->count();
        $selesaiCounter = Proreq::where('status', 'selesai')->count();

        $incomePayment = Proreq::whereHas('user', function($query) {
            $query->where('role', 'client');
        })->whereIn('statusbayar', ['pending', 'success'])->limit(4)->latest()->get();

        $incomeProject = Proreq::whereHas('user', function($query) {
            $query->where('role', 'client');
        })->whereIn('status', ['pending'])->limit(4)->latest()->get();


        // $pesancht = Chat::whereHas('user', function($query) {
        //     $query->where('role', 'admin');
        //     })->limit(4)->latest()->get();

        $message = Proreq::query()
        ->whereHas('projectchat')
        ->with('projectchat')
        ->limit(4)
        ->latest()
        ->get();

        // dd($message);

        // $message = Chat::whereHas('user', function($query) {
        //     $query->where('role', 'client');
        // })->limit(4)->latest()->get();

        $notification = Notification::where('role', 'admin')->limit(4)->latest()->get();


        return view('Admin.index', [
            'chart' => $chartData,
            'admin' => $admin,
            'clientCounter' => $clientCounter,
            'tolakCounter' => $tolakCounter,
            'progressCounter' => $progressCounter,
            'selesaiCounter' => $selesaiCounter,
            'ychart' => $ychart->build(),
            'incomePayment' => $incomePayment,
            'incomeProject' => $incomeProject,
            'message' => $message,
            'notification' => $notification
        ]);
    }

    public function notifRedirect($id) {
        $notif = Notification::findOrFail($id);
        if ($notif->kategori == 'Project Masuk') {
            $notif->delete();
            return redirect()->route('projectreq');
        } elseif ($notif->kategori == 'Pembayaran Masuk') {
            $notif->delete();
            return redirect()->route('pending-bayar-admin');
        } elseif ($notif->kategori == 'Revisi Project') {
            $notif->delete();
            return redirect()->route('projectselesai');
        }
    }
    public function readAllNotif() {
        Notification::where('role', 'admin')->delete();
        return back();
    }

    public function updateProfile(Request $request)
    {
        $admin = User::find(Auth::user()->id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $admin->id,
            'fileInputA' => 'image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'email.unique' => 'Email sudah digunakan oleh pengguna lain.',
            'fileInputA.image' => 'Profil harus berupa gambar (JPG, JPEG, PNG).',
            'fileInputA.mimes' => '',
            'fileInputA.max' => 'Ukuran gambar profil tidak boleh melebihi 2 MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $upProfile = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];

        if ($request->hasFile('fileInputA')) {
            $oldProfile = $admin->profil;

            if ($oldProfile !== 'user.jpg') {
                File::delete(public_path('gambar/user-profile/' . $oldProfile));
            }

            $file = $request->file('fileInputA');
            $newFile = $file->hashName();
            $file->move(public_path('gambar/user-profile/'), $newFile);
            $upProfile['profil'] = $newFile;
        }

        $admin->update($upProfile);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }

}
// $upQR = [];
// $ewallet = EWallet::find($request->idewallet);
// if ($request->has('qrcode')) {
//     // $request->validate([
//     //     'qrcode' => 'mimes:jpg,jpeg,png'
//     // ], [
//     //     'qrcode.mimes' => 'QR tidak valid'
//     // ]);
//     if (File::exists(public_path('gambar/qr/' . $ewallet->qrcode))) {
//         unlink(public_path('gambar/qr/' . $ewallet->qrcode));
//     }
//     $file = $request->file('qrcode');
//     $newQRCode = $file->hashName();
//     $file->move(public_path('gambar/qr/'), $newQRCode);
//     $upQR['qrcode'] = $newQRCode;
//     $ewallet->update($upQR);
// }
// return back();
