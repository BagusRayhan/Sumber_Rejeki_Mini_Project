<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\Sosmed;
use App\Models\Aboutproreq;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {
        $sosmed = Sosmed::all();
        $about = Aboutproreq::find(1);
        $faqs = FAQ::all();
        return view('welcome', compact('sosmed','faqs','about'));
    }
}
