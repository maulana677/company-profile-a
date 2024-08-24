<?php

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\CompanyAboutController;
use App\Http\Controllers\Admin\CompanyStatisticController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FooterInfoController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\OurPrincipleController;
use App\Http\Controllers\Admin\OurTeamController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProjectClientController;
use App\Http\Controllers\Admin\TestimonialController;
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
        Route::resource('principles', OurPrincipleController::class);
    });

    Route::middleware('can:manage testimonials')->group(function () {
        Route::resource('testimonials', TestimonialController::class);
    });

    Route::middleware('can:manage clients')->group(function () {
        Route::resource('clients', ProjectClientController::class);
    });

    Route::middleware('can:manage teams')->group(function () {
        Route::resource('teams', OurTeamController::class);
    });

    Route::middleware('can:manage abouts')->group(function () {
        Route::resource('abouts', CompanyAboutController::class);
    });

    Route::middleware('can:manage appointments')->group(function () {
        Route::resource('appointments', AppointmentController::class);
    });

    Route::middleware('can:manage hero sections')->group(function () {
        Route::resource('hero-sections', HeroSectionController::class);
    });

    Route::middleware('can:manage footer sections')->group(function () {
        Route::resource('footer-sections', FooterInfoController::class);
    });
});
