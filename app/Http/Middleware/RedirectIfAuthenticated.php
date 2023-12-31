<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /// ketika user mencoba mengakses halaman login dalam keadaan sudah ter-autentikasi
        /// redirect ke dashboard sesuai role user login saat ini
        if (Auth::check()) {
            $dashboardPath = Auth::user()->role;
            return redirect("/$dashboardPath");
        }

        /// jika tidak dalam keadaan ter-autentikasi, arahkan ke halaman login
        return $next($request);
    }
}
