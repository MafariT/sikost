<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Pemilik\DashboardController as PemilikDashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Penyewa\PelaporanController;
use App\Http\Controllers\Penyewa\PembayaranController;
use App\Http\Controllers\Penyewa\BerandaController;
use App\Http\Controllers\Penyewa\RiwayatController;
use App\Http\Controllers\Penyewa\ProfileController;
use App\Http\Controllers\Admin\KamarController as AdminKamarController;
use App\Http\Controllers\Admin\PelaporanAdminController;
use App\Http\Controllers\Penyewa\KamarController;
use App\Http\Controllers\Penyewa\BookingController;

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

        Route::get('/pelaporan', [PelaporanAdminController::class, 'index'])->name('pelaporan');
        Route::patch('/pelaporan/{id}/update', [PelaporanAdminController::class, 'updateStatusAdmin'])->name('pelaporan.update');

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
        Route::post('/pelaporan/{id}/update', [PelaporanController::class, 'updateStatusOB'])->name('pelaporan.update');
    });
});

// Bagian Petugas (OB) - Mock Routes for Testing
Route::get('/petugas/pelaporan', function () {

    $keluhan = [
        (object)[
            'id' => 1,
            'judul_keluhan' => 'WC Mampet',
            'no_kamar' => 'A12',
            'status' => 'Pending',
            'tanggal_keluhan' => '05 Desember 2025',
            'waktu_keluhan' => '14:30',
        ],
        (object)[
            'id' => 2,
            'judul_keluhan' => 'Lampu Mati',
            'no_kamar' => 'B03',
            'status' => 'Diproses',
            'tanggal_keluhan' => '06 Desember 2025',
            'waktu_keluhan' => '09:15',
        ],
        (object)[
            'id' => 3,
            'judul_keluhan' => 'Kipas Rusak',
            'no_kamar' => 'C05',
            'status' => 'Selesai',
            'tanggal_keluhan' => '07 Desember 2025',
            'waktu_keluhan' => '16:45',
        ],
    ];

    return view('petugas.laporan', compact('keluhan'));
});
Route::get('/petugas/pelaporan/{id}', function ($id) {

    $keluhan = (object)[
        'id' => $id,
        'judul_keluhan' => 'WC Mampet',
        'no_kamar' => 'A12',
        'deskripsi_keluhan' =>
        'Sudah 2 hari WC tidak bisa digunakan dan bau menyengat.',
        'foto_bukti' => 'keluhan/before/contoh.jpg',
        'foto_after_perbaikan' => null,
        'status' => 'Pending',
        'tanggal_keluhan' => '05 Desember 2025',
        'waktu_keluhan' => '14:30',
    ];

    return view('petugas.detail', compact('keluhan'));
});
// End of Petugas (OB) Mock Routes

require __DIR__ . '/auth.php';
