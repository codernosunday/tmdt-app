<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePagesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SanphamController;
use App\Http\Controllers\QLsanphamController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\nguoidungCotroller;
use App\Http\Controllers\pvcvakhuyenmaiController;
use App\Http\Controllers\QLDMController;

use App\Http\Controllers\ThanhtoanController;
use App\Http\Controllers\QLnguoidungController;


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
Route::get('/cart', [CartController::class, 'cart']);


Route::get('/login', [AuthController::class, 'loginPage']);
Route::get('/register', [AuthController::class, 'registerPage']);
Route::get('/verify', [AuthController::class, 'verifyPage']);
Route::get('/password', [AuthController::class, 'passwordPage']);

Route::get('/forgot', [AuthController::class, 'forgotPage']);
Route::get('/forgotPasswordChange', [AuthController::class, 'forgotPasswordChangePage']);
Route::get('/forgotPasswordVerify', [AuthController::class, 'forgotPasswordVerifyPage']);

Route::post('/verify', [AuthController::class, 'verify']);
Route::post('/password', [AuthController::class, 'password']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/forgot', [AuthController::class, 'forgot']);
Route::post('/forgotPasswordChange', [AuthController::class, 'forgotPasswordChange']);
Route::post('/forgotPasswordVerify', [AuthController::class, 'forgotPasswordVerify']);
//gio hang - Vo Thanh Tin
Route::post('/addToCart', [CartController::class, 'addToCart'])->name('addToCart');
Route::post('/themvaogio', [CartController::class, 'themgiohang']);
//dat hang - vo thanh tin
Route::get('/trangthanhtoan/{ctgh}', [ThanhtoanController::class, 'trangthanhtoan']);
Route::get('/theodoidonhang', [ThanhtoanController::class, 'theodoidonhang']);
Route::post('/donhang/dathang', [ThanhtoanController::class, 'thanhtoansanpham']);
//theo doi don hang
Route::get('/theodoidonhang/{mahd}', [ThanhtoanController::class, 'kiemtradonhang']);
//giam gia
Route::post('/dathang/magiamgia', [ThanhtoanController::class, 'sdMagiamgia']);
//
Route::get('/danhmuc/{danhmuc}', [HomePagesController::class, 'locSPtheoDanhmuc']);
Route::get('/sanpham/{tensp}/{sp}', [SanphamController::class, 'chitietsanpham']);

Route::get('/admin', [AdminController::class, 'admin'])->name('admin');

Route::get('/sanpham/{tensp}/{sp}', [SanphamController::class, 'chitietsanpham']);
//admin - Vo Thanh Tin
Route::get('/sanpham/{tensp}/{sp}', [SanphamController::class, 'chitietsanpham']);
Route::get('/xemsanpham/{ctsp}', [SanphamController::class, 'xemctsp']);

//Nguoi dung- Vo Thanh Tin
Route::get('/nguoidung', [nguoidungCotroller::class, 'trangnguoidung']);
Route::post('/nguoidung/capnhat', [nguoidungCotroller::class, 'capnhatthongtin']);

//shop - Vo Thanh Tin
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/loc/{danhmuc}', [ShopController::class, 'locSP']);
//shop-locsanpham ------- Vo Thanh Tin
Route::post('/shop/locnangcao', [ShopController::class, 'locnangcao']);

// dat hang - theo doi don hang



Route::middleware(['admin.access'])->group(function () {
    //admin- Vo Thanh Tin - san pham va chi tiet san pham
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
    Route::get('/administrator/quanlysanpham/{id_sp}', [QLsanphamController::class, 'pagesQLchitietsanpham']);
    Route::get('/administrator/quanlysanpham', [QLsanphamController::class, 'pagesQLsanpham']);
    Route::get('/administrator/themsanpham', [QLsanphamController::class, 'pagesthemsanpham']);
    Route::post('/administrator/themspmoi', [QLsanphamController::class, 'postthemsanpham']);
    Route::post('/administrator/capnhatsp', [QLsanphamController::class, 'postcapnhatsanpham']);
    Route::get('/administrator/quanlysanpham', [QLsanphamController::class, 'pagesQLsanpham']);
    Route::delete('/administrator/xoasp/{id}', [QLsanphamController::class, 'deleteSP']);

    // chitiet san pham
    Route::get('/administrator/themchitietmoi/{id}', [QLsanphamController::class, 'chiTietSanPham']);
    Route::post('/administrator/postthemchitietmoi', [QLsanphamController::class, 'PostThemchiTietSanPham']);

    //admin-Quan ly nguoi dung-HHH
    Route::get('/administrator/quanlynguoidung', [QLnguoidungController::class, 'pagesQLnguoidung']);
    Route::post('/administrator/xoanguoidung', [QLnguoidungController::class, 'xoaNguoiDung']);
    Route::post('/administrator/suaNguoiDung', [QLnguoidungController::class, 'suaNguoidung']);

    //admin danh muc san pham - Vo Thanh Tin
    Route::get('/administrator/quanlydanhmuccha', [QLDMController::class, 'danhmuccha']);
    Route::get('/administrator/quanlydanhmucccon', [QLDMController::class, 'danhmuccon']);
    //danh muc cha- Vo Thanh Tin
    Route::post('/administrator/postthemdmcha', [QLDMController::class, 'postthemDMcha']);
    Route::delete('/administrator/deletedmcha/{id}', [QLDMController::class, 'deleteDMcha']);
    Route::post('/administrator/updatedmcha', [QLDMController::class, 'postSuaDMcha']);
    //danh muc con- Vo Thanh Tin
    Route::get('/administrator/chinhsuadmcon/{id}', [QLDMController::class, 'trangsuaDMcon']);
    Route::post('/administrator/postthemdmcon', [QLDMController::class, 'postAddDMcon']);
    Route::delete('/administrator/deletedmcon/{id}', [QLDMController::class, 'postDeleteDMcon']);
    Route::post('/administrator/updatedmcon', [QLDMController::class, 'postUpdateDMcon']);
    //Quan ly phan loai va mau sac - Vo Thanh Tin
    Route::get('/administrator/phanloaivamausac', [QLDMController::class, 'trangPhanloai']);
    Route::post('/administrator/themphanloaivamausac', [QLDMController::class, 'postThemPhanloai']);
    //QL phi van chuyen
    Route::get('/administrator/phivanchuyen', [pvcvakhuyenmaiController::class, 'qlphivanchuyen']);
    Route::get('/administrator/xempvc/{id}', [pvcvakhuyenmaiController::class, 'timvanchuyen']);
    Route::post('/administrator/themphivanchuyen', [pvcvakhuyenmaiController::class, 'themphivanchuyen']);
    Route::post('/administrator/chinhsuavanchuyen/{id}', [pvcvakhuyenmaiController::class, 'capnhatphivanchuyen']);
    Route::delete('/administrator/xoaphivanchuyen/{id}', [pvcvakhuyenmaiController::class, 'xoaphivanchuyen']);
    //QL giá sale
    Route::get('/administrator/qlgiasale', [pvcvakhuyenmaiController::class, 'trangsale']);
    Route::post('/administrator/themgiasale', [pvcvakhuyenmaiController::class, 'themgiasale']);
    Route::get('/administrator/xemgiasale/{id}', [pvcvakhuyenmaiController::class, 'xemgiasale']);
    Route::post('/administrator/capnhatgiasale/{id}', [pvcvakhuyenmaiController::class, 'capnhatgiasale']);
    Route::delete('/administrator/xoagiasale/{id}', [pvcvakhuyenmaiController::class, 'xoagiasale']);
});
