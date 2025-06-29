<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('catalog', function () {
    return Inertia::render('customer/Catalog');
})->middleware(['auth'])->name('catalog');

Route::get('product-details', function () {
    return Inertia::render('customer/ProductDetails');
})->middleware(['auth'])->name('product-details');

Route::get('checkout', function () {
    return Inertia::render('customer/Checkout');
})->middleware(['auth'])->name('checkout');