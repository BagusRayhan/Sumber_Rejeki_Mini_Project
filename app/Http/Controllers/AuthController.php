<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index(){
        return view('login');
    }

    public function login(Request $request) {
    $request->validate([
    'email' => 'required',
    'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
    return redirect()->route('indexclient')
    ->with('message', 'Login berhasil!');
    }

    // Tampilkan pesan SweetAlert jika login gagal
    return redirect('/')
    ->with('message', 'Email atau password tidak valid!')
    ->with('alert-type', 'error');
    }

    public function register()
    {
    return view('register');
    }

    public function signupsave(Request $request)
    {
    $request->validate([
    'name' => 'required',
    'email' => 'required|email|unique:users',
    'password' => 'required|min:6',
    'nama_perusahaan' => 'required',
    'alamat_perusahaan' => 'required|min:6',
    'no_tlp' => 'required|min:12',
    ], [
    'password.min' => 'Password harus memiliki minimal 6 karakter'
    ]);

    $data = $request->all();
    $check = $this->create($data);

    // Tampilkan pesan SweetAlert jika register berhasil
    return redirect("/")
    ->with('success', 'Anda berhasil melakukan register!')
    ->with('alert-type', 'success');
    }

    public function create(array $data)
    {
    return User::create([
    'name' => $data['name'],
    'email' => $data['email'],
    'password' => Hash::make($data['password']),
    'nama_perusahaan' => $data['nama_perusahaan'],
    'alamat_perusahaan' => $data['alamat_perusahaan'],
    'no_tlp' => $data['no_tlp']
    ]);
    }



    public function forgot(){
        return view('forgot');
    }
    public function kebijakan(){
        return view('kebijakanprivasi');
    }
}
