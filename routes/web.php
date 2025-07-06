<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\DashboardController;


// Halaman utama (welcome) dengan histori pengiriman untuk customer
Route::match(['get', 'post'], '/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');


// Auth routes (guest only)
Route::get('/login', [AuthController::class, 'login'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/register', [AuthController::class, 'register'])
    ->name('register')
    ->middleware('guest');
Route::post('/register', [AuthController::class, 'store']);


// Protected resource routes
Route::middleware('auth')->group(function () {
    Route::resource('shipments', ShipmentController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('payments', PaymentController::class);
    Route::get('/payments/{payment}/pay', [PaymentController::class, 'pay'])
        ->name('payments.pay');
    Route::resource('trackings', TrackingController::class);
});

// Google OAuth
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])
    ->name('login.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Midtrans webhook (public)
Route::post(
    '/payments/notification',
    [PaymentController::class, 'notificationHandler']
)->name('payments.notification');

// Tidak perlu route tambahan untuk /track, karena sudah ditangani di HomeController@index
