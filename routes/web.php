<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DesaController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminApparatusController;
use App\Http\Controllers\Admin\AdminAspirationController;
use App\Http\Controllers\Admin\AdminSuratController;
use App\Http\Controllers\Admin\AdminBeritaController;
use App\Http\Controllers\Admin\AdminKegiatanController;

// Halaman Utama Profil Desa
Route::get('/', [DesaController::class, 'index'])->name('home');

// API Submit Aspirasi Kontak Warga
Route::post('/aspirasi', [DesaController::class, 'submitAspirasi'])->name('aspirasi.submit');

// API Submit Pengajuan Surat Mandiri
Route::post('/api/layanan-surat', [DesaController::class, 'submitSurat'])->name('surat.submit');

// Sisi Admin (Authentication)
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login']);
});

// Sisi Admin (Dashboard & CRUD - Protected)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // CRUD Perangkat Desa
    Route::resource('apparatus', AdminApparatusController::class)->parameters([
        'apparatus' => 'apparatus'
    ]);
    
    // CRUD Berita Desa
    Route::resource('news', AdminBeritaController::class);
    
    // CRUD Kegiatan/Acara Desa
    Route::resource('events', AdminKegiatanController::class);
    
    // Kelola Aspirasi Warga (Hanya lihat daftar, detail, dan hapus)
    Route::resource('aspiration', AdminAspirationController::class)->only(['index', 'show', 'destroy']);
    
    // Kelola Surat Pengajuan Warga
    Route::resource('surat', AdminSuratController::class)->only(['index', 'show', 'update', 'destroy']);
});
