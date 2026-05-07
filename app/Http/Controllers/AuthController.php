<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth.login');
    }

    // =========================
    // LOGIN
    // =========================
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $loginInput = $request->email;

        // cari user via email / username
        $user = User::where('email', $loginInput)
                    ->orWhere('username', $loginInput)
                    ->first();

        // user tidak ditemukan
        if (!$user) {
            return back()->withErrors([
                'email' => 'Akun tidak ditemukan'
            ])->withInput();
        }

        $email = $user->email;

        // batas percobaan login
        $maxAttempts = in_array($user->level, ['admin', 'superadmin', 'finance', 'crew']) ? 3 : 5;

        $attempts = session("login_attempts.$email", 0);
        $blockedUntil = session("login_blocked_until.$email");

        // cek blokir
        if ($blockedUntil && now()->lt($blockedUntil)) {
            return back()->withErrors([
                'email' => 'Terlalu banyak gagal, silahkan coba lagi dalam beberapa menit'
            ])->withInput();
        }

        // cek password
      // cek password
if (User::customHash($request->password) !== $user->password) {

    $attempts++;

    session([
        "login_attempts.$email" => $attempts
    ]);

    // jika melebihi batas
    if ($attempts >= $maxAttempts) {

        session([
            "login_blocked_until.$email" => now()->addMinute(),
            "login_attempts.$email" => 0
        ]);

        return back()->withErrors([
            'email' => 'Terlalu banyak gagal, silahkan coba lagi dalam beberapa menit'
        ])->withInput();
    }

    return back()->withErrors([
        'email' => 'Login gagal'
    ])->withInput();
}

        // reset session login gagal
        session()->forget("login_attempts.$email");
        session()->forget("login_blocked_until.$email");

        // login user
        Auth::login($user);

        $request->session()->regenerate();

        // redirect berdasarkan role
        if (in_array($user->level, ['admin', 'superadmin', 'crew'])) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->level === 'finance') {
            return redirect()->route('laporan');
        }

        if ($user->level === 'user') {
            return redirect()->route('dashboard');
        }

        // role tidak diizinkan
        Auth::logout();

        return redirect('/login')->withErrors([
            'email' => 'Role tidak diizinkan'
        ]);
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}