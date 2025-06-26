<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('catalog', function () {
    return Inertia::render('customer/Catalog');
})->middleware(['auth'])->name('catalog');
