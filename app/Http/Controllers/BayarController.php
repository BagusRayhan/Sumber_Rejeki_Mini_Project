<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BayarController extends Controller
{
        public function bayarclient()
        {
            return view('Client.bayar');
        }
}
