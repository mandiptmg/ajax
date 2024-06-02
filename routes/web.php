<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionCategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/login', function () {
    return view('login.index');
});

Auth::routes();



Route::group(['middleware' => ['role:super-admin|admin']], function () {
    // Protected routes go here
    Route::get('/admin/dashboard', function () {
        return view('index');
    });


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

    Route::prefix('admin')->group(function () {
        Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
        Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
        Route::put('permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::delete('permissions/delete/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    });

    Route::prefix('admin')->group(function () {
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    });

    Route::prefix('admin')->group(function () {
        Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
        Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
        Route::get('roles/{id}', [RoleController::class, 'show'])->name('roles.show');
        Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::patch('roles/{id}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('roles/delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    });


    Route::prefix('admin')->group(function () {
        Route::get('permission-categorys', [PermissionCategoryController::class, 'index'])->name('permission-categorys.index');
        Route::post('permission-categorys', [PermissionCategoryController::class, 'store'])->name('permission-categorys.store');
        Route::put('permission-categorys/{id}', [PermissionCategoryController::class, 'update']);
        Route::delete('permission-categorys/delete/{id}', [PermissionCategoryController::class, 'destroy']);
    });
});
