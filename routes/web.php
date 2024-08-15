<?php

use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\CompanyStatisticController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\frontend\FrontController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('front.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('artikel', ArtikelController::class);

    Route::middleware('can:manage statistics')->group(function () {
        Route::resource('statistics', CompanyStatisticController::class);
    });

    Route::middleware('can:manage products')->group(function () {
        Route::resource('products', ProductController::class);
    });

    Route::middleware('can:manage principles')->group(function () {
        Route::resource('principles', ProductController::class);
    });

    Route::middleware('can:manage testimonials')->group(function () {
        Route::resource('testimonials', ProductController::class);
    });

    Route::middleware('can:manage clients')->group(function () {
        Route::resource('clients', ProductController::class);
    });

    Route::middleware('can:manage teams')->group(function () {
        Route::resource('teams', ProductController::class);
    });

    Route::middleware('can:manage abouts')->group(function () {
        Route::resource('abouts', ProductController::class);
    });

    Route::middleware('can:manage appointments')->group(function () {
        Route::resource('appointments', ProductController::class);
    });

    Route::middleware('can:manage hero sections')->group(function () {
        Route::resource('hero-sections', ProductController::class);
    });

    Route::middleware('can:manage footer sections')->group(function () {
        Route::resource('footer-sections', ProductController::class);
    });
});
