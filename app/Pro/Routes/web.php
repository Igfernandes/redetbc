<?php

use App\Http\Controllers\HomeController;
use \Illuminate\Support\Facades\Route;

Route::prefix('pro')->name('pro.')->middleware(['web', 'auth', 'dashboard'])->group(function () {
    Route::get('/upgrade', [\App\Pro\Controllers\UpgradeController::class, 'index'])->name('upgrade');
    Route::post('/buy', [\App\Pro\Controllers\BuyController::class, 'index'])->name('buy');
});

Route::middleware(['web'])->group(function () {
    Route::get("homepage", [HomeController::class, "homepage"]);
});