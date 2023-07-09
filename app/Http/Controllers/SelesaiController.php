<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Fitur;
use App\Models\Proreq;
use App\Models\Sosmed;
use Illuminate\Http\Request;

class SelesaiController extends Controller
{
        public function selesaiclient()
        {
            $client = User::where('role', 'client')->first();
            $data = Proreq::all();
            $sosmed = Sosmed::all();
            return view('Client.selesai', compact('sosmed','client','data'));
        }
        
        public function revisiclient(){
            $client = User::where('role', 'client')->first();
            $data = Proreq::all();
            $sosmed = Sosmed::all();
            return view('Client.revisi', compact('sosmed','client','data'));
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
            $sosmed = Sosmed::all();
            return view('Client.selesai', compact('sosmed','client','detail'));
        }
        public function revisibutton($id){
            $client = User::where('role', 'client')->first();
            $detail = Proreq::find($id);
            $sosmed = Sosmed::all();
            $fitur = Fitur::where('project_id', $id)->get();
            $chats = Chat::where('project_id', $id)->get();
            $userid = Auth()->user()->id . $id;
            return view('Client.revisibutton', compact('sosmed','client','detail','fitur','chats','userid'));
        }
        public function detail($id){
            $data = Proreq::findOrFail($id);
            $sosmed = Sosmed::all();
            $client = User::where('role', 'client')->first();
            $dataa = Fitur::where('project_id', $id)->get();
            return view('Client.detailrevisi', compact( 'data','sosmed','client','dataa'));
        }
}
