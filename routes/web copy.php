<?php

use App\Http\Controllers\admin\AkunController;
use Illuminate\Support\Facades\Route;
// routes/web.php
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\HargaController;
use App\Http\Controllers\KelompokPanganController;
use App\Http\Controllers\KomoditasPanganController;
use App\Http\Controllers\JenisPanganController;
use App\Http\Controllers\KodeReferensiController;
use App\Http\Controllers\LevelPanganController;
use App\Http\Controllers\Auth\LoginController;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('kelompok', KelompokPanganController::class);
    Route::resource('komoditas', KomoditasPanganController::class);
    Route::resource('jenis', JenisPanganController::class);
    Route::resource('level', LevelPanganController::class);
});

Route::get('/docs/openapi.yaml', function () {
    return response()->file(base_path('docs/openapi.yaml'));
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function (){
    return view('dashboard');
})->middleware('auth');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/harga', [HargaController::class, 'index'])->name('harga.index');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/akun', [AkunController::class, 'index'])->name('akun.index');
});
