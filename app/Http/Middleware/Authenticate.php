<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {



        $this->authenticate($request, $guards);
        
        // Cek role pengguna setelah autentikasi
        $user = $request->user();

        if($user && $user->status === 'banned') {
            auth()->logout();
            $reason = $user->alasan_dibanned;
            return redirect()->route('login')->with('error',"Akun anda telah dibanned. Alasan: $reason");
        }

        if ($user && $user->role === 'client') {
            return $next($request);
        }
        return redirect('admin');
    }
}
