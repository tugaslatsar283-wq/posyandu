<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\GiziController;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\KeteranganBalitaController;

// ================= HALAMAN AWAL =================
Route::get('/', function () {
    return view('welcome');
});

// ================= DASHBOARD =================
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// ================= SUPERADMIN =================
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::resource('users', UserController::class);
});

// ================= SUPERADMIN & ADMIN =================
Route::middleware(['auth', 'role:superadmin,admin'])->group(function () {
    Route::resource('desa', DesaController::class);
    Route::resource('posyandu', PosyanduController::class);
});

// ================= OPERATOR =================
Route::middleware(['auth', 'role:operator'])->group(function () {
    Route::resource('posyandu', PosyanduController::class)->only([
        'index', 'create', 'store', 'edit', 'update'
    ]);
});

// ================= POSYANDU / GIZI / KADER =================
Route::middleware(['auth'])->group(function () {
    // Posyandu
    Route::resource('posyandus', PosyanduController::class);

    // Gizi
    Route::get('/gizi', [GiziController::class, 'index'])->name('gizi.index');
    Route::post('/gizi', [GiziController::class, 'store'])->name('gizi.store');
    Route::put('/gizi/{id}', [GiziController::class, 'update'])->name('gizi.update');
    Route::delete('/gizi/{id}', [GiziController::class, 'destroy'])->name('gizi.destroy');

    // Kader
    Route::post('/kader/store', [KaderController::class, 'store'])->name('kader.store');
});

// ================= ADMIN DASHBOARD =================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard/print', [AdminDashboardController::class, 'print'])->name('admin.dashboard.print');
    Route::get('/admin/laporan', [AdminDashboardController::class, 'laporan'])->name('admin.laporan');
});

// ================= CHART DATA =================
Route::get('/gizi/chart-data-all-desa', [DashboardController::class, 'giziChartDataAllDesa'])
    ->name('gizi.chartDataAllDesa');

// ================= KETERANGAN BALITA =================
Route::middleware(['auth'])->group(function () {
    // Operator/Admin Desa -> lihat berdasarkan gizi_id
    Route::get('/keterangan-balita/{gizi}', [KeteranganBalitaController::class, 'index'])
        ->name('keterangan_balita.index');
    Route::post('/keterangan-balita', [KeteranganBalitaController::class, 'store'])
        ->name('keterangan_balita.store');
    Route::put('/keterangan-balita/{id}', [KeteranganBalitaController::class, 'update'])
        ->name('keterangan_balita.update');
    Route::delete('/keterangan-balita/{id}', [KeteranganBalitaController::class, 'destroy'])
        ->name('keterangan_balita.destroy');
});

// ================= KETERANGAN BALITA ADMIN =================
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin Desa → filter berdasarkan desa_id
Route::get('/admin/desa/keterangan-balita/{desa}/{bulan?}', [KeteranganBalitaController::class, 'adminIndex'])
    ->name('admin.keterangan_balita.index');

// Admin Kecamatan → filter berdasarkan gizi_id
Route::get('/admin/kecamatan/keterangan-balita/{gizi}/{bulan?}', [KeteranganBalitaController::class, 'kecamatanIndex'])
    ->name('admin.kecamatan.keterangan_balita.index');
});

require __DIR__.'/auth.php';
