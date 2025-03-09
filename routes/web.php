<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePagesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\OfferController;


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
Route::get('/danhmuc/{danhmuc}', [HomePagesController::class, 'locSPtheoDanhmuc']);