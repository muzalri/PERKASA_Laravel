<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KomunitasController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\KonsulController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/komunitas', [KomunitasController::class, 'index'])->name('komunitas');

Route::get('/marketplace', [MarketplaceController::class, 'index'])->name('marketplace');

Route::get('/konsul', [KonsulController::class, 'index'])->name('konsul');

