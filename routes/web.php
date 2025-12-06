<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController; // <--- Pastikan baris ini ada

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Group Middleware Auth (Hanya yang login bisa akses)
Route::middleware('auth')->group(function () {
    
    // --- ROUTE BAWAAN LARAVEL BREEZE (Profile) ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- ROUTE BOOKING (YANG KITA BUAT SEKARANG) ---
    
    // 1. Menampilkan Form Booking (Saat klik tombol "Sewa" di kamar)
    // URL: domain.com/booking/kamar/1
    Route::get('/booking/kamar/{id_kamar}', [BookingController::class, 'create'])
        ->name('booking.create');

    // 2. Proses Simpan Booking (Saat klik tombol "Konfirmasi Sewa")
    Route::post('/booking/store', [BookingController::class, 'store'])
        ->name('booking.store');

    // 3. Menampilkan Riwayat Booking
    // URL: domain.com/booking/history
    Route::get('/booking/history', [BookingController::class, 'history'])
        ->name('booking.history');

});

require __DIR__.'/auth.php';