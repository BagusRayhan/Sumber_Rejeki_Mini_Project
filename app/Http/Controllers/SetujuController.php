<?php

namespace App\Http\Controllers;

use App\Models\Sosmed;
use Illuminate\Http\Request;

class SetujuController extends Controller
{
        public function setujuclient()
        {
            $sosmed = Sosmed::all();
            return view('Client.disetujui', compact('sosmed'));
        }
        public function detailsetujui(){
            $sosmed = Sosmed::all();
            return view('Client.detailsetujui', compact('sosmed'));
        }
}
