<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Fitur;
use App\Models\Proreq;
use App\Models\Sosmed;
use App\Models\Notification;
use Illuminate\Http\Request;

class SelesaiController extends Controller
{
        public function selesaiclient()
        {
            $client = User::where('role', 'client')->first();
            $notification = Notification::where('role', 'client')->limit(4)->latest()->get();
            $data = Proreq::all();
            $sosmed = Sosmed::all();
            return view('Client.selesai', compact('sosmed','client','data','notification'));
        }
        
        public function revisiclient(){
            $client = User::where('role', 'client')->first();
            $notification = Notification::where('role', 'client')->limit(4)->latest()->get();
            $data = Proreq::all();
            $sosmed = Sosmed::all();
            return view('Client.revisi', compact('sosmed','client','data','notification'));
        }

        public function updatestatus(Request $request, $id){
            $client = User::where('role', 'client')->first();
            $data = Proreq::findOrFail($id);
            $sosmed = Sosmed::all();
            $data->status = null;
            $data->statusbayar = 'belum lunas';
            $data->save();
             return redirect()->route('revisiclient')->with('success', 'Status pembayaran berhasil diupdate')->with(compact('sosmed', 'client', 'data'));
        }    
        
            public function updatestatuss(Request $request, $id){
            $client = User::where('role', 'client')->first();
            $data = Proreq::findOrFail($id);
            $sosmed = Sosmed::all();
            $data->status = 'selesai';
            $data->statusbayar = 'lunas';
            $data->save();
             return redirect()->route('revisiclient')->with('success', 'Status pembayaran berhasil diupdate')->with(compact('sosmed', 'client', 'data'));
        }  
        

        public function revisiselesai(){
            $client = User::where('role', 'client')->first();
            $notification = Notification::where('role', 'client')->limit(4)->latest()->get();
            $sosmed = Sosmed::all();
            return view('Client.selesai', compact('sosmed','client','detail','notification'));
        }
        public function revisibutton($id){
            $client = User::where('role', 'client')->first();
            $notification = Notification::where('role', 'client')->limit(4)->latest()->get();
            $detail = Proreq::find($id);
            $sosmed = Sosmed::all();
            $fitur = Fitur::where('project_id', $id)->get();
            $chats = Chat::where('project_id', $id)->get();
            return view('Client.revisibutton', compact('sosmed','client','detail','fitur','chats','notification'));
        }
        public function detail($id){
            $data = Proreq::findOrFail($id);
            $sosmed = Sosmed::all();
            $client = User::where('role', 'client')->first();
            $notification = Notification::where('role', 'client')->limit(4)->latest()->get();
            $dataa = Fitur::where('project_id', $id)->get();
            return view('Client.detailrevisi', compact( 'data','sosmed','client','dataa','notification'));
        }

        public function ajukanRevisi(Request $request) {
            $pro = Proreq::find($request->project_id);
            $pro->update([
                'status' => 'revisi'
            ]);
            $msg = 'Revisi project dari '.Auth()->user()->name;
            $notif = Notification::create([
                'role' => 'admin',
                'notif' => $msg,
                'kategori' => 'Revisi Project'
            ]);
            return back()->with('success', 'Berhasil Mengajukan Revisi');
        }

        public function acceptRevision(Request $request) {
            $pro = Proreq::find($request->project_id);
            $pro->update([
                'status' => null,
                'statusbayar' => 'belum lunas'
            ]);
            return redirect()->route('selesaiclient')->with('success', 'Berhasil');
        }

        public function rejectRevision(Request $request) {
            $pro = Proreq::find($request->project_id);
            $pro->update([
                'status' => 'selesai',
                'statusbayar' => null
            ]);
            return redirect()->route('selesaiclient')->with('success', 'Berhasil');
        }
}
