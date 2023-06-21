<?php

namespace App\Http\Controllers;

use App\Models\clientproreq;
use App\Models\Sosmed;
use Illuminate\Http\Request;

class IndexcController extends Controller
{
    public function indexclient()
        {
            $sosmed = Sosmed::all();
            return view('Client.index', compact('sosmed'));
        }

    public function drequestclient(){
        $sosmed = Sosmed::all();
        return view('Client.clientproreq', compact('sosmed'));
    }

    public function createproreq(){
        $sosmed = Sosmed::all();
        return view ('Client.createproreq', compact('sosmed'));
    }
    public function editproreq(){
        $sosmed = Sosmed::all();
        return view('Client.editproreq', compact('sosmed'));
    }
}
