<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePagesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SanphamController;
use App\Http\Controllers\QLsanphamComtroller;
use App\Http\Controllers\AdminController;
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

Route::get('/', [HomePagesController::class, 'home']) -> name('home');
Route::get('/blog', [BlogController::class, 'blog']) -> name('blog');
Route::get('/contact', [ContactController::class, 'contact']) -> name('contact');
Route::get('/cart', [CartController::class, 'cart']) -> name('cart');
Route::get('/shop', [ShopController::class, 'shop']) -> name('shop');
Route::get('/aboutus', [AboutusController::class, 'aboutus']) -> name('aboutus');
Route::get('/offer', [AboutusController::class, 'offer']) -> name('offer');
Route::get('/service', [AboutusController::class, 'service']) -> name('service');
Route::get('/login', [HomePagesController::class, 'loginPage']);
Route::get('/register', [HomePagesController::class, 'registerPage']);
Route::get('/verify', [HomePagesController::class, 'verifyPage']);

Route::get('/danhmuc/{danhmuc}', [HomePagesController::class, 'locSPtheoDanhmuc']);
Route::get('/sanpham/{tensp}/{sp}', [SanphamController::class, 'chitietsanpham']);

Route::get('/admin', [AdminController::class, 'admin'])->name('admin');

Route::get('/sanpham/{tensp}/{sp}', [SanphamController::class, 'chitietsanpham']);

//admin 
Route::get('/sanpham/{tensp}/{sp}', [SanphamController::class, 'chitietsanpham']);

// New route for danhmuc category
Route::get('/danhmuc/{slug}', [CategoryController::class, 'show'])->name('danhmuc');






//admin
Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
Route::get('/administrator/quanlysanpham/{id_sp}', [QLsanphamComtroller::class, 'pagesQLchitietsanpham']);

Route::get('/administrator/quanlysanpham', [QLsanphamComtroller::class, 'pagesQLsanpham']);
Route::get('/administrator/themsanpham', [QLsanphamComtroller::class, 'pagesthemsanpham']);
Route::post('/administrator/themspmoi', [QLsanphamComtroller::class, 'postthemsanpham']);
