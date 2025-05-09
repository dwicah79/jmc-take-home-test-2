<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomingGoodsController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Authenticated area
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('incoming-goods')->group(function () {
        Route::get('/', [IncomingGoodsController::class, 'index'])->name('incoming-goods.index');
        Route::post('/store', [IncomingGoodsController::class, 'store'])->name('incoming-goods.store');
        Route::get('/{id}/edit', [IncomingGoodsController::class, 'edit'])->name('incoming-goods.edit');
        Route::put('/{id}', [IncomingGoodsController::class, 'update'])->name('incoming-goods.update');
        Route::delete('/{id}', [IncomingGoodsController::class, 'destroy'])->name('incoming-goods.destroy');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });
});
