<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Fitur;
use Illuminate\Http\Request;
use App\Models\ProjectDisetujui;
use App\Models\Proreq;
use App\Models\Sosmed;
use App\Models\User;

class ProjectDisetujuiController extends Controller
{
    public function disetujui() {
        $admin = User::where('role', 'admin')->first();
        $project = proreq::where('status','setuju')->get();
        return view('Admin.project-disetujui', [
            'project' => $project,
            'admin' =>$admin
        ]);
    }


    public function detailDisetujui($id) {
        $admin = User::where('role', 'admin')->first();
        $detail = Proreq::find($id);
        // $fitur = Fitur::where('project_id', $id);
        $fitur = Fitur::all();
        $chats = Chat::all();
        return view('Admin.detail-project-disetujui', [
            'detail' => $detail,
            'fitur' => $fitur,
            'chats' => $chats,
            'admin' =>$admin
        ]);
    }

    public function projectChat(Request $request) {
        $createChat = Chat::create([
            'user_id' => 1,
            'project_id' => 1,
            'chat' => $request->chat,
            'chat_time' => $request->chat_time
        ]);
        return back();
    }

    public function disetujuiClient() {
        $admin = User::where('role', 'admin')->first();
        $project = ProjectDisetujui::all();
        $sosmed = Sosmed::all();
        return view('Client.disetujui', compact('project', 'sosmed','admin'));
    }

    public function detailDisetujuiClient($id) {
        $admin = User::where('role', 'admin')->first();
        $detail = ProjectDisetujui::find($id);
        $fitur = Fitur::all();
        $chats = Chat::all();
        $sosmed = Sosmed::all();
        return view('Client.detailsetujui', [
            'detail' => $detail,
            'fitur' => $fitur,
            'chats' => $chats,
            'sosmed' => $sosmed,
            'admin' =>$admin
        ]);
    }

    public function projectChatClient(Request $request) {
        $createChat = Chat::create([
            'user_id' => 2,
            'project_id' => 1,
            'chat' => $request->chat,
            'chat_time' => $request->chat_time
        ]);
        return back();
    }
}
