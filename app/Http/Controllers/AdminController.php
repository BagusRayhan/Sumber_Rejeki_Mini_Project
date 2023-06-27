<?php

namespace App\Http\Controllers;

use App\Charts\AnnualyDoneChart;
use Illuminate\Http\Request;
use App\Charts\MonthlyUsersChart;

class AdminController extends Controller
{
    public function index(MonthlyUsersChart $chart, AnnualyDoneChart $ychart) {
        return view('Admin.index', [
            'chart' => $chart->build(),
            'ychart' => $ychart->build()
        ]);
    }
}

