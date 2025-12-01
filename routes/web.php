<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelaporanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/pelaporan', [PelaporanController::class, 'index'])->name('pelaporan.index');
Route::post('/pelaporan/store', [PelaporanController::class, 'store'])->name('pelaporan.store');

// Khusus admin
Route::post('/pelaporan/{id}/update-admin', [PelaporanController::class, 'updateStatusAdmin'])
    ->name('pelaporan.update.admin');

// Khusus OB
Route::post('/pelaporan/{id}/update-ob', [PelaporanController::class, 'updateStatusOB'])
    ->name('pelaporan.update.ob');

require __DIR__.'/auth.php';
