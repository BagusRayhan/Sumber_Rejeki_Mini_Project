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
use Illuminate\Support\Facades\File;

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
        $admin = User::where('role', 'admin')->first();
        $clientCounter = User::where('role', 'client')->count();
        $tolakCounter = Proreq::where('status', 'tolak')->count();
        $progressCounter = Proreq::where('status', 'setuju')->count();
        $selesaiCounter = Proreq::where('status', 'selesai')->count();
        $incomePayment = Pembayaran::limit(4)->latest()->get();
        $incomeProject = proreq::limit(4)->latest()->get();
        $message = Chat::limit(4)->latest()->get();

        return view('Admin.index', [
            'chart' => $chartData,
            'admin' => $admin,
            'clientCounter' => $clientCounter,
            'tolakCounter' => $tolakCounter,
            'progressCounter' => $progressCounter,
            'selesaiCounter' => $selesaiCounter,
            'chart' => $chart->build(),
            'ychart' => $ychart->build(),
            'incomePayment' => $incomePayment,
            'incomeProject' => $incomeProject,
            'message' => $message
        ]);
    }

    public function updateProfile(Request $request)
    {
        $upProfile = [];
        $admin = User::where('role', 'admin')->first();
        if ($request->has('fileInputA')) {
            if (File::exists(public_path('gambar/user-profile/' . $admin->profil))) {
                unlink(public_path('gambar/user-profile/' . $admin->profil));
            }
            $file = $request->file('fileInputA');
            $newFile = $file->hashName();
            $file->move(public_path('gambar/user-profile/'), $newFile);
            $upProfile['profil'] = $newFile;
            $upProfile['name'] = $request->input('name');
            $upProfile['email'] = $request->input('email');
            $admin->update($upProfile);
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');

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
    }
}
