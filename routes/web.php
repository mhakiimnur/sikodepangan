<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\JenisPanganController;
use App\Http\Controllers\KelompokPanganController;
use App\Http\Controllers\KomoditasPanganController;
use App\Http\Controllers\LevelPanganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('kelompok', KelompokPanganController::class);
    Route::resource('komoditas', KomoditasPanganController::class);
    Route::get('/get-last-komoditas/{kode_kelompok}', [KomoditasPanganController::class, 'getLastKomoditas'])->name('komoditas.getLast');
    Route::resource('jenis', JenisPanganController::class);
    Route::get('/get-last-jenis/{kode_komoditas}', [JenisPanganController::class, 'getLastJenis'])->name('jenis.getLast');
    Route::resource('level', LevelPanganController::class);
    Route::get('/level/available-categories/{kodeJenis}', [LevelPanganController::class, 'getAvailableCategories'])->name('level.available');

});

require __DIR__.'/auth.php';
