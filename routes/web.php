<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Siswa\AspirasiController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('siswa.login');
});

/*
|--------------------------------------------------------------------------
| SISWA
|--------------------------------------------------------------------------
*/
Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/login', [LoginController::class, 'showSiswaLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'siswaLogin']);
    Route::post('/logout', [LoginController::class, 'siswaLogout'])->name('logout');

    Route::middleware('auth:siswa')->group(function () {
        Route::get('/dashboard', [AspirasiController::class, 'index'])->name('dashboard');
        Route::post('/aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store');
    });
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'showAdminLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'adminLogin']);
    Route::post('/logout', [LoginController::class, 'adminLogout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::put('/aspirasi/{aspirasi}', [DashboardController::class, 'update'])->name('aspirasi.update');
        Route::resource('kategori', \App\Http\Controllers\Admin\KategoriController::class)->only(['index', 'store', 'update', 'destroy']);
    });
});
