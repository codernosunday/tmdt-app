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
use App\Http\Controllers\danhgiaController;
use App\Http\Controllers\nguoidungCotroller;
use App\Http\Controllers\nhacungcapController;
use App\Http\Controllers\pvcvakhuyenmaiController;
use App\Http\Controllers\QLDMController;

use App\Http\Controllers\ThanhtoanController;
use App\Http\Controllers\QLnguoidungController;
use App\Http\Controllers\QLdonhangController;
use App\Http\Controllers\QLchitietdonhangController;
use App\Http\Controllers\thongkeController;

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

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');;
Route::get('/logout', [AuthController::class, 'logout']);
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
//tim kiếm
Route::get('/search', [SanphamController::class, 'timkiemsanpham']);
//
//gio hang - Vo Thanh Tin
Route::post('/addToCart', [CartController::class, 'addToCart'])->name('addToCart');
Route::post('/themvaogio', [CartController::class, 'themgiohang']);
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

//shop - Vo Thanh Tin
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/loc/{danhmuc}', [ShopController::class, 'locSP']);
//shop-locsanpham-------

Route::get('/contact', [ContactController::class, 'contact'])->name('contact');


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

Route::get('/danhmuc/{danhmuc}', [HomePagesController::class, 'locSPtheoDanhmuc']);
Route::get('/sanpham/{tensp}/{sp}', [SanphamController::class, 'chitietsanpham']);
// gio hang
route::delete('/xoagiohang/{id}', [CartController::class, 'xoagiohang']);
//
Route::get('/admin', [AdminController::class, 'admin'])->name('admin');

// Route::get('/sanpham/{tensp}/{sp}', [SanphamController::class, 'chitietsanpham']);

Route::get('/sanpham/{tensp}/{sp}', [SanphamController::class, 'chitietsanpham']);
Route::get('/xemsanpham/{ctsp}', [SanphamController::class, 'xemctsp']);

//Nguoi dung- Vo Thanh Tin
Route::get('/nguoidung', [nguoidungCotroller::class, 'trangnguoidung']);
Route::post('/nguoidung/capnhat', [nguoidungCotroller::class, 'capnhatthongtin']);
Route::get('/categories/{id_ctdm}', [CategoryController::class, 'show'])->name('categories.show');


//shop - Vo Thanh Tin
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/loc/{danhmuc}', [ShopController::class, 'locSP']);
//shop-locsanpham ------- Vo Thanh Tin
Route::post('/shop/locnangcao', [ShopController::class, 'locnangcao']);

// dat hang - theo doi don hang
Route::get('/trangthanhtoan/{ctgh}/{sl?}', [ThanhtoanController::class, 'trangthanhtoan']);
Route::get('/theodoidonhang', [ThanhtoanController::class, 'theodoidonhang']);
Route::post('/donhang/dathang', [ThanhtoanController::class, 'thanhtoansanpham']);
//theo doi don hang
Route::get('/theodoidonhang/{mahd}', [ThanhtoanController::class, 'kiemtradonhang']);
//giam gia
Route::post('/dathang/magiamgia', [ThanhtoanController::class, 'sdMagiamgia']);
// Route for danhgia
Route::post('/danhgiasanpham/{id}', [danhgiaController::class, 'danhgia']);
Route::post('/donhang/dathang', [ThanhtoanController::class, 'thanhtoansanpham']);

//admin
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
    // hienchitietsanpham
    Route::get('/administrator/chitiet/{id}', [QLsanphamController::class, 'getchietSP']);
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
    Route::post('/administrator/suathuoctinh', [QLDMController::class, 'suathuoctinh']);
    Route::delete('/administrator/deletethuoctinh/{id}', [QLDMController::class, 'xoathuoctinh']);
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
    Route::get('/administrator/quanlydonhang', [QLdonhangController::class, 'pagesQLdonhang']);
    // Route::get('/administrator/quanlydonhang/{select}', [QLdonhangController::class, 'pagesQLdonhang']);
    Route::get('/administrator/quanlychitietdonhang/{id}', [QLchitietdonhangController::class, 'pagesQLchitietdonhang']);
    Route::post('/administrator/suaTTDH', [QLdonhangController::class, 'suaTTDH']);
    Route::post('/administrator/pdf', [QLchitietdonhangController::class, 'createPDF']);
    //thống kê võ thanh tín
    Route::get('/administrator/thongkedoanhthu', [thongkeController::class, 'trangthongkedoanhthu']);
    Route::get('/administrator/thongkedoanhthu/thongke', [thongkeController::class, 'thongke']);
    //thong kê người dùng
    Route::get('/administrator/thongkenguoidung', [thongkeController::class, 'thongkenguoidung']);
    Route::get('/administrator/thongkenguoidung/data', [thongkeController::class, 'layDuLieuNguoiDung']);

    //thong kê sanpham
    Route::get('/administrator/thongkesanpham', [thongkeController::class, 'thongkesanpham']);
    Route::get('/administrator/thongkesanpham/data', [ThongkeController::class, 'thongKeSP']);

    //Quan ly binh luan
    Route::get('/administrator/quanlybinhluan', [danhgiaController::class, 'trangQLbinhluan']);
    Route::delete('/administrator/xoabinhluan/{id}', [danhgiaController::class, 'xoabinhluan']);
    //loc sanpham
    Route::get('/administrator/locsapham/{id}', [QLsanphamController::class, 'bangsanpham']);
    Route::post('/administrator/loctrangthai', [QLsanphamController::class, 'loctrangthai']);
    Route::post('/administrator/loctheoten', [QLsanphamController::class, 'loctheoten']);
    //loc don hang
    Route::get('/administrator/donhang/locdonhang', [QLdonhangController::class, 'locDonHang']);
    //nha cung cap
    Route::get('/administrator/nhacungcap', [nhacungcapController::class, 'trangnhacungcap']);
    Route::post('/administrator/themnhacungcap', [nhacungcapController::class, 'themnhacungcap']);
    Route::delete('/administrator/xoanhacungcap/{id}', [nhacungcapController::class, 'xoanhacungcap']);
    Route::get('/administrator/xemnhacungcap/{id}', [nhacungcapController::class, 'xemnhacungcap']);
    Route::post('/administrator/capnhatnhacungcap/{id}', [nhacungcapController::class, 'capnhatnhacungcap']);
});
