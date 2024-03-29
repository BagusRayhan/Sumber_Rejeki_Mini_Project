<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Proreq;
use App\Models\Sosmed;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TolakController extends Controller
{
        public function ditolakclient(Request $request)
        {
            $client = User::find(Auth::user()->id);
            $notification = Notification::where('role', 'client')->where('user_id', Auth::user()->id)->limit(4)->latest()->get();
            $sosmed = Sosmed::all();
            $keyword = $request->input('keyword');
            $data = Proreq::where('status', 'tolak')->where('user_id', Auth::user()->id)
                ->when($keyword, function ($query) use ($keyword) {
                    $query->where('napro', 'LIKE', '%'.$keyword.'%');
                })
                ->paginate(4);
                $data->appends(['data' => $data]);
            return view('Client.ditolak', compact('sosmed','data','client','notification'));
        }

        public function destroy(int $id)
        {
            $data = Proreq::findOrFail($id);
            Notification::where('project_id', $data->id)->delete();
            if (Auth::user()->id == $data->user_id) {
                $data->delete();
                return redirect()->route('ditolakclient')->with('success', 'Berhasil menghapus data!');
            } else {
                return back()->with('error', 'Gagal menghapus data');
            }
        }
        public function destroy1(int $id)
        {
            $data = Proreq::findOrFail($id);
            if (Auth::user()->id == $data->user_id) {
                unlink(public_path('document/' . $data->dokumen));
                $data->delete();
            } else {
                return back()->with('success', 'Gagal menghapus data');
            }
            return redirect()->route('ditolakclient')->with('success', 'Berhasil menghapus data!');
        }


}



