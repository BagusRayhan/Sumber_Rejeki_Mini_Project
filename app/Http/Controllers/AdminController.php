<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\proreq;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Charts\AnnualyDoneChart;
use App\Charts\MonthlyUsersChart;

class AdminController extends Controller
{
    public function index(MonthlyUsersChart $chart, AnnualyDoneChart $ychart) {
        $admin = User::where('role', 'admin')->first();
        $clientCounter = User::where('role', 'client')->count();
        $incomePayment = Pembayaran::limit(4)->latest()->get();
        $incomeProject = proreq::limit(4)->latest()->get();
        $message = Chat::limit(4)->latest()->get();

        return view('Admin.index', [
            'admin' => $admin,
            'clientCounter' => $clientCounter,
            'chart' => $chart->build(),
            'ychart' => $ychart->build(),
            'incomePayment' => $incomePayment,
            'incomeProject' => $incomeProject,
            'message' => $message
        ]);
    }

    public function updateProfile(Request $request)
    {
        $admin = User::where('role', 'admin')->first();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');

        // if ($request->hasFile('profile_image')) {
        //     $file = $request->file('profile_image');
        //     $fileName = time() . '_' . $file->getClientOriginalName();

        //     // Simpan file gambar ke folder "public/image" di dalam direktori storage
        //     $path = $file->storeAs('public/image', $fileName);

        //     // Update kolom "profil" pada tabel users dengan path file yang baru
        //     $admin->profil = 'img/' . $fileName;
        // }

        $admin->save();

        // Redirect atau melakukan aksi lain setelah update berhasil
        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }
}
