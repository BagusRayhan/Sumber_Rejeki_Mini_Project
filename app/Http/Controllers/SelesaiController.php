<?php

namespace App\Http\Controllers;

use App\Models\Sosmed;
use Illuminate\Http\Request;

class SelesaiController extends Controller
{
        public function selesaiclient()
        {
            $sosmed = Sosmed::all();
            return view('Client.selesai', compact('sosmed'));
        }

        public function revisiclient(){
            $sosmed = Sosmed::all();
            return view('Client.revisi', compact('sosmed'));
        }
        public function revisiselesai(){
            $sosmed = Sosmed::all();
            return view('Client.selesai', compact('sosmed'));
        }
        public function revisibutton(){
            $sosmed = Sosmed::all();
            return view('Client.revisibutton', compact('sosmed'));
        }
        public function detail(){
            $sosmed = Sosmed::all();
            return view('Client.detailrevisi', compact('sosmed'));
        }
}
