<?php

namespace App\Http\Controllers;

use App\Models\projectreqAdmin;
use Illuminate\Http\Request;

class ProjectselesaiController extends Controller
{
        public function index()
        {
            $selesai = projectreqAdmin::all();
            return view('Admin.projectselesai', compact('selesai'));
        }
}
        