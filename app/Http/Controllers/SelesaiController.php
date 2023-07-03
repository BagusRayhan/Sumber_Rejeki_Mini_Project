<?php

namespace App\Http\Controllers;

use App\Models\Sosmed;
use App\Models\User;
use Illuminate\Http\Request;

class SelesaiController extends Controller
{
        public function selesaiclient()
        {
            $client = User::where('role', 'client')->first();
            $sosmed = Sosmed::all();
            return view('Client.selesai', compact('sosmed','client'));
        }

        public function revisiclient(){
            $client = User::where('role', 'client')->first();
            $sosmed = Sosmed::all();
            return view('Client.revisi', compact('sosmed','client'));
        }
        public function revisiselesai(){
            $client = User::where('role', 'client')->first();
            $sosmed = Sosmed::all();
            return view('Client.selesai', compact('sosmed','client'));
        }
        public function revisibutton(){
            $client = User::where('role', 'client')->first();
            $sosmed = Sosmed::all();
            return view('Client.revisibutton', compact('sosmed','client'));
        }
        public function detail(){
            $client = User::where('role', 'client')->first();
            $sosmed = Sosmed::all();
            return view('Client.detailrevisi', compact('sosmed','client'));
        }
}
