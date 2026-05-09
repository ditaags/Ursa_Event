<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\EventController; 
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/event', function () {
    return view('events');
})->name('events');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', [AuthController::class, 'logout']);
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin.only'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Route Beranda & Kontak
    Route::get('/admin/edit-beranda', [HomeController::class, 'edit'])->name('admin.edit_beranda');
    Route::post('/admin/update-beranda', [HomeController::class, 'update'])->name('admin.update_beranda');
    Route::get('/admin/edit-kontak', [HomeController::class, 'editContact'])->name('admin.edit_kontak');
    Route::post('/admin/update-kontak', [HomeController::class, 'updateContact'])->name('admin.update_kontak');

    // Route Event (Gunakan resource agar lebih simpel)
    Route::resource('/admin/events', EventController::class)->names('admin.events');

    // Route Admin / Users (Perbaikan di sini!)
    // Ini otomatis mendaftarkan index, create, store, edit, update, destroy
    Route::resource('/admin/users', UserController::class)->names('admin.users');

}); // <--- Pastikan kurung penutup group ini ada di paling bawah route admin

    // //Finance Route

Route::middleware(['auth'])->group(function () {
    Route::get('/laporan', function () {
        return view('laporan');
    })->name('laporan');
});

