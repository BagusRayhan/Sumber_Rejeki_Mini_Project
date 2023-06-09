<?php

namespace App\Http\Controllers;

use App\Models\clientproreq;
use Illuminate\Http\Request;

class IndexcController extends Controller
{
    public function indexclient()
        {
            return view('Client.index');
        }

    public function drequestclient(){
        return view('Client.clientproreq');
    }
    
}
