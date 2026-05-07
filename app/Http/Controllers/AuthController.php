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
    // CUSTOM HASH
    // =========================
    private function customHash($password)
    {
        $result = '';

        foreach (str_split($password) as $char) {
            if (ctype_upper($char)) {
                $result .= chr(ord($char) + 7);
            } elseif (ctype_lower($char)) {
                $result .= chr(ord($char) + 5);
            } elseif (ctype_digit($char)) {
                $result .= chr(ord($char) + 3);
            } else {
                $result .= $char;
            }
        }

        return $result;
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

        // 🔍 cari user (email / username)
        $user = User::where('email', $loginInput)
                    ->orWhere('username', $loginInput)
                    ->first();

        // ❌ user tidak ditemukan
        if (!$user) {
            return back()->withErrors([
                'email' => 'Akun tidak ditemukan'
            ]);
        }

        $email = $user->email;

        // 🔥 tentukan batas percobaan (WAJIB DI ATAS)
        $maxAttempts = in_array($user->level, ['admin', 'superadmin', 'finance', 'crew']) ? 3 : 5;

        // ambil session
        $attempts = session("login_attempts.$email", 0);
        $blockedUntil = session("login_blocked_until.$email");

        // ⛔ cek blokir
        if ($blockedUntil && now()->lt($blockedUntil)) {
            return back()->withErrors([
                'email' => 'Terlalu banyak gagal, silahkan coba lagi dalam beberapa menit'
            ]);
        }

        // ❌ password salah
        if ($this->customHash($request->password) !== $user->password) {

            $attempts++;

            session(["login_attempts.$email" => $attempts]);

            // jika melebihi batas
            if ($attempts >= $maxAttempts) {
                session([
                    "login_blocked_until.$email" => now()->addMinute(),
                    "login_attempts.$email" => 0
                ]);

                return back()->withErrors([
                    'email' => 'Terlalu banyak gagal, silahkan coba lagi dalam beberapa menit'
                ]);
            }

            return back()->withErrors([
                'email' => "login gagal!!"
            ]);
        }

        // login berhasil → reset
        session()->forget("login_attempts.$email");
        session()->forget("login_blocked_until.$email");

        Auth::login($user);
        $request->session()->regenerate();

        // 🔁 redirect berdasarkan role
        if (in_array($user->level, ['admin', 'superadmin', 'crew'])) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->level === 'finance') {
            return redirect()->route('laporan');
        }

        if ($user->level == 'user') {
            return redirect()->route('event.public');
        }

        if ($user->level === 'user') {
            return redirect()->route('dashboard');
        }

        // role lain ditolak
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