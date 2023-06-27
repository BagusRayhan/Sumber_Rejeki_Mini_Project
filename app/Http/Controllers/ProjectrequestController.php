<?php

namespace App\Http\Controllers;
use App\Models\Proreq;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProjectrequestController extends Controller
{
    public function projectreq(){
        $projectreq = Proreq::where('status','pending')->get();
        return view('Admin.projectreq', ['projectreq'=>$projectreq]);
    }

    public function detailproreq($id){
        $data = Proreq::all()->find($id);
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
