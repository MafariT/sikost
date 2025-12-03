<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KamarController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\Penyewa\BerandaController;
use App\Http\Controllers\profil\ProfileController;
use App\Http\Controllers\Admin\ProfileAdminController;
use App\Http\Controllers\Penyewa\ProfileController as PenyewaProfileController;
use App\Http\Controllers\Penyewa\RiwayatController;
use App\Http\Controllers\Admin\KamarController as AdminKamarController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Midtrans Webhook
Route::post('/midtrans/webhook', [PembayaranController::class, 'notificationHandler'])->name('midtrans.webhook');


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

// Route::middleware('auth')->group(function () {
    // BAWAAN DARI BREEZE
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil.index');
    Route::post('/profil', [ProfileController::class, 'update'])->name('profil.update');
});

    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // --- PENYEWA ---
    Route::get('/beranda', [BerandaController::class, 'index'])->name('penyewa.beranda');
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('penyewa.riwayat');
    
    Route::get('/kamar', [KamarController::class, 'index'])->name('kamar.index');
    Route::get('/kamar/{id}', [KamarController::class, 'show'])->name('kamar.show');

    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');

    Route::get('/pelaporan', [PelaporanController::class, 'index'])->name('pelaporan.index');
    Route::post('/pelaporan', [PelaporanController::class, 'store'])->name('pelaporan.store');

    // --- ADMIN ---
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/pembayaran', [PembayaranController::class, 'adminIndex'])->name('pembayaran.index');
        
        Route::post('/pelaporan/{id}/update', [PelaporanController::class, 'updateStatusAdmin'])->name('pelaporan.update');

        Route::get('/kamar', [AdminKamarController::class, 'index'])->name('kamar.index');
        Route::post('/kamar', [AdminKamarController::class, 'store'])->name('kamar.store');
        Route::get('/kamar/{id}', [AdminKamarController::class, 'show'])->name('kamar.show');
        Route::put('/kamar/{id}', [AdminKamarController::class, 'update'])->name('kamar.update');
        Route::delete('/kamar/{id}', [AdminKamarController::class, 'destroy'])->name('kamar.destroy');
    });

   Route::middleware(['auth', 'active', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/profiles', [ProfileAdminController::class, 'index'])->name('profiles.index');
        Route::get('/profiles/{id_profile}', [ProfileAdminController::class, 'show'])->name('profiles.show');
        Route::post('/users/{userId}/toggle', [ProfileAdminController::class, 'toggleUser'])->name('users.toggle');
    });

    // --- PEMILIK ---
    Route::prefix('pemilik')->name('pemilik.')->group(function () {
        Route::get('/pembayaran', [PembayaranController::class, 'pemilikIndex'])->name('pembayaran.index');
    });
    // --- OB ---
    Route::prefix('ob')->name('ob.')->group(function () {
        Route::post('/pelaporan/{id}/update', [PelaporanController::class, 'updateStatusOB'])->name('pelaporan.update');
    });

    // ------------ ROUTE SENGAJA TIDAK DI BLOCK PER-ROLE SAAT DEVELOPMENT ------------
    // ------------ JIKA SUDAH PRODUCTION GANTI DENGAN FUNCTION DIBAWAH ------------

    // Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {});
    // Route::middleware(['role:pemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {});
    // Route::middleware(['role:ob'])->prefix('ob')->name('ob.')->group(function () {});
// });

require __DIR__ . '/auth.php';