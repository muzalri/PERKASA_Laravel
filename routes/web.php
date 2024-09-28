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

//USER
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/profile', [AuthController::class, 'showProfile'])->middleware('auth')->name('profile');
Route::get('/profile/edit', [AuthController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::post('/profile/edit', [AuthController::class, 'update'])->middleware('auth')->name('profile.update');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/komunitas', [KomunitasController::class, 'index'])->middleware('auth')->name('komunitas');
Route::get('/marketplace', [MarketplaceController::class, 'index'])->middleware('auth')->name('marketplace');
Route::get('/konsul', [KonsulController::class, 'index'])->middleware('auth')->name('konsul');

