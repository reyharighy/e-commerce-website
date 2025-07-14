<?php

use App\Http\Controllers\CartController;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

Route::get('catalog', function () {
    $products = Product::with(['category', 'productVariants.productImages'])
        ->whereHas('productVariants', function ($query) {
            $query->where('stock', '>', 0);
        })
        ->orderBy('rating', 'desc')
        ->orderBy('review', 'desc')
        ->get();
    
        $flashSale = Product::with(['category', 'productVariants.productImages'])
            ->whereHas('productVariants', function ($query) {
                $query->where('stock', '>', 0);
            })
            ->orderBy('discount_percentage', 'desc')
            ->limit(3)
            ->get();
        
        $bestSellers = Product::with(['category', 'productVariants.productImages'])
            ->whereHas('productVariants', function ($query) {
                $query->where('stock', '>', 0);
            })
            ->orderBy('review', 'desc')
            ->limit(3)
            ->get();
        
        $topRated = Product::with(['category', 'productVariants.productImages'])
            ->whereHas('productVariants', function ($query) {
                $query->where('stock', '>', 0);
            })
            ->orderBy('rating', 'desc')
            ->limit(3)
            ->get();
        
        $newArrival = Product::with(['category', 'productVariants.productImages'])
            ->whereHas('productVariants', function ($query) {
                $query->where('stock', '>', 0);
            })
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

    return Inertia::render('customer/Catalog', [
        'products' => $products,
        'flashSale' => $flashSale,
        'bestSellers' => $bestSellers,
        'topRated' => $topRated,
        'newArrival' => $newArrival,
    ]);
})->middleware(['auth'])->name('catalog');

Route::get('product-details/{product}', function (Product $product) {
    $images = Storage::disk('public')->files($product->category->name);

    return Inertia::render('customer/ProductDetails', [
        'product' => $product,
        'images' => $images,
        'sizeAvailability' => ProductVariant::$sizeAvailability,
        'colorAvailability' => ProductVariant::$colorAvailability,
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
    return Inertia::render('customer/SearchResults', [
        'product' => Product::all(),
    ]);
})->middleware(['auth'])->name('search-results');

Route::get('order-details', function () {
    return Inertia::render('customer/OrderDetails');
})->middleware(['auth'])->name('order-details');

Route::get('wishlist', function () {
    return Inertia::render('customer/Wishlist');
})->middleware(['auth'])->name('wishlist');

Route::resource('carts', CartController::class);
