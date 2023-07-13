<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sosmed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetujuController extends Controller
{
        public function setujuclient()
        {
            $client = User::find(Auth::user()->id);
            $sosmed = Sosmed::all();
            return view('Client.disetujui', compact('sosmed','client'));
        }
        public function detailsetujui(){
            $client = User::find(Auth::user()->id);
            $sosmed = Sosmed::all();
            return view('Client.detailsetujui', compact('sosmed','client'));
        }
}
