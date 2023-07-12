<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\proreq;
use App\Models\Sosmed;
use App\Models\ditolak;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TolakController extends Controller
{
        public function ditolakclient()
        {
            $client = User::find(Auth::user()->id);
            $notification = Notification::where('role', 'client')->limit(4)->latest()->get();
            $sosmed = Sosmed::all();
            $data = proreq::where('status','tolak')->get();
            return view('Client.ditolak', compact('sosmed','data','client','notification'));
        }

        public function destroy(int $id)
        {
            $data = proreq::findOrFail($id);
            $data->delete();
            return redirect()->route('ditolakclient')->with('success', 'Berhasil menghapus data!');
        }


}



