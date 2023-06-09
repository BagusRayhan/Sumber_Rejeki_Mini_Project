<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectrequestController extends Controller
{
    public function indexclient(){
        return view('Admin.projectreq');
    }
}
