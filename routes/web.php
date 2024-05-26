<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BenefitController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;


Route::get('/admin/hero', [HeroController::class, 'index'])->name('hero.index');
Route::post('/admin/hero', [HeroController::class, 'store'])->name('hero.store');

Route::get('/admin/about', [AboutController::class, 'index'])->name('about.index');
Route::post('/admin/about', [AboutController::class, 'store'])->name('about.store');

Route::get('/admin/services', [ServiceController::class, 'index'])->name('service.index');
Route::post('/admin/services', [ServiceController::class, 'store'])->name('service.store');
Route::put('/admin/services/{id}', [ServiceController::class, 'update'])->name('service.update');
Route::delete('/admin/services/delete/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');

Route::get('/admin/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::post('/admin/portfolios', [PortfolioController::class, 'store'])->name('portfolio.store');
Route::put('/admin/portfolios/{id}', [PortfolioController::class, 'update'])->name('portfolio.update');
Route::delete('/admin/portfolios/delete/{id}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');

Route::get('/admin/testimonial', [TestimonialController::class, 'index'])->name('testimonial.index');
Route::post('/admin/testimonial', [TestimonialController::class, 'store'])->name('testimonial.store');
Route::put('/admin/testimonials/{id}', [TestimonialController::class, 'update'])->name('testimonial.update');
Route::delete('/admin/testimonials/delete/{id}', [TestimonialController::class, 'destroy'])->name('testimonial.destroy');





// Product Routes
Route::prefix('admin')->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});

Route::get('/admin', function () {
    return view('index');
});
