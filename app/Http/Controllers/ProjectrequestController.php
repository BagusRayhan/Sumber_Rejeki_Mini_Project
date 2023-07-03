<?php

namespace App\Http\Controllers;

use App\Models\Fitur;
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
        $dataa = Fitur::where('project_id', $id)->get();
        return view('Admin.detailproreq', [
            'data' => $data,
            'admin' =>$admin,
            'dataa' =>$dataa
        ]);
    }

    public function simpanharga(Request $request, $id)
{
    $fitur = Fitur::findOrFail($id);

    $fitur->hargafitur = $request->input('hargafitur');

    $fitur->save();

    return back();
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
