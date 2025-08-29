<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PosyanduController;

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

// Auth scaffolding (register, login, logout)
require __DIR__.'/auth.php';
