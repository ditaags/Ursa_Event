<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
// Pindahkan rute "/" ke paling atas agar menjadi prioritas utama
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/event', function () { return view('events'); })->name('events');
Route::get('/kontak', function () { return view('kontak'); })->name('kontak');

/*
|--------------------------------------------------------------------------
| Auth Routes (Login & Logout)
|--------------------------------------------------------------------------
*/
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Logout sebaiknya diletakkan di dalam auth agar hanya user yang login yang bisa akses
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // Jika ingin bisa logout via URL (GET), gunakan match:
    Route::get('/logout', [AuthController::class, 'logout']); 
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

    // Tambahkan rute admin lainnya di sini
});

/*
|--------------------------------------------------------------------------
| Redirect Helpers
|--------------------------------------------------------------------------
*/
// Memastikan jika mengetik /admin langsung dilempar ke dashboard yang benar
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth');