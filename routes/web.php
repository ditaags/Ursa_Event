<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard'); // Beri nama agar mudah dipanggil

Route::get('/event', function () { return view('events'); })->name('events');
Route::get('/kontak', function () { return view('kontak'); })->name('kontak');

/*
|--------------------------------------------------------------------------
| Auth Routes (Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');
});

/*

*/
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth');