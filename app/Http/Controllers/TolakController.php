<?php

namespace App\Http\Controllers;

use App\Models\Sosmed;
use Illuminate\Http\Request;

class TolakController extends Controller
{
        public function ditolakclient()
        {
            $sosmed = Sosmed::all();
            return view('Client.ditolak', compact('sosmed'));
        }
}
