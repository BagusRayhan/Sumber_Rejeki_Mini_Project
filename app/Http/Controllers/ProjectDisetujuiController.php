<?php

namespace App\Http\Controllers;

use App\Models\ProjectDisetujuiAdmin;
use Illuminate\Http\Request;

class ProjectDisetujuiController extends Controller
{
    public function disetujui() {
        $project = ProjectDisetujuiAdmin::all();
        return view('Admin.project-disetujui', [
            'project' => $project
        ]);
    }

    public function detailDisetujui($id) {
        $detail = ProjectDisetujuiAdmin::all()->find($id);
        return view('Admin.detail-project-disetujui', [
            'detail' => $detail
        ]);
    }
}
