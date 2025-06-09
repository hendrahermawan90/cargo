<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController; // Tambahkan import untuk OrderController
use App\Http\Controllers\GoogleController;

// Halaman utama atau welcome
Route::get('/', function () {
    return view('welcome');
});

// Halaman login dan register hanya dapat diakses oleh pengguna yang belum login
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman register hanya dapat diakses oleh pengguna yang belum login
Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'store']);

// Halaman dashboard hanya bisa diakses oleh pengguna yang sudah login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Rute untuk shipments hanya bisa diakses oleh pengguna yang sudah login
Route::middleware('auth')->group(function () {
    Route::resource('shipments', ShipmentController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('orders', OrderController::class); // Menambahkan resource route untuk Order
});

Route::get('auth/google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('auth/google/callback', function () {
    $user = Socialite::driver('google')->user();
    
    // Cek data user
    dd($user);

    // Biasanya di sini kamu buat login otomatis
});

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])
    ->name('login.google');

Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);