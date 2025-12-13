<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Pemilik\DashboardController as PemilikDashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Penyewa\PelaporanController;
use App\Http\Controllers\Penyewa\PembayaranController;
use App\Http\Controllers\Penyewa\BerandaController;
use App\Http\Controllers\Penyewa\RiwayatController;
use App\Http\Controllers\Penyewa\ProfileController;
use App\Http\Controllers\Penyewa\KamarController;
use App\Http\Controllers\Penyewa\BookingController;
use App\Http\Controllers\Admin\KamarController as AdminKamarController;
use App\Http\Controllers\Admin\AdminPelaporanController;
use App\Http\Controllers\Petugas\PetugasPelaporanController;

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

Route::middleware('auth')->group(function () {
    // BAWAAN DARI BREEZE
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // --- PENYEWA ---
    Route::get('/beranda', [BerandaController::class, 'index'])->name('penyewa.beranda');

    Route::get('/profil', [ProfileController::class, 'index'])->name('profil.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('penyewa.riwayat');

    Route::get('/kamar', [KamarController::class, 'index'])->name('kamar.index');
    Route::get('/kamar/{id}', [KamarController::class, 'show'])->name('kamar.show')->whereNumber('id');;

    Route::get('/kamar/booking/create/{kamar_id}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/kamar/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/kamar/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/kamar/booking/{id}', [BookingController::class, 'show'])->name('booking.show');
    Route::patch('/kamar/booking/{id}', [BookingController::class, 'update'])->name('booking.update');

    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    // untuk lanjut bayar setelah dp
    Route::get('/pembayaran/pay/{id_booking}', [PembayaranController::class, 'paymentPage'])->name('pembayaran.pay');

    Route::get('/beranda/pelaporan', [PelaporanController::class, 'index'])->name('pelaporan.index');
    Route::post('/beranda/pelaporan', [PelaporanController::class, 'store'])->name('pelaporan.store');
    // END PENYEWA

    // --- ADMIN ---
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('/pembayaran', [PembayaranController::class, 'adminIndex'])->name('pembayaran.index');

        Route::get('/pelaporan', [AdminPelaporanController::class, 'index'])->name('pelaporan');
        Route::patch('/pelaporan/{id}/update', [AdminPelaporanController::class, 'updateStatusAdmin'])->name('pelaporan.update');

        Route::get('/kamar', [AdminKamarController::class, 'index'])->name('kamar.index');
        Route::post('/kamar', [AdminKamarController::class, 'store'])->name('kamar.store');
        Route::get('/kamar/{id}', [AdminKamarController::class, 'show'])->name('kamar.show');
        Route::put('/kamar/{id}', [AdminKamarController::class, 'update'])->name('kamar.update');
        Route::delete('/kamar/{id}', [AdminKamarController::class, 'destroy'])->name('kamar.destroy');

        // Route::get('/booking', [AdminBookingController::class, 'index'])->name('booking.index');
        // Route::get('/booking/{id}', [AdminBookingController::class, 'show'])->name('booking.show');
    });

    // --- PEMILIK ---
    Route::middleware(['role:pemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
        Route::get('/dashboard', [PemilikDashboardController::class, 'index'])->name('dashboard');
        Route::get('/pembayaran', [PembayaranController::class, 'pemilikIndex'])->name('pembayaran.index');
    });

    // --- Petugas ---
    Route::middleware(['role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/pelaporan', [PetugasPelaporanController::class, 'index'])->name('pelaporan.index');
    Route::get('/pelaporan/{id}', [PetugasPelaporanController::class, 'show'])->name('pelaporan.show');
    Route::patch('/pelaporan/{id}', [PetugasPelaporanController::class, 'updateStatus'])->name('pelaporan.update');
    });
});

require __DIR__ . '/auth.php';
