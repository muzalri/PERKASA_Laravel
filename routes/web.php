<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// Halaman Auth
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');

// Halaman Admin (hanya view)
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Guide Books
    Route::get('/guide-books', [AdminController::class, 'indexGuideBooks'])->name('guide-books.index');
    Route::get('/guide-books/create', [AdminController::class, 'createGuideBook'])->name('guide-books.create');
    Route::get('/guide-books/{id}/edit', [AdminController::class, 'editGuideBook'])->name('guide-books.edit');
    Route::get('/guide-books/{id}', [AdminController::class, 'showGuideBook'])->name('guide-books.show');
    
    // Categories
    Route::get('/categories', [AdminController::class, 'indexCategories'])->name('categories.index');
    
    // Articles
    Route::get('/articles', [AdminController::class, 'indexArticles'])->name('articles.index');
    Route::get('/articles/{id}', [AdminController::class, 'showArticle'])->name('articles.show');
});

