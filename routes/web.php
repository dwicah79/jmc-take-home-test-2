<?php

use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubCategoryController;
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
        Route::get('/create', [IncomingGoodsController::class, 'create'])->name('incoming-goods.create');
        Route::post('/store', [IncomingGoodsController::class, 'store'])->name('incoming-goods.store');
        Route::get('/{id}/edit', [IncomingGoodsController::class, 'edit'])->name('incoming-goods.edit');
        Route::put('/{id}', [IncomingGoodsController::class, 'update'])->name('incoming-goods.update');
        Route::delete('/{id}', [IncomingGoodsController::class, 'destroy'])->name('incoming-goods.destroy');
        Route::put('/{id}/verified', [IncomingGoodsController::class, 'verified'])->name('incoming-goods.verified');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    Route::prefix('subcategories')->group(function () {
        Route::get('/', [SubCategoryController::class, 'index'])->name('subcategories.index');
        Route::post('/store', [SubCategoryController::class, 'store'])->name('subcategories.store');
        Route::get('/{id}/edit', [SubCategoryController::class, 'edit'])->name('subcategories.edit');
        Route::put('/{subcategory}', [SubCategoryController::class, 'update'])->name('subcategories.update');
        Route::delete('/{subcategory}', [SubCategoryController::class, 'destroy'])->name('subcategories.destroy');
    });
});

Route::middleware('auth', 'checkpermission')->group(function () {
    Route::prefix('user-management')->group(function () {
        Route::get('/', [UserManagementController::class, 'index'])->name('users.index');
        Route::post('/store', [UserManagementController::class, 'store'])->name('users.store');
        Route::get('/{id}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserManagementController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');
        Route::put('/{id}/lock', [UserManagementController::class, 'lock'])->name('users.lock');
        Route::put('/{id}/unlock', [UserManagementController::class, 'unlock'])->name('users.unlock');
    });
});

Route::get('/get-subcategories', [IncomingGoodsController::class, 'getSubcategories'])->name('getSubcategories');
Route::get('/incoming-goods/export', [IncomingGoodsController::class, 'export'])->name('incoming-goods.export');
