<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\BackEnd\DashboardController;
use App\Http\Controllers\BackEnd\DataPetugasController;
use App\Http\Controllers\BackEnd\DataUserController;
use App\Http\Controllers\BackEnd\PengaduanController;
use App\Http\Controllers\BackEnd\TanggapanController;
use App\Http\Controllers\ChatController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =====================
// PUBLIC ROUTES
// =====================
Route::get('/', [SiteController::class, 'index']);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'prosesLogin'])->name('proses.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('proses.logout');

Route::prefix('site')->group(function () {
    Route::post('/cari-pengaduan', [SiteController::class, 'handleSearch'])->name('pengaduan.search');
    Route::get('/cek-pengaduan', [SiteController::class, 'handleCheck'])->name('pengaduan.check');
});


// =====================
// ADMIN & PETUGAS PANEL
// =====================
Route::middleware(['auth', 'rolecheck:admin,petugas'])
    ->prefix('panel')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Pengaduan
        Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan');
        Route::get('/pengaduan/detail/{id}', [PengaduanController::class, 'detail'])->name('detail.laporan');
        Route::get('/pengaduan/create-pdf', [PengaduanController::class, 'createPDF'])->name('print.laporan');

        Route::get('/tanggapan/{id}', [PengaduanController::class, 'tanggapan'])->name('tanggapan');
        Route::post('/tanggapan/{id}', [PengaduanController::class, 'storeTanggapan'])->name('store.tanggapan');

        // Master Data (read-only for petugas/admin)
        Route::get('/masterdata/users', [DataUserController::class, 'index'])->name('data.users');
        Route::get('/masterdata/petugas', [DataPetugasController::class, 'index'])->name('data.petugas');
    });


// =====================
// ADMIN ONLY
// =====================
Route::middleware(['auth', 'rolecheck:admin'])
    ->prefix('panel/masterdata')
    ->group(function () {

        // USERS
        Route::get('/users/create', [DataUserController::class, 'create'])->name('create.user');
        Route::post('/users/create', [DataUserController::class, 'store'])->name('store.user');
        Route::get('/users/edit/{id}', [DataUserController::class, 'edit'])->name('edit.user');
        Route::put('/users/update/{id}', [DataUserController::class, 'update'])->name('update.user');
        Route::delete('/users/delete/{id}', [DataUserController::class, 'destroy'])->name('destroy.user');

        // PETUGAS
        Route::get('/petugas/create', [DataPetugasController::class, 'create'])->name('create.petugas');
        Route::post('/petugas/create', [DataPetugasController::class, 'store'])->name('store.petugas');
        Route::get('/petugas/edit/{id}', [DataPetugasController::class, 'edit'])->name('edit.petugas');
        Route::put('/petugas/update/{id}', [DataPetugasController::class, 'update'])->name('update.petugas');
        Route::delete('/petugas/delete/{id}', [DataPetugasController::class, 'destroy'])->name('destroy.petugas');
    });


// =====================
// USER AREA
// =====================
Route::prefix('site')->group(function () {

    // 🌍 CHAT (TANPA LOGIN)
    Route::get('/chat', function () {
        return view('chat');
    })->name('chat');

    Route::post('/chat/send', [ChatController::class, 'send'])
        ->name('chat.send');

});


Route::middleware(['auth', 'rolecheck:user'])
    ->prefix('site')
    ->group(function () {

        Route::get('/sukses', [SiteController::class, 'success'])->name('success');

        Route::get('/buat-pengaduan', [SiteController::class, 'create']);
        Route::post('/buat-pengaduan', [SiteController::class, 'store'])->name('pengaduan.store');

        Route::get('/pengaduan/{id}/edit', [SiteController::class, 'edit'])->name('pengaduan.edit');
        Route::put('/pengaduan/{id}/update', [SiteController::class, 'update'])->name('pengaduan.update');
        Route::delete('/pengaduan/{id}/delete', [SiteController::class, 'destroy'])->name('pengaduan.delete');

        Route::get('/pengaduan/{id}', [SiteController::class, 'handleDetail'])->name('detail.pengaduan');

    });

