<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectDisetujuiController extends Controller
{
    public function disetujui() {
        return view('Admin.project-disetujui');
    }

    public function detailDisetujui() {
        return view('Admin.detail-project-disetujui');
    }
}
