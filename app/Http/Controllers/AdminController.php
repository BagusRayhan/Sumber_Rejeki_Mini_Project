<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\MonthlyUsersChart;
use App\Models\User;

class AdminController extends Controller
{
    public function index(MonthlyUsersChart $chart, $id) {
        $users = User::find($id);

        return view('Admin.index', ['chart' => $chart->build(),'users' => $users]);
    }
}

