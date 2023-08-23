<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{

    public function index() {
        return view('login');
    }

    public function register() {
        return view('register');
    }

    public function forgotPasswordRequest() {
        return view('auth.forgot-password');
    }

    public function forgotPasswordEmail(Request $request) {
        $request->validate([
            'email' => 'required|email'
        ],[
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
        ]);
        $status = Password::sendResetLink($request->only('email'));
        return $status === Password::RESET_LINK_SENT ? back()->with(['status' => __($status)]) : back()->withErrors(['email' => __($status)]);
    }

    public function resetPasswordToken(string $token) {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPasswordUpdate(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ],[
            'email.required' => 'Email tidak boleh kosong!',
            'email.email' => 'Harus berformat Email',
            'password.required' => 'Password tidak boleh kosong!',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Password dengan Konfirmasi Password tidak sama'
        ]);
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );
        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'berhasil mengubah password successfully. You can now log in.');
        } else {
            return back()->withErrors(['email' => [__($status)]]);
        }
    }

    public function login(Request $request) {
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
        return redirect('login')->withErrors(['email' => 'Email atau password tidak cocok!'])->withInput()->with('alert-type', 'error');
    }

    public function signupsave(Request $request) {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z]+$/',
            'email' => 'required|email|unique:users',
            'password' => 'required_with:pass|same:pass|min:6',
            'no_tlp' => 'nullable|min:11|max:14'
        ], [
            'password.min' => 'Password minimal 6 karakter!',
            'password.same' => 'Konfirmasi password tidak sesuai!',
            'email.unique' => 'Email sudah terdaftar!',
            'name.required' => 'Nama tidak boleh kosong!',
            'name.regex' => 'Nama hanya boleh mengandung huruf alfabet tanpa spasi.',
            'email.required' => 'Email tidak boleh kosong!',
            'no_tlp.min' => 'no telephone tidak boleh kurang dari 11',
            'no_tlp.max' => 'no telephone tidak boleh lebih dari 14'
        ]);
        $data = $request->all();
        $data['role'] = 'client';
        $data['profil'] = 'user.jpg';
        $user = $this->create($data);
        return redirect()->route('login')
            ->with('success', 'Anda berhasil melakukan registrasi!')
            ->with('alert-type', 'success');
    }

    public function create(array $data) {
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
    public function logout() {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }

}


