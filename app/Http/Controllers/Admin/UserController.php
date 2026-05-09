<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:ursaevent.users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'id' => strtoupper(Str::random(20)), // karena id string
            'name' => $request->name,
            'username' => $request->email, // sementara isi email (bisa kamu ubah nanti)
            'email' => $request->email,
            'password' => User::customHash($request->password), // pakai custom hash kamu
            'level' => 'admin', // default admin
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Admin berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // optional: biar tidak bisa hapus diri sendiri
        if (auth()->user()->id === $user->id) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Admin berhasil dihapus');
    }
}