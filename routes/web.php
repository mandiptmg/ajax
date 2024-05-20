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


Route::get('/admin/products', [ProductController::class, 'index'])->name('product.index');
Route::post('/admin/products', [ProductController::class, 'store'])->name('product.store');
Route::put('/admin/products/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

Route::prefix('admin/products/{productId}')->group(function () {
    Route::get('features', [ProductController::class, 'index'])->name('features.index');
    Route::post('features', [FeatureController::class, 'store'])->name('features.store');
    Route::put('features/{featureId}', [FeatureController::class, 'update'])->name('features.update');
    Route::delete('features/{featureId}', [FeatureController::class, 'destroy'])->name('features.destroy');

    // Route::get('/question_answers', [ProductController::class, 'index'])->name('question_answers.index');
    // Route::post('question_answers', [QuestionController::class, 'store'])->name('question_answers.store');
    // Route::put('question_answers/{qaId}', [QuestionController::class, 'update'])->name('question_answers.update');
    // Route::delete('question_answers/{qaId}', [QuestionController::class, 'destroy'])->name('question_answers.destroy');

    // Route::get('/benefits', [ProductController::class, 'index'])->name('benefits.index');
    // Route::post('benefits', [BenefitController::class, 'store'])->name('benefits.store');
    // Route::put('benefits/{benefitId}', [BenefitController::class, 'update'])->name('benefits.update');
    // Route::delete('benefits/{benefitId}', [BenefitController::class, 'destroy'])->name('benefits.destroy');

    // Route::get('/images', [ProductController::class, 'index'])->name('question_answers.index');
    // Route::post('images', [BenefitController::class, 'store'])->name('images.store');
    // Route::put('images/{imageId}', [BenefitController::class, 'update'])->name('images.update');
    // Route::delete('images/{imageId}', [BenefitController::class, 'destroy'])->name('images.destroy');
});




Route::get('/', function () {
    return view('welcome');
});