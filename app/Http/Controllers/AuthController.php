<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }
    public function register(){
        return view('register');
    }
    public function forgot(){
        return view('forgot');
    }
    public function kebijakan(){
        return view('kebijakanprivasi');
    }
}
