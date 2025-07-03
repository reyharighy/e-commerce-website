<?php

use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductVariantController;
use App\Http\Middleware\EnsureUserisAdmin;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('dashboard', function () {
    return Inertia::render('admin/Dashboard');
})->middleware(['auth', 'verified', EnsureUserisAdmin::class])->name('dashboard');

Route::resource('categories', CategoryController::class)->except(['show', 'edit']);
Route::resource('products', ProductController::class)->except(['show']);
Route::resource('products.variants', ProductVariantController::class)->except(['show']);

// Testing
Route::get('backup', function () {
    return Inertia::render('admin/backup');
})->middleware(['auth', 'verified', EnsureUserisAdmin::class]);
