<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // belum login
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // hanya admin, superadmin, crew
        if (!in_array($user->level, ['admin', 'superadmin', 'crew'])) {

            // user biasa ditolak
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}