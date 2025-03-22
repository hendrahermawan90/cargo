<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\TrackingController;

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
});

// Rute untuk tracking
Route::get('/track', [TrackingController::class, 'track'])->name('track'); // Form tracking

Route::get('/tracking/{tracking_number}', [TrackingController::class, 'track'])->name('tracking.track');

Route::post('/track/update', [TrackingController::class, 'updateTracking']); // Update tracking
