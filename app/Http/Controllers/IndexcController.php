<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexcController extends Controller
{
    public function indexclient()
        {
            return view('Client.index');
        }
    
}
