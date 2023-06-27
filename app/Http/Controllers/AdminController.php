<?php

namespace App\Http\Controllers;

use App\Charts\AnnualyDoneChart;
use Illuminate\Http\Request;
use App\Charts\MonthlyUsersChart;
use App\Models\User;

class AdminController extends Controller
{
    public function index(MonthlyUsersChart $chart, AnnualyDoneChart $ychart, $id) {
        $clientCounter = User::where('role', 'client')->count();
        $users = User::find($id);
        return view('Admin.index', [
            'clientCounter' => $clientCounter,
            'chart' => $chart->build(),
            'ychart' => $ychart->build(),
            'users' => $users
        ]);
    }
}

