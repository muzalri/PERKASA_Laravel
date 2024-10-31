<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KomunitasController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\KonsulController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\GuideBookController;
use App\Http\Controllers\ChatController;



Route::get('/', function () {
    return view('welcome');
});

// Halaman Utama


// Autentikasi
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

// Profil Pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::get('/profile/edit', [AuthController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [AuthController::class, 'update'])->name('profile.update');
    Route::post('/profile/upload-photo', [AuthController::class, 'uploadPhoto'])->name('profile.upload-photo');
    Route::delete('/profile/delete-photo', [AuthController::class, 'deletePhoto'])->name('profile.delete-photo');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');


// Komunitas (CRUD dan Like/Dislike)
Route::get('/komunitas/index', [KomunitasController::class, 'index'])->middleware('auth')->name('komunitas');
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
Route::get('/konsultasi', [KonsultasiController::class, 'index'])->middleware('auth')->name('konsultasi.index');

Route::resource('konsultasi', KonsultasiController::class);
Route::post('konsultasi/{konsultasi}/pesan', [PesanController::class, 'store'])->name('pesan.store');

Route::resource('guide-books', GuideBookController::class)->middleware('auth');

Route::post('/pesan/{pesan}/status/{status}', [PesanController::class, 'updateStatus'])->name('pesan.updateStatus');

Route::get('/konsultasi/{konsultasi}/messages-status', [KonsultasiController::class, 'getMessagesStatus'])
    ->name('konsultasi.messages-status');

Route::get('/konsultasi/status-updates', [KonsultasiController::class, 'getStatusUpdates']);
