<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/admin/hero', [HeroController::class, 'index'])->name('hero.index');
Route::post('/admin/hero', [HeroController::class, 'store'])->name('hero.store');

Route::get('/admin/about', [AboutController::class, 'index'])->name('about.index');
Route::post('/admin/about', [AboutController::class, 'store'])->name('about.store');

Route::get('/admin/services', [ServiceController::class, 'index'])->name('service.index');
Route::post('/admin/services', [ServiceController::class, 'store'])->name('service.store');
Route::put('/admin/services/{id}', [ServiceController::class, 'update'])->name('service.update');
Route::delete('/admin/services/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');

Route::get('/admin/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::post('/admin/portfolios', [PortfolioController::class, 'store'])->name('portfolio.store');
Route::put('/admin/portfolios/{id}', [PortfolioController::class, 'update'])->name('portfolio.update');
Route::delete('/admin/portfolios/{id}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');

Route::get('/admin/testimonial', [TestimonialController::class, 'index'])->name('testimonial.index');
Route::post('/admin/testimonial', [TestimonialController::class, 'store'])->name('testimonial.store');
Route::put('/admin/testimonials/{id}', [TestimonialController::class, 'update'])->name('testimonial.update');
Route::delete('/admin/testimonials/{id}', [TestimonialController::class, 'destroy'])->name('testimonial.destroy');


Route::get('/', function () {
    return view('welcome');
});
