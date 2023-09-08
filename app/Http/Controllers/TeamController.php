<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function teamManagement() {
        $admin = User::where('role', 'admin')->first();
        $notification = Notification::where('role', 'admin')->limit(4)->latest()->get();
        return view('Admin.team-management', compact('admin','notification'));
    }
}
