<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
        public function handle(Request $request, Closure $next, $guard = null)      
    {
               if (Auth::guard($guard)->check()) {
            // Jika pengguna atau admin sudah masuk, alihkan mereka kembali
            return back();
        }

        // Jika pengguna atau admin belum masuk, izinkan mereka mengakses rute tersebut
        return $next($request);
    }
    }
