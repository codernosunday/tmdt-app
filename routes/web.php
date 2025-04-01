<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomePagesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SanphamController;
use App\Http\Controllers\QLsanphamController;
use App\Http\Controllers\QLsanphamComtroller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;



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

Route::get('/', [HomePagesController::class, 'home'])->name('home');
Route::get('/blog', [BlogController::class, 'blog'])->name('blog');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');


Route::get('/login', [AuthController::class, 'loginPage']);
Route::get('/register', [AuthController::class, 'registerPage']);
Route::get('/verify', [AuthController::class, 'verifyPage']);
Route::get('/password', [AuthController::class, 'passwordPage']);

// Route::get('/login', [AuthController::class, 'loginPage']);
Route::post('/register', [AuthController::class, 'register']);

// Route::get('/verify', [AuthController::class, 'verifyPage']);
Route::get('/password', [AuthController::class, 'passwordPage']);

// Route::get('/login', [AuthController::class, 'loginPage']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/verify', [AuthController::class, 'verify']);
Route::post('/password', [AuthController::class, 'password']);
Route::post('/login', [AuthController::class, 'login']);

//Phuc: change the category route
Route::get('/danhmuc/{slug}', [HomePagesController::class, 'locSPtheoDanhmuc'])->name('danhmuc');
Route::get('/sanpham/{tensp}/{sp}', [SanphamController::class, 'chitietsanpham']);
Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
Route::get('/sanpham/{tensp}/{sp}', [SanphamController::class, 'chitietsanpham']);
Route::get('/sanpham/{tensp}/{sp}', [SanphamController::class, 'chitietsanpham']);

// New route for danhmuc category
Route::get('/danhmuc/{slug}', [CategoryController::class, 'show'])->name('danhmuc');


// Route - Phuc
Route::get('/aboutus', [HomePagesController::class, 'aboutUs'])->name('aboutus');
Route::get('/service', [HomePagesController::class, 'service'])->name('service');
Route::get('/contact', [HomePagesController::class, 'contact'])->name('contact');
Route::get('/categories/{id_ctdm}', [CategoryController::class, 'show'])->name('categories.show');

//admin- Vo Thanh Tin
Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
Route::get('/administrator/quanlysanpham/{id_sp}', [QLsanphamController::class, 'pagesQLchitietsanpham']);
Route::get('/administrator/quanlysanpham', [QLsanphamController::class, 'pagesQLsanpham']);
Route::get('/administrator/themsanpham', [QLsanphamController::class, 'pagesthemsanpham']);
Route::post('/administrator/themspmoi', [QLsanphamController::class, 'postthemsanpham']);
Route::post('/administrator/capnhatsp', [QLsanphamController::class, 'postcapnhatsanpham']);
Route::get('/administrator/quanlysanpham', [QLsanphamController::class, 'pagesQLsanpham']);
//shop - Vo Thanh Tin
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/loc/{danhmuc}', [ShopController::class, 'locSP']);
//shop-locsanpham-------
