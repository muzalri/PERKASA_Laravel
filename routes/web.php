<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KomunitasController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\KonsulController;
use App\Http\Controllers\AuthController;



Route::get('/', function () {
    return view('welcome');
});

// Halaman Utama


// Autentikasi
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profil Pengguna
Route::get('/profile', [AuthController::class, 'showProfile'])->middleware('auth')->name('profile');
Route::get('/profile/edit', [AuthController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::post('/profile/edit', [AuthController::class, 'update'])->middleware('auth')->name('profile.update');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');


// Komunitas (CRUD dan Like/Dislike)
Route::get('/komunitas/index', [KomunitasController::class, 'index'])->name('komunitas');
Route::middleware(['auth'])->group(function () {
    Route::get('/komunitas/create', [KomunitasController::class, 'articlecreate'])->name('komunitas.create');
    Route::post('/komunitas', [KomunitasController::class, 'articlestore'])->name('komunitas.store');
    Route::get('/komunitas/{komunitas}/edit', [KomunitasController::class, 'articleedit'])->name('komunitas.edit');
    Route::put('/komunitas/{komunitas}', [KomunitasController::class, 'articleupdate'])->name('komunitas.update');
    Route::delete('/komunitas/{komunitas}', [KomunitasController::class, 'articledestroy'])->name('komunitas.destroy');
    Route::post('/komunitas/{komunitas}/toggle-like', [KomunitasController::class, 'toggleLike'])->name('komunitas.toggleLike');
});
//route untuk komentar
Route::middleware(['auth'])->group(function () {
    // Menyimpan Komentar
    Route::post('/komunitas/{komunitas}/komentar', [KomunitasController::class, 'komentarstore'])->name('komunitas.komentar.store');

    // Menghapus Komentar
    Route::delete('/komentar/{komentar}', [KomunitasController::class, 'komentardestroy'])->name('komentar.destroy');
});

// Detail Komunitas
Route::get('/komunitas/{komunitas}', [KomunitasController::class, 'articleshow'])->name('komunitas.show');

// Marketplace dan Konsultasi
Route::get('/marketplace', [MarketplaceController::class, 'index'])->middleware('auth')->name('marketplace');
Route::get('/konsul', [KonsulController::class, 'index'])->middleware('auth')->name('konsul');