<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class UserController extends Controller
{
    public function index()
    {
        // jika login sebagai admin
        if (auth()->user()->level === 'admin') {

            // hanya tampilkan user biasa
            $users = User::where('level', 'user')
                ->orderBy('created_at', 'asc')
                ->get();
        }

        // jika superadmin
        else {

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
        }

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // admin otomatis buat user biasa
        if (Auth::user()->level === 'admin') {

            $request->merge([
                'level' => 'user'
            ]);
        }

        $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'level' => 'required|in:superadmin,admin,finance,user',
        ]);

        try {

            // =========================================
            // SUPABASE CONFIG
            // =========================================

            $supabaseUrl =
                rtrim(env('SUPABASE_URL'), '/');

            // pakai SUPABASE_KEY dari env kamu
            $supabaseKey =
                trim(env('SUPABASE_KEY'));

            $client = new Client();

            // =========================================
            // REGISTER AUTH SUPABASE
            // =========================================

            $response = $client->post(

                $supabaseUrl . '/auth/v1/admin/users',

                [

                    'headers' => [

                        'apikey' =>
                            $supabaseKey,

                        'Authorization' =>
                            'Bearer ' . $supabaseKey,

                        'Content-Type' =>
                            'application/json',
                    ],

                    'json' => [

                        'email' =>
                            $request->email,

                        'password' =>
                            $request->password,

                        'email_confirm' => true,
                    ]
                ]
            );

            $result = json_decode(
                $response->getBody(),
                true
            );

            // =========================================
            // AMBIL UUID DARI AUTH
            // =========================================

            $supabaseUserId =
                $result['id'];

            // =========================================
            // INSERT KE TABLE USERS
            // =========================================

            User::create([

                'id' =>
                    $supabaseUserId,

                'name' =>
                    $request->username,

                'username' =>
                    $request->username,

                'email' =>
                    $request->email,

                'password' =>
                    User::customHash(
                        $request->password
                    ),

                'level' =>
                    $request->level,
            ]);

            return redirect()
                ->route('admin.users.index')
                ->with(
                    'success',
                    'User berhasil ditambahkan'
                );

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Gagal tambah user : ' .
                    $e->getMessage()
                );
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // admin tidak boleh ubah level
        if (Auth::user()->level === 'admin') {

            $request->merge([
                'level' => 'user'
            ]);
        }

        $request->validate([

            'username' =>
                'required|unique:users,username,' . $id . ',id',

            'email' =>
                'required|email|unique:users,email,' . $id . ',id',

            'level' =>
                'required|in:superadmin,admin,finance,user',
        ]);

        try {

            // =========================================
            // SUPABASE CONFIG
            // =========================================

            $supabaseUrl =
                rtrim(env('SUPABASE_URL'), '/');

            $supabaseKey =
                trim(env('SUPABASE_KEY'));

            $client = new Client();

            $body = [

                'email' =>
                    $request->email,
            ];

            // password optional
            if ($request->password != null) {

                $body['password'] =
                    $request->password;
            }

            // =========================================
            // UPDATE AUTH USER
            // =========================================

            $client->put(

                $supabaseUrl .
                    '/auth/v1/admin/users/' .
                    $user->id,

                [

                    'headers' => [

                        'apikey' =>
                            $supabaseKey,

                        'Authorization' =>
                            'Bearer ' . $supabaseKey,

                        'Content-Type' =>
                            'application/json',
                    ],

                    'json' => $body
                ]
            );

            // =========================================
            // UPDATE TABLE USERS
            // =========================================

            $user->username =
                $request->username;

            $user->name =
                $request->username;

            $user->email =
                $request->email;

            $user->level =
                $request->level;

            // password optional
            if ($request->password != null) {

                $user->password =
                    User::customHash(
                        $request->password
                    );
            }

            $user->save();

            return redirect()
                ->route('admin.users.index')
                ->with(
                    'success',
                    'User berhasil diupdate'
                );

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Gagal update user : ' .
                    $e->getMessage()
                );
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // tidak bisa hapus akun sendiri
        if (auth()->user()->id === $user->id) {

            return back()->with(
                'error',
                'Tidak bisa menghapus akun sendiri'
            );
        }

        try {

            // =========================================
            // SUPABASE CONFIG
            // =========================================

            $supabaseUrl =
                rtrim(env('SUPABASE_URL'), '/');

            $supabaseKey =
                trim(env('SUPABASE_KEY'));

            $client = new Client();

            // =========================================
            // DELETE AUTH USER
            // =========================================

            $client->request(

                'DELETE',

                $supabaseUrl .
                    '/auth/v1/admin/users/' .
                    $user->id,

                [

                    'headers' => [

                        'apikey' =>
                            $supabaseKey,

                        'Authorization' =>
                            'Bearer ' . $supabaseKey,

                        'Content-Type' =>
                            'application/json',
                    ]
                ]
            );

            // =========================================
            // DELETE TABLE USERS
            // =========================================

            $user->delete();

            return redirect()
                ->route('admin.users.index')
                ->with(
                    'success',
                    'User berhasil dihapus'
                );

        } catch (\Exception $e) {

            return back()->with(
                'error',
                'Gagal hapus user : ' .
                $e->getMessage()
            );
        }
    }
}