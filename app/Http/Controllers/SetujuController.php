<?php

namespace App\Http\Controllers;

use App\Models\Sosmed;
use App\Models\User;
use Illuminate\Http\Request;

class SetujuController extends Controller
{
        public function setujuclient()
        {
            $client = User::where('role', 'client')->first();
            $sosmed = Sosmed::all();
            return view('Client.disetujui', compact('sosmed','client'));
        }
        public function detailsetujui(){
            $client = User::where('role', 'client')->first();
            $sosmed = Sosmed::all();
            return view('Client.detailsetujui', compact('sosmed','client'));
        }
}
