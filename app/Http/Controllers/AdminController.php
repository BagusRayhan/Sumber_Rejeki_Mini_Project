<?php

namespace App\Http\Controllers;

use App\Charts\AnnualyDoneChart;
use Illuminate\Http\Request;
use App\Charts\MonthlyUsersChart;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index(MonthlyUsersChart $chart, AnnualyDoneChart $ychart)
    {
        $admin = User::where('role', 'admin')->first();
        return view('Admin.index', [
            'admin' => $admin,
            'clientCounter' => User::where('role', 'client')->count(),
            'chart' => $chart->build(),
            'ychart' => $ychart->build(),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $admin = User::where('role', 'admin')->first();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Simpan file gambar ke folder "public/image" di dalam direktori storage
            $path = $file->storeAs('public/image', $fileName);

            // Update kolom "profil" pada tabel users dengan path file yang baru
            $admin->profil = 'img/' . $fileName;
        }

        $admin->save();

        // Redirect atau melakukan aksi lain setelah update berhasil
        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }
}
