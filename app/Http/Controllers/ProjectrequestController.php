<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectrequestController extends Controller
{
    public function projectreq(){
        return view('Admin.projectreq');
    }

    public function detailproreq(){
        return view('Admin.detailproreq');
    }

    public function projectselesai(){
        return view('Admin.projectselesai');
    }
}
