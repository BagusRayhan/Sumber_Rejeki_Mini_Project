<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SelesaiController extends Controller
{
        public function selesaiclient()
        {
            return view('Client.selesai');
        }

        public function revisiclient(){
            return view('Client.revisi');
        }
}
