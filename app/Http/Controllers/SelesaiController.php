<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Fitur;
use App\Models\Proreq;
use App\Models\Sosmed;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SelesaiController extends Controller
{
        public function selesaiclient(Request $request)
        {
            $client = User::find(Auth::user()->id);
            $notification = Notification::where('role', 'client')->where('user_id', Auth::user()->id)->limit(4)->latest()->get();
            $search = $request->input('search');
            $data = Proreq::whereIn('status', ['selesai','pengajuan revisi'])
               ->where('user_id', Auth::user()->id)
               ->when(request()->has('search'), function ($query) {
                   $search = request('search');
                   $query->where(function ($subquery) use ($search) {
                       $subquery->where('napro', 'like', '%' . $search . '%')
                                ->orWhere('harga', 'like', '%' . $search . '%');
                   });
               })
               ->paginate(5);
            $data->appends(['search' => $search]);
            $sosmed = Sosmed::all();
            return view('Client.selesai', compact('sosmed','client','data','notification'));
        }

        public function revisiclient(Request $request){
            $client = User::find(Auth::user()->id);
            $notification = Notification::where('role', 'client')->where('user_id', Auth::user()->id)->limit(4)->latest()->get();
            $search = $request->input('search');
           $data = Proreq::where('status', 'revisi')
               ->where('user_id', Auth::user()->id)
               ->when(request()->has('search'), function ($query) {
                   $search = request('search');
                   $query->where(function ($subquery) use ($search) {
                       $subquery->where('napro', 'like', '%' . $search . '%')
                                ->orWhere('harga', 'like', '%' . $search . '%');
                   });
               })
               ->paginate(6);
                $data->appends(['search' => $search]);
            $sosmed = Sosmed::all();
            return view('Client.revisi', compact('sosmed','client','data','notification'));
        }

        public function updatestatus(Request $request, $id){
            $client = User::find(Auth::user()->id);
            $data = Proreq::findOrFail($id);
            $sosmed = Sosmed::all();
            $data->status = null;
            $data->statusbayar = 'belum lunas';
            $data->save();
             return redirect()->route('revisiclient')->with('success', 'Status pembayaran berhasil diupdate')->with(compact('sosmed', 'client', 'data'));
        }

            public function updatestatuss(Request $request, $id){
            $client = User::find(Auth::user()->id);
            $data = Proreq::findOrFail($id);
            $sosmed = Sosmed::all();
            $data->status = 'selesai';
            $data->statusbayar = 'lunas';
            $data->save();
             return redirect()->route('revisiclient')->with('success', 'Status pembayaran berhasil diupdate')->with(compact('sosmed', 'client', 'data'));
        }


        public function revisiselesai(){
            $client = User::find(Auth::user()->id);
            $notification = Notification::where('role', 'client')->where('user_id', Auth::user()->id)->limit(4)->latest()->get();
            $sosmed = Sosmed::all();
            return view('Client.selesai', compact('sosmed','client','detail','notification'));
        }
        public function revisibutton($id){
            $client = User::find(Auth::user()->id);
            $notification = Notification::where('role', 'client')->where('user_id', Auth::user()->id)->limit(4)->latest()->get();
            $detail = Proreq::find($id);
            $sosmed = Sosmed::all();
            $fitur = Fitur::where('project_id', $id)->get();
            $chats = Chat::where('project_id', $id)->get();
            if ($detail == null) {
                return back();
            }
            if (Auth::user()->id !== $detail->user_id || $detail->status !== 'selesai' && $detail->status !== 'pengajuan revisi' ) {
                return back();
            }
            return view('Client.revisibutton', compact('sosmed','client','detail','fitur','chats','notification'));
        }
        public function detail($id){
            $data = Proreq::findOrFail($id);
            if (Auth::user()->id !== $data->user_id || $data->status !== 'revisi' ) {
                return back();
            }
            $sosmed = Sosmed::all();
            $client = User::find(Auth::user()->id);
            $notification = Notification::where('role', 'client')->where('user_id', Auth::user()->id)->limit(4)->latest()->get();
            $dataa = Fitur::where('project_id', $id)->get();
            return view('Client.detailrevisi', compact( 'data','sosmed','client','dataa','notification'));
        }

        public function ajukanRevisi(Request $request) {
            $request->validate([
                'revisi' => 'required|min:30'
            ],[
                'revisi.required' => 'deskripsi revisi tidak boleh kosong',
                'revisi.min' => 'deskripsi tidak boleh kurang dari 30 karakter'
            ]);
            $pro = Proreq::find($request->project_id);
            $pro->update([
                'biayatambahan' => null,
                'estimasi' => null,
                'status' => 'pengajuan revisi',
                'listrevisi' => $request->revisi
            ]);
            $msg = 'Revisi Project';
            $notifDesk = Auth::user()->name.' mengajukan revisi';
            Notification::create([
                'role' => 'admin',
                'user_id' => $pro->user_id,
                'notif' => $msg,
                'deskripsi' => $notifDesk,
                'kategori' => 'Revisi Project'
            ]);
            return Redirect::route('selesaiclient')->with('success', 'Berhasil Mengajukan Revisi');
        }

        public function acceptRevision(Request $request) {
            $pro = Proreq::find($request->project_id);
            $pro->update([
                'status' => 'setuju',
                'statusbayar' => null
            ]);
            return redirect()->route('setujuclient')->with('success', 'Berhasil');
        }

        public function rejectRevision(Request $request) {
            $pro = Proreq::find($request->project_id);
            Fitur::where('project_id', $request->project_id)->delete();
            $pro->update([
                'status' => 'selesai',
                'statusbayar' => null,
                'biayatambahan' => null
            ]);
            return redirect()->route('revisiclient')->with('success', 'Berhasil');
        }

        public function destroy1(int $id)
        {
            $data = proreq::findOrFail($id);
            unlink(public_path('document/' . $data->dokumen));
            $data->delete();
            return redirect()->route('ditolakclient')->with('success', 'Berhasil menghapus data!');
        }

        public function destroypro(int $id)
        {
            $data = proreq::findOrFail($id);
            $data->delete();
            return redirect()->route('selesaiclient')->with('success', 'Berhasil menghapus data!');
        }
}
