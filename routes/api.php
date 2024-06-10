<?php

use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\api\HeaderController;
use App\Http\Controllers\Api\HeroController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\api\portfoliotitleController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\api\producttitleController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\api\servicetitleController;
use App\Http\Controllers\api\sitesettingController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\api\testimonialtitleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/hero', [HeroController::class, 'index']);
Route::get('/headers', [HeaderController::class, 'index']);
Route::get('/sitesetting', [sitesettingController::class, 'index']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/portfolio', [PortfolioController::class, 'index']);
Route::get('/testimonial', [TestimonialController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{slug}', [ProductController::class, 'show']);

Route::get('/servicetitle', [servicetitleController::class, 'index']);
Route::get('/portfoliotitle', [portfoliotitleController::class, 'index']);
Route::get('/testimonialtitle', [testimonialtitleController::class, 'index']);
Route::get('/producttitle', [producttitleController::class, 'index']);







