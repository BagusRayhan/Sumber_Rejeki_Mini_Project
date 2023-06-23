<?php

namespace App\Http\Controllers;

use App\Models\Sosmed;
use App\Models\ditolak;
use Illuminate\Http\Request;

class TolakController extends Controller
{
        public function ditolakclient()
        {
            $sosmed = Sosmed::all();
            $data = ditolak::all();

            return view('Client.ditolak', compact('sosmed','data'));
        }

        public function destroy(int $id)
        {
            $data = ditolak::findOrFail($id);
            $data->delete();
            return redirect()->route('ditolakclient')->with('success', 'Berhasil menghapus data!');
        }


}



