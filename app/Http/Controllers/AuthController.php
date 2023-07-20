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


public function login(Request $request)
{
    $request->validate([
        'email' => 'required',
        'password' => 'required|min:6',
    ], [
        'email.required' => 'Email tidak boleh kosong!',
        'password.required' => 'Password tidak boleh kosong!',
        'password.min' => 'Password minimal 6 karakter!',
    ]);

    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin-dashboard');
        } else {
            return redirect()->route('indexclient');
        }
    }
    return redirect('/')
        ->withErrors(['email' => 'Email atau password tidak cocok!'])
        ->withInput()
        ->with('alert-type', 'error');
}




public function register()
{
    return view('register');
}

public function signupsave(Request $request)
{
    $request->validate([
        'name' => 'required|regex:/^[a-zA-Z]+$/',
        'email' => 'required|email|unique:users',
        'password' => 'required_with:pass|same:pass|min:6',
    ], [
        'password.min' => 'Password minimal 6 karakter!',
        'password.same' => 'Konfirmasi password tidak sesuai!',
        'email.unique' => 'Email sudah terdaftar!',
        'name.required' => 'Nama tidak boleh kosong!',
        'email.required' => 'Email tidak boleh kosong!',
    ]);

    $data = $request->all();
    $data['role'] = 'client';
    $data['profil'] = 'user.jpg';

    $user = $this->create($data);

    return redirect("/")
        ->with('success', 'Anda berhasil melakukan registrasi!')
        ->with('alert-type', 'success');
}

public function create(array $data)
{
    return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'role' => $data['role'],
        'nama_perusahaan' => $data['nama_perusahaan'],
        'alamat_perusahaan' => $data['alamat_perusahaan'],
        'no_tlp' => $data['no_tlp'],
        'profil' => $data['profil'],
    ]);
}




    public function forgot(){
        return view('auth.forgot-password');
    }
    public function kebijakan(){
        return view('kebijakanprivasi');
    }

    public function logout() {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }

}


