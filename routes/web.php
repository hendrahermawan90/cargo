<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\ReportController;

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

    Route::get('/shipments', [ShipmentController::class, 'index'])
    ->middleware('auth') // Opsional: Batasi akses hanya untuk user yang login
    ->name('shipments.index');
});

// Route untuk halaman form tracking
Route::get('/track', function () {
    return view('tracking.form');
})->name('track');

// Route untuk menampilkan daftar tracking
Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking.index');

// Route untuk menampilkan detail tracking berdasarkan nomor tracking
Route::get('/tracking/{tracking_number}', [TrackingController::class, 'show'])->name('tracking.show');

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');