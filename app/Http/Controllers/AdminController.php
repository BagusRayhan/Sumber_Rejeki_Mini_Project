<?php

namespace App\Http\Controllers;

use App\Charts\AnnualyDoneChart;
use Illuminate\Http\Request;
use App\Charts\MonthlyUsersChart;
use App\Models\User;

class AdminController extends Controller
{
    public function index(MonthlyUsersChart $chart, AnnualyDoneChart $ychart) {
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
        $admin->save();

        // Redirect atau melakukan aksi lain setelah update berhasil

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }
}
