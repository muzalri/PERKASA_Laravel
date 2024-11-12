<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KomunitasController;
use App\Http\Controllers\Api\KonsultasiController;
use App\Http\Controllers\Api\GuideBookController;

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

    // Guide Book
    Route::get('/guide-books', [GuideBookController::class, 'index']);
    Route::post('/guide-books', [GuideBookController::class, 'store']);
    Route::get('/guide-books/{guideBook}', [GuideBookController::class, 'show']);
    Route::put('/guide-books/{guideBook}', [GuideBookController::class, 'update']);
    Route::delete('/guide-books/{guideBook}', [GuideBookController::class, 'destroy']);
});