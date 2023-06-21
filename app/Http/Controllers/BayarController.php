<?php

namespace App\Http\Controllers;

use App\Models\Sosmed;
use Illuminate\Http\Request;

class BayarController extends Controller
{
        public function bayarclient()
        {
            $sosmed = Sosmed::all();
            return view('Client.bayar', compact('sosmed'));
        }

        public function bayar2client()
        {
            $sosmed = Sosmed::all();
            return view('Client.bayar2', compact('sosmed'));
        }
}
