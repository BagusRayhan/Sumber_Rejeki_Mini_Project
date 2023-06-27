<?php

namespace App\Http\Controllers;
use App\Models\proreq;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectselesaiController extends Controller
{
    public function index()
    {
        $admin = User::where('role', 'admin')->first();
        $selesai = proreq::whereIn('status', ['selesai', 'revisi'])->get();
        return view('Admin.projectselesai', compact('selesai','admin'));
    }
}

