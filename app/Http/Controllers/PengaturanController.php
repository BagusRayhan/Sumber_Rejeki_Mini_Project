<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sosmed;

class PengaturanController extends Controller
{
    public function pengaturan(){

        $sosmed = sosmed::all();
        $data = sosmed::find(1);

        return view('Admin.pengaturan', compact('data','sosmed'));
    }

    public function updatesosmed(Request $request)
    {
        $data = Sosmed::find(1);
        $data->wa = $request->input('wa');
        $data->ig = $request->input('ig');
        $data->email = $request->input('email');
        $data->save();
    
        return redirect()->back()->with('sukses', 'Data berhasil diperbarui.');
    }
    
    }
