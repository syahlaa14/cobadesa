<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminApparatusController;
use App\Http\Controllers\AdminTourismController;
use App\Http\Controllers\AdminAspirationController;

// Halaman Utama Profil Desa
Route::get('/', [DesaController::class, 'index'])->name('home');

// API Submit Aspirasi Kontak Warga
Route::post('/aspirasi', [DesaController::class, 'submitAspirasi'])->name('aspirasi.submit');

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
    Route::resource('apparatus', AdminApparatusController::class);
    
    // CRUD Pariwisata Desa
    Route::resource('tourism', AdminTourismController::class);
    
    // Kelola Aspirasi Warga (Hanya lihat daftar, detail, dan hapus)
    Route::resource('aspiration', AdminAspirationController::class)->only(['index', 'show', 'destroy']);
});
