<?php

namespace App\Http\Controllers;

use App\Models\Sosmed;
use App\Models\ditolak;
use App\Models\proreq;
use Illuminate\Http\Request;

class TolakController extends Controller
{
        public function ditolakclient()
        {
            $sosmed = Sosmed::all();
            $data = proreq::where('status','ditolak')->get();
            return view('Client.ditolak', compact('sosmed','data'));
        }

        public function projectreq(){
            $projectreq = Proreq::where('status','pending')->get();
            return view('Admin.projectreq', ['projectreq'=>$projectreq]);
        }

        public function destroy(int $id)
        {
            $data = proreq::findOrFail($id);
            $data->delete();
            return redirect()->route('ditolakclient')->with('success', 'Berhasil menghapus data!');
        }


}



