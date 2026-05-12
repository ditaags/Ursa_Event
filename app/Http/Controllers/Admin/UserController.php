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
        $users = User::orderByRaw("
            CASE 
                WHEN level = 'superadmin' THEN 1
                WHEN level = 'admin' THEN 2
                WHEN level = 'finance' THEN 3
                ELSE 4
            END
        ")
        ->orderBy('created_at', 'asc')
        ->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'level' => 'required|in:superadmin,admin,finance',
        ]);

        User::create([
            'id' => strtoupper(Str::random(20)),
            'name' => $request->username,
            'username' => $request->username,
            'email' => $request->email,
            'password' => User::customHash($request->password),
            'level' => $request->level,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:users,username,' . $id . ',id',
            'email' => 'required|email|unique:users,email,' . $id . ',id',
            'level' => 'required|in:superadmin,admin,finance',
        ]);

        $user->username = $request->username;
        $user->name = $request->username;
        $user->email = $request->email;
        $user->level = $request->level;

        // PASSWORD OPTIONAL
        if ($request->password != null) {
            $user->password = User::customHash($request->password);
        }

        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (auth()->user()->id === $user->id) {

            return back()->with(
                'error',
                'Tidak bisa menghapus akun sendiri'
            );
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dihapus');
    }
}