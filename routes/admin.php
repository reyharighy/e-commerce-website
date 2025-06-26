<?php

use App\Http\Middleware\EnsureUserisAdmin;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('dashboard', function () {
    return Inertia::render('admin/Dashboard');
})->middleware(['auth', 'verified', EnsureUserisAdmin::class])->name('dashboard');
