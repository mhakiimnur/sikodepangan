<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ReferensiPanganController;

Route::prefix('v1')->group(function () {

    // Endpoint All Data
    Route::get('all-kode', [ReferensiPanganController::class, 'getAllKode']);
    
    // Endpoint Kelompok Pangan
    Route::get('kelompok-pangan', [ReferensiPanganController::class, 'kelompok']);
    Route::get('kelompok-pangan/{kode}', [ReferensiPanganController::class, 'kelompokByKode']);

    // Endpoint Komoditas Pangan
    Route::get('komoditas-pangan', [ReferensiPanganController::class, 'komoditas']);
    Route::get('komoditas-pangan/{kode_kelompok}', [ReferensiPanganController::class, 'komoditasByKelompok']);

    // Endpoint Jenis Pangan
    Route::get('jenis-pangan', [ReferensiPanganController::class, 'jenis']);
    Route::get('jenis-pangan/{kode}', [ReferensiPanganController::class, 'jenisByKomoditas']);

    // Endpoint Level Pangan
    Route::get('level-pangan', [ReferensiPanganController::class, 'level']);
    Route::get('level-pangan/{kode}', [ReferensiPanganController::class, 'levelByJenis']);
});
