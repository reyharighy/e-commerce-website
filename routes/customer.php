<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('catalog', function () {
    $products = Product::with(['category', 'productVariants.productImages'])
        ->whereHas('productVariants', function ($query) {
            $query->where('stock', '>', 0);
        })
        ->orderBy('rating', 'desc')
        ->orderBy('review', 'desc')
        ->get();

    return Inertia::render('customer/Catalog', [
        'products' => $products,
    ]);
})->middleware(['auth'])->name('catalog');

Route::get('product-details/{product}', function (Product $product) {
    return Inertia::render('customer/ProductDetails', [
        'product' => $product->load(['category', 'productVariants.productImages'])
    ]);
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
