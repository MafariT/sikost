<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::middleware('api')->group(function () {
    Route::match(['put', 'post'], '/profile', [ProfileController::class, 'upsertProfile']);

    Route::get('/admin/profile/{id_user}', [ProfileController::class, 'showByUser']);
    Route::put('/admin/profile/{id_user}', [ProfileController::class, 'updateStatus']);
});
