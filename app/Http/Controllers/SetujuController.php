<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetujuController extends Controller
{
        public function setujuclient()
        {
            return view('Client.disetujui');
        }
}
