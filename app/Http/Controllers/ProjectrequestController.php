<?php

namespace App\Http\Controllers;

use App\Models\projectreqAdmin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProjectrequestController extends Controller
{
    public function projectreq(){
        $data = projectreqAdmin::all();
        return view('Admin.projectreq', ['data' => $data]);
    }

    public function detailproreq($id){
        $data = projectreqAdmin::all()->find($id);
        return view('Admin.detailproreq', ['data' => $data]);
    }

    public function projectselesai(){
        return view('Admin.projectselesai');
    }

    public function revisiproselesai(){
        return view('Admin.revisiproselesai');
    }

    public function editproselesai(){
        return view('Admin.editproselesai');
    }
}
