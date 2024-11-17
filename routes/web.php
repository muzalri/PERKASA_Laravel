<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KomunitasController;
use App\Http\Controllers\KonsulController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\GuideBookController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Api\AuthController as ApiAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


Route::get('/', function () {
    return view('welcome');
});

// Halaman Utama


// Autentikasi
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth');

// Profil Pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::get('/profile/edit', [AuthController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [AuthController::class, 'update'])->name('profile.update');
    Route::post('/profile/upload-photo', [AuthController::class, 'uploadPhoto'])->name('profile.upload-photo');
    Route::delete('/profile/delete-photo', [AuthController::class, 'deletePhoto'])->name('profile.delete-photo');
});

// Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


// Komunitas (CRUD dan Like/Dislike)
Route::middleware(['auth'])->group(function () {
    Route::get('/komunitas', [KomunitasController::class, 'index'])->name('komunitas.index');
    Route::get('/komunitas/create', [KomunitasController::class, 'articlecreate'])->name('komunitas.create');
    Route::post('/komunitas', [KomunitasController::class, 'articlestore'])->name('komunitas.store');
    Route::get('/komunitas/{komunitas}', [KomunitasController::class, 'articleshow'])->name('komunitas.show');
    Route::get('/komunitas/{komunitas}/edit', [KomunitasController::class, 'articleedit'])->name('komunitas.edit');
    Route::put('/komunitas/{komunitas}', [KomunitasController::class, 'articleupdate'])->name('komunitas.update');
    Route::delete('/komunitas/{komunitas}', [KomunitasController::class, 'articledelete'])->name('komunitas.destroy');
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


Route::resource('konsultasi', KonsultasiController::class);
Route::post('konsultasi/{konsultasi}/pesan', [PesanController::class, 'store'])->name('pesan.store');

Route::resource('guide-books', GuideBookController::class)->middleware('auth');

Route::post('/pesan/{pesan}/status/{status}', [PesanController::class, 'updateStatus'])->name('pesan.updateStatus');

Route::get('/konsultasi/{konsultasi}/messages-status', [KonsultasiController::class, 'getMessagesStatus'])
    ->name('konsultasi.messages-status');

Route::get('/konsultasi/status-updates', [KonsultasiController::class, 'getStatusUpdates']);

Route::delete('/konsultasi/{konsultasi}', [KonsultasiController::class, 'destroy'])
    ->name('konsultasi.destroy')
    ->middleware('auth');


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard utama admin
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Manajemen Artikel/Komunitas
    Route::get('/articles', [AdminController::class, 'indexArticles'])->name('articles.index');
    Route::get('/articles/{komunitas}', [AdminController::class, 'showArticle'])->name('articles.show');
    Route::delete('/articles/{komunitas}', [AdminController::class, 'deleteArticle'])->name('articles.destroy');
    Route::delete('/articles/{komunitas}/comments/{komentar}', [AdminController::class, 'deleteKomentar'])->name('articles.comments.destroy');
    
    // Manajemen Kategori
    Route::get('/categories', [AdminController::class, 'indexCategories'])->name('categories.index');
    Route::post('/categories', [AdminController::class, 'createCategory'])->name('categories.store');
    Route::delete('/categories/{category}', [AdminController::class, 'deleteCategory'])->name('categories.destroy');
    
    // Manajemen Guide Books
    Route::get('/guide-books', [AdminController::class, 'indexGuideBooks'])->name('guide-books.index');
    Route::get('/guide-books/create', [AdminController::class, 'createGuideBook'])->name('guide-books.create');
    Route::post('/guide-books', [AdminController::class, 'storeGuideBook'])->name('guide-books.store');
    Route::get('/guide-books/{guideBook}', [AdminController::class, 'showGuideBook'])->name('guide-books.show');
    Route::get('/guide-books/{guideBook}/edit', [AdminController::class, 'editGuideBook'])->name('guide-books.edit');
    Route::put('/guide-books/{guideBook}', [AdminController::class, 'updateGuideBook'])->name('guide-books.update');
    Route::delete('/guide-books/{guideBook}', [AdminController::class, 'destroyGuideBook'])->name('guide-books.destroy');
});
