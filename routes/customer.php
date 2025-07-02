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

Route::get('checkout-success', function () {
    return Inertia::render('customer/CheckoutSuccess');
})->middleware(['auth'])->name('checkout-success');

Route::get('product-filter', function () {
    return Inertia::render('customer/ProductFilter');
})->middleware(['auth'])->name('product-filter');

Route::get('search-results', function () {
    return Inertia::render('customer/SearchResults');
})->middleware(['auth'])->name('search-results');

Route::get('order-details', function () {
    return Inertia::render('customer/OrderDetails');
})->middleware(['auth'])->name('order-details');

Route::get('wishlist', function () {
    return Inertia::render('customer/Wishlist');
})->middleware(['auth'])->name('wishlist');

Route::get('cart', function () {
    return Inertia::render('customer/Cart');
})->middleware(['auth'])->name('cart');
