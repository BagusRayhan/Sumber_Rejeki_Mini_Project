<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectClientController extends Controller
{
    public function projectclient()
        {
            return view('Client.index');
        }
    
}
