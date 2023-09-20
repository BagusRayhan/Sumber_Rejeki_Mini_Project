<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{

    public function index() {
        return view('login');
    }

    public function register() {
        $user = User::where('email', session('temp_email'))->first();
        if ($user) {
            $verifiedEmail = User::where('email', session('temp_email'))->pluck('email_verified_at')->first();
            if ($verifiedEmail == null) {
                return redirect()->route('email-verification');
            } else {
                session()->forget('temp_email');
            }
        } else {
            session()->forget('temp_email');
        }
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
            if ($user->role === null) {
                if (session('temp_email') == $user->email) {
                    return redirect()->route('email-verification');
                } else {
                    User::findOrFail(Auth::user()->id)->delete();
                    return redirect()->route('login')->with('error','Akun tidak terdaftar');
                }
            } elseif ($user->role === 'client') {
                if ($user->status == 'banned') {
                    return back()->with('error','Akun anda telah dibanned');
                } else {
                    return redirect()->route('indexclient');
                }
            } elseif ($user->role === 'admin') {
                return redirect()->route('admin-dashboard');
            }
        }
        return redirect('login')->withErrors(['email' => 'Email atau password tidak cocok!'])->withInput()->with('alert-type', 'error');
    }

    public function signupsave(Request $request) {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required_with:pass|same:pass|min:6',
            'no_tlp' => 'nullable|min:11|max:14',
            'nama_perusahaan' => 'nullable|max:50',
            'alamat_perusahaan' => 'nullable|max:255',
        ], [
            'password.min' => 'Password minimal 6 karakter!',
            'password.same' => 'Konfirmasi password tidak sesuai!',
            'email.unique' => 'Email sudah terdaftar!',
            'name.required' => 'Nama tidak boleh kosong!',
            'name.regex' => 'Nama tidak valid',
            'name.max' => 'Nama tidak valid',
            'email.required' => 'Email tidak boleh kosong!',
            'no_tlp.min' => 'No telpon tidak boleh kurang dari 11',
            'no_tlp.max' => 'No telpon tidak boleh lebih dari 14',
            'nama_perusahaan.max' => 'Nama perusahaan tidak boleh lebih dari 50 karakter',
            'alamat_perusahaan.max' => 'Alamat tidak boleh lebih dari 255 karakter',
        ]);
        $code = random_int(1000, 9999);
        $email = $request->email;
        session([
            'code' => $code,
            'code_expired' => now()->addMinutes(5),
            'temp_email' => $email,
        ]);
        $data = $request->all();
        $data['role'] = null;
        $data['profil'] = 'user.jpg';
        $user = $this->create($data);
        Mail::to($request->email)->send(new EmailVerification($code));
        return redirect()->route('email-verification');
    }

    public function verifEmail() {
        if (session('temp_email') == null) {
            return to_route('register');
        }
        if (now() > session('code_expired')) {
            session()->forget(['code','code_expired']);
        }
        $email = User::where('email', session('temp_email'))->first();
        return view('email-verification', [
            'email' => $email
        ]);
    }

    public function resendCode() {
        $code = random_int(1000, 9999);
        session([
            'code' => $code,
            'code_expired' => now()->addMinutes(5),
        ]);
        Mail::to(session('temp_email'))->send(new EmailVerification($code));
        return back();
    }

    public function verifEmailStore(Request $request) {
        $request->validate([
            'code' => 'required|numeric'
        ],[
            'code.required' => 'Kode tidak boleh kosong',
            'code.numeric' => 'Kode tidak valid'
        ]);
        if (session('code') != $request->code) {
            return back()->with('error', 'Kode tidak sama');
        } else {
            $email = User::where('email', session('temp_email'))->first();
            $email->update([
                'role' => 'client'
            ]);
            session()->flush();
            return redirect()->route('login')
            ->with('success', 'Anda berhasil melakukan registrasi!')
            ->with('alert-type', 'success');
        }
    }

    public function wrongAccount() {
        User::where('email', session('temp_email'))->first()->delete();
        session()->flush();
        return redirect()->route('register');
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


