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
Route::get('/marketplace', [MarketplaceController::class, 'index'])->middleware('auth')->name('marketplace.index');
Route::get('/konsultasi', [KonsultasiController::class, 'index'])->middleware('auth')->name('konsultasi.index');

Route::resource('konsultasi', KonsultasiController::class);
Route::post('konsultasi/{konsultasi}/pesan', [PesanController::class, 'store'])->name('pesan.store');

Route::post('/upload-image', [ChatController::class, 'uploadImage'])->name('upload.image');

Route::middleware(['auth'])->group(function () {
    Route::get('/marketplace', [MarketplaceController::class, 'index'])->name('marketplace');
    Route::get('/marketplace/create', [MarketplaceController::class, 'create'])->name('marketplace.create');
    Route::post('/marketplace', [MarketplaceController::class, 'store'])->name('marketplace.store');
    Route::get('/marketplace/{product}', [MarketplaceController::class, 'show'])->name('marketplace.show');
    Route::get('/marketplace/{product}/edit', [MarketplaceController::class, 'edit'])->name('marketplace.edit');
    Route::put('/marketplace/{product}', [MarketplaceController::class, 'update'])->name('marketplace.update');
    Route::delete('/marketplace/{product}', [MarketplaceController::class, 'destroy'])->name('marketplace.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/guide-books', [GuideBookController::class, 'index'])->name('guide-books.index');
    Route::get('/guide-books/create', [GuideBookController::class, 'create'])->name('guide-books.create');
    Route::post('/guide-books', [GuideBookController::class, 'store'])->name('guide-books.store');
    Route::get('/guide-books/{guideBook}', [GuideBookController::class, 'show'])->name('guide-books.show');
    Route::get('/guide-books/{guideBook}/edit', [GuideBookController::class, 'edit'])->name('guide-books.edit');
    Route::put('/guide-books/{guideBook}', [GuideBookController::class, 'update'])->name('guide-books.update');
    Route::delete('/guide-books/{guideBook}', [GuideBookController::class, 'destroy'])->name('guide-books.destroy');
});

Route::post('/pesan/{pesan}/status/{status}', [PesanController::class, 'updateStatus'])->name('pesan.updateStatus');

Route::get('/konsultasi/{konsultasi}/messages-status', [KonsultasiController::class, 'getMessagesStatus'])
    ->name('konsultasi.messages-status');

Route::get('/konsultasi/status-updates', [KonsultasiController::class, 'getStatusUpdates']);
