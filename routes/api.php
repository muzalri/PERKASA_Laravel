<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
// use App\Http\Controllers\Api\ChatController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::delete('/profile', [AuthController::class, 'deleteProfile']);

    // Chat
    // Route::post('/chat/send', [ChatController::class, 'sendMessage']);
    // Route::get('/chat/messages', [ChatController::class, 'getMessages']);
    // Route::delete('/chat/messages/{id}', [ChatController::class, 'deleteMessage']);
});