<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PengaduanController;
use App\Http\Controllers\API\TanggapanController;
use App\Http\Controllers\Auth\AuthController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {

    // AUTH
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/refresh', [AuthController::class, 'refresh']);

    Route::middleware(['jwt.verify', 'rolecheck:user'])->group(function () {

        // Pengaduan
        Route::get('/pengaduan', [PengaduanController::class, 'index']);
        Route::get('/pengaduan/{id}', [PengaduanController::class, 'show']);
        Route::post('/pengaduan', [PengaduanController::class, 'store']);
        Route::put('/pengaduan/{id}', [PengaduanController::class, 'update']);
        Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy']);

        // Tanggapan
        Route::get('/tanggapan', [TanggapanController::class, 'index']);
        Route::get('/tanggapan/pengaduan/{id}', [TanggapanController::class, 'byPengaduan']);

        // Logout
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});