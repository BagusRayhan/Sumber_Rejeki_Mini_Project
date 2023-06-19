<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\MonthlyUsersChart;

class AdminController extends Controller
{
    public function index(MonthlyUsersChart $chart) {
        return view('Admin.index', ['chart' => $chart->build()]);
    }
}

