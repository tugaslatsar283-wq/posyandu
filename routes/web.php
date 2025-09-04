<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\GiziController;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\AdminDashboardController;


// Halaman Welcome
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (semua yang login bisa akses)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// SUPERADMIN -> kelola User
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::resource('users', UserController::class);
});

// SUPERADMIN & ADMIN -> kelola Desa & Posyandu
Route::middleware(['auth', 'role:superadmin,admin'])->group(function () {
    Route::resource('desa', DesaController::class);
    Route::resource('posyandu', PosyanduController::class);
});

// OPERATOR -> hanya bisa kelola posyandu desanya sendiri
Route::middleware(['auth', 'role:operator'])->group(function () {
    Route::resource('posyandu', PosyanduController::class)->only([
        'index', 'create', 'store', 'edit', 'update'
    ]);
});

Route::post('/gizi/store', [GiziController::class, 'store'])->name('gizi.store');
Route::post('/kader/store', [KaderController::class, 'store'])->name('kader.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/gizi', [GiziController::class, 'index'])->name('gizi.index');
    Route::post('/gizi', [GiziController::class, 'store'])->name('gizi.store');
    Route::delete('/gizi/{id}', [GiziController::class, 'destroy'])->name('gizi.destroy');
});

Route::resource('posyandu', PosyanduController::class)->only(['index','store','destroy']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/laporan', [AdminDashboardController::class, 'laporan'])
        ->name('admin.laporan');
});

// routes/web.php
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard/print', [AdminDashboardController::class, 'print'])->name('admin.dashboard.print');
});
// Auth scaffolding (register, login, logout)
require __DIR__.'/auth.php';
