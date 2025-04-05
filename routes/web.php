<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePagesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SanphamController;
use App\Http\Controllers\QLsanphamController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home and Basic Pages
Route::get('/', [HomePagesController::class, 'home'])->name('home');
Route::get('/aboutus', [HomePagesController::class, 'aboutUs'])->name('aboutus');
Route::get('/service', [HomePagesController::class, 'service'])->name('service');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');

// Shop and Product Routes
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/sanpham/{tensp}/{id_sp}', [SanphamController::class, 'chitietsanpham'])->name('sanpham.show');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/sanpham/{tensp}/{id_sp}', [SanphamController::class, 'chitietsanpham'])
    ->name('sanpham.show');

// Category Routes
Route::get('/categories/{id_ctdm}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/danhmuc/{slug}', [CategoryController::class, 'show'])->name('danhmuc');

// Blog Routes
Route::get('/blog', [BlogController::class, 'blog'])->name('blog');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'auth'], function () {
    // Login Routes
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Register Routes
    Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Verification Routes
    Route::get('/verify', [AuthController::class, 'verifyPage'])->name('verify');
    Route::post('/verify', [AuthController::class, 'verify']);

    // Password Routes
    Route::get('/password', [AuthController::class, 'passwordPage'])->name('password');
    Route::post('/password', [AuthController::class, 'password']);
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'administrator', 'middleware' => ['auth']], function () {
    Route::get('/', [AdminController::class, 'admin'])->name('admin');
    
    // Product Management Routes
    Route::group(['prefix' => 'quanlysanpham'], function () {
        Route::get('/', [QLsanphamController::class, 'pagesQLsanpham'])->name('admin.products.index');
        Route::get('/{id_sp}', [QLsanphamController::class, 'pagesQLchitietsanpham'])->name('admin.products.show');
        Route::get('/them', [QLsanphamController::class, 'pagesthemsanpham'])->name('admin.products.create');
        Route::post('/them', [QLsanphamController::class, 'postthemsanpham'])->name('admin.products.store');
        Route::post('/capnhat', [QLsanphamController::class, 'postcapnhatsanpham'])->name('admin.products.update');
    });
});