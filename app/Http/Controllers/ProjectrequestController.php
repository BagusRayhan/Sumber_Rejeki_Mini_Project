<?php

namespace App\Http\Controllers;
use App\Models\Proreq;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProjectrequestController extends Controller
{
    public function projectreq(){
        $admin = User::where('role', 'admin')->first();
        $projectreq = Proreq::where('status','pending')->get();
        return view('Admin.projectreq', [
            'projectreq'=>$projectreq,
            'admin' =>$admin
        ]);
    }

    public function detailproreq($id){
        $admin = User::where('role', 'admin')->first();
        $data = Proreq::all()->find($id);
        return view('Admin.detailproreq', [
            'data' => $data,
            'admin' =>$admin
        ]);
    }

    public function projectselesai(){
        $admin = User::where('role', 'admin')->first();
        return view('Admin.projectselesai', [
            'admin' =>$admin
        ]);
    }

    public function revisiproselesai(){
        $admin = User::where('role', 'admin')->first();
        return view('Admin.revisiproselesai', [
            'admin' =>$admin
        ]);
    }

    public function editproselesai(){
        $admin = User::where('role', 'admin')->first();
        return view('Admin.editproselesai', [
            'admin' =>$admin
        ]);
    }


}
