<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sosmed;
use App\Models\Kebijakan;

class PengaturanController extends Controller
{
    public function pengaturan(){

        $data = sosmed::firstOrFail(); // single object
        $data1 = Kebijakan::firstOrFail();

        return view('Admin.pengaturan', compact('data','data1'));
    }

    public function updatekebijakan(Request $request) {
        $data1 = Kebijakan::firstOrFail();
        $data1->kebijakan = $request->input('content');
        $data1->save();

        return redirect()->back()->with('sukses','Data berhasil diperbarui!');
    }
    public function updatesosmed(Request $request)
    {
        $data = Sosmed::firstOrFail();
        $data->wa = $request->input('wa');
        $data->ig = $request->input('ig');
        $data->email = $request->input('email');
        $data->save();

        return redirect()->back()->with('sukses', 'Data berhasil diperbarui.');
    }

    }
