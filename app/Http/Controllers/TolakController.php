<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TolakController extends Controller
{
        public function ditolakclient()
        {
            return view('Client.index');
        }
}
