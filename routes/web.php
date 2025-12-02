<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PembayaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/midtrans/webhook', [PembayaranController::class, 'notificationHandler']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Untuk route tidak diblokir per-role untuk testing
Route::middleware(['auth'])->group(function () {
    
    // --- AREA PENYEWA ---
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');

    // --- AREA ADMIN ---
    Route::middleware([])->prefix('admin')->group(function () {
        Route::get('/pembayaran', [PembayaranController::class, 'adminIndex'])->name('admin.pembayaran.index');
    });

    // --- AREA PEMILIK ---
    Route::middleware([])->prefix('pemilik')->group(function () {
        Route::get('/pembayaran', [PembayaranController::class, 'pemilikIndex'])->name('pemilik.pembayaran.index');
    });

});

require __DIR__.'/auth.php';
