<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Fitur;
use Illuminate\Http\Request;
use App\Models\ProjectDisetujui;
use App\Models\projectreqAdmin;
use App\Models\Sosmed;

class ProjectDisetujuiController extends Controller
{
    public function disetujui() {
        $project = projectreqAdmin::where('status','setuju')->get();
        return view('Admin.project-disetujui', ['project' => $project]);
    }


    public function detailDisetujui($id) {
        $detail = ProjectDisetujui::find($id);
        // $fitur = Fitur::where('project_id', $id);
        $fitur = Fitur::all();
        $chats = Chat::all();
        return view('Admin.detail-project-disetujui', [
            'detail' => $detail,
            'fitur' => $fitur,
            'chats' => $chats
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
        $project = ProjectDisetujui::all();
        $sosmed = Sosmed::all();
        return view('Client.disetujui', compact('project', 'sosmed'));
    }

    public function detailDisetujuiClient($id) {
        $detail = ProjectDisetujui::find($id);
        $fitur = Fitur::all();
        $chats = Chat::all();
        $sosmed = Sosmed::all();
        return view('Client.detailsetujui', [
            'detail' => $detail,
            'fitur' => $fitur,
            'chats' => $chats,
            'sosmed' => $sosmed
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
