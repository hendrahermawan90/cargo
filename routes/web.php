<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController; // Tambahkan import untuk OrderController
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TrackingController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\MidtransController;




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

// Rute hanya bisa diakses oleh pengguna yang sudah login
Route::middleware('auth')->group(function () {
    Route::resource('shipments', ShipmentController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('payments', PaymentController::class);
    Route::get('/payments/{payment}/pay', [PaymentController::class, 'pay'])->name('payments.pay');
    

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

// Webhook dari Midtrans (tanpa middleware auth!)
Route::post('/payments/notification', [PaymentController::class, 'notificationHandler'])->name('payments.notification');



// Menambahkan Route Tracking

Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking.index');
Route::get('/tracking/{kode}', [TrackingController::class, 'show'])->name('tracking.show');
Route::post('/tracking/{kode}/update-status', [TrackingController::class, 'updateStatus'])->name('tracking.updateStatus');

// Menambahkan Route untuk Reports

Route::prefix('reports')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/shipments', [ReportController::class, 'shipment'])->name('reports.shipments');
    Route::get('/payments', [ReportController::class, 'payment'])->name('reports.payments');
});

// Menambahkan Route untuk Report Payments

Route::get('/reports/payment', [ReportController::class, 'paymentReport'])->name('reports.payment');

// Export routes

Route::prefix('reports')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/shipments', [ReportController::class, 'shipment'])->name('reports.shipments');
    Route::get('/payments', [ReportController::class, 'payment'])->name('reports.payments');

    // Export
    Route::get('/shipments/excel', [ReportController::class, 'exportShipmentExcel'])->name('reports.shipments.excel');
    Route::get('/shipments/pdf', [ReportController::class, 'exportShipmentPDF'])->name('reports.shipments.pdf');
    Route::get('/payments/excel', [ReportController::class, 'exportPaymentExcel'])->name('reports.payments.excel');
    Route::get('/payments/pdf', [ReportController::class, 'exportPaymentPDF'])->name('reports.payments.pdf');
});


// Routes untuk Export Pdf 

Route::get('/reports/shipments/pdf', [ReportController::class, 'exportShipmentPDF'])->name('reports.shipment.pdf');


// Routes  untuk Midtrans Payment
Route::post('/midtrans/notification', [MidtransController::class, 'handleNotification']);


// menambahkan Route untuk Webhook Midtrans
Route::post('/midtrans/callback', [MidtransController::class, 'callback']);

// midtrans payment gateway 
Route::post('/midtrans-notification', [MidtransController::class, 'notificationHandler']);

Route::post('/payments/notification', [PaymentController::class, 'notificationHandler'])->name('payments.notification');

Route::post('/midtrans/callback', [PaymentController::class, 'notificationHandler']);