<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\ServiceController;
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



Route::get('/', function () {
    return view('welcome');
});
