<?php

namespace App\Http\Controllers;
use App\Models\proreq;
use Illuminate\Http\Request;

class ProjectselesaiController extends Controller
{
    public function index()
    {
        $selesai = proreq::whereIn('status', ['selesai', 'revisi'])->get();
        return view('Admin.projectselesai', compact('selesai'));
    }
}

