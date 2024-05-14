<?php

use App\Http\Controllers\HeroController;
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
Route::post('/admin/store', [HeroController::class, 'store'])->name('hero.store');
// Route::get('/admin/hero/{id}', [HeroController::class, 'edit'])->name('hero.edit');
// Route::put('/admin/hero/{id}', [HeroController::class, 'update'])->name('hero.update');
Route::get('/', function () {
    return view('welcome');
});
