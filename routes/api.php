<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KomunitasController;
use App\Http\Controllers\Api\KonsultasiController;
use App\Http\Controllers\Api\GuideBookController;
use App\Http\Controllers\Api\PesanController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\RoleChangeRequestController;

// Auth Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/profile', [AuthController::class, 'update']);
    Route::delete('/profile', [AuthController::class, 'deleteProfile']);
    Route::post('/profile/photo', [AuthController::class, 'uploadPhoto']);
    Route::delete('/profile/photo', [AuthController::class, 'deletePhoto']);

    // Komunitas
    Route::get('/komunitas', [KomunitasController::class, 'index']);
    Route::post('/komunitas', [KomunitasController::class, 'store']);
    Route::get('/komunitas/categories', [KomunitasController::class, 'getCategories']);
    Route::get('/komunitas/{komunitas}', [KomunitasController::class, 'show']);
    Route::post('/komunitas/{komunitas}/like', [KomunitasController::class, 'toggleLike']);
    Route::post('/komunitas/{komunitas}/komentar', [KomunitasController::class, 'komentarStore']);
    Route::delete('/komentar/{komentar}', [KomunitasController::class, 'destroyKomentar']);

    // Konsultasi
    Route::get('/konsultasi/pakar', [KonsultasiController::class,'create']);
    Route::get('/konsultasi', [KonsultasiController::class, 'index']);
    Route::get('/konsultasi/{konsultasi}', [KonsultasiController::class, 'show']);
    Route::post('/konsultasi', [KonsultasiController::class, 'store']);
    Route::post('/konsultasi/{konsultasi}/pesan', [PesanController::class, 'store']);
    Route::put('/pesan/{pesan}/status/{status}', [PesanController::class, 'updateStatus']);
    Route::get('/konsultasi/{konsultasi}/messages-status', [KonsultasiController::class, 'getMessagesStatus']);
    Route::delete('/konsultasi/{konsultasi}', [KonsultasiController::class, 'destroy']);

    // Guide Book
    Route::get('/guide-books', [GuideBookController::class, 'index']);
    Route::get('/guide-books/{guideBook}', [GuideBookController::class, 'show']);
    Route::post('/request-role-change', [RoleChangeRequestController::class, 'requestRoleChange']);

});

Route::middleware(['auth:sanctum', 'pakar'])->group(function () {
    Route::post('/guide-books', [GuideBookController::class, 'store']);
    Route::put('/guide-books/{guideBook}', [GuideBookController::class, 'update']);
    Route::delete('/guide-books/{guideBook}', [GuideBookController::class, 'destroy']);
});



Route::post('/admin/login', [AdminController::class, 'login']);
Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    Route::prefix('admin')->group(function () {
        // Route untuk articles
        Route::get('/articles', [AdminController::class, 'indexArticles']);
        Route::get('/articles/{komunitas}', [AdminController::class, 'showArticle']);
        Route::delete('/articles/{komunitas}', [AdminController::class, 'deleteArticle']);
        Route::delete('/articles/{komunitas}/komentar/{komentar}', [AdminController::class, 'deleteKomentar']);
        
        // Route untuk categories
        Route::get('/categories', [AdminController::class, 'index']);
        Route::post('/categories', [AdminController::class, 'createCategory']);
        Route::delete('/categories/{id}', [AdminController::class, 'deleteCategory']);
        
        // Route untuk guide books
        Route::get('/guide-books', [AdminController::class, 'indexGuideBooks']);
        Route::get('/guide-books/{guideBook}', [AdminController::class, 'showGuideBook']);
        Route::post('/guide-books', [AdminController::class, 'storeGuideBook']);
        Route::put('/guide-books/{guideBook}', [AdminController::class, 'updateGuideBook']);
        Route::delete('/guide-books/{guideBook}', [AdminController::class, 'destroyGuideBook']);
    });
});

