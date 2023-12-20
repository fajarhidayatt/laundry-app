<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        /// jika role user yang login pada saat ini tidak sesuai dengan role yang ada pada middleware route
        /// maka redirect ke dashboard sesuai dengan role user yang login pada saat ini
        if (Auth::user() && Auth::user()->role !== $role) {
            $dashboardPath = Auth::user()->role;
            return redirect("/$dashboardPath");
        }

        return $next($request);
    }
}
