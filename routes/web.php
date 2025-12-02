<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Penyewa\BerandaController;
use App\Http\Controllers\Penyewa\ProfileController;
use App\Http\Controllers\Penyewa\RiwayatController;
use App\Http\Controllers\PembayaranController;

Route::get('/', function () {
    return view('welcome');
});

//Route Penyewa
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
Route::get('/profil', [ProfileController::class, 'index'])->name('profil');
Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/midtrans/webhook', [PembayaranController::class, 'notificationHandler']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
