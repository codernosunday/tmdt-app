<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\ChitietgiohangModel;
use App\Models\NguoidungModel;
use App\Models\SanphamModel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.partials.navigation', function ($view) {
            $chitietgiohang = ChitietgiohangModel::where("id_giohang", session("id_giohang"));
            $count = $chitietgiohang->count("*");

            $ids_sanpham = ChitietgiohangModel::where('id_giohang', session('id_giohang'))
                ->pluck('id_sp');

            $sanphams = SanphamModel::whereIn('id_sp', $ids_sanpham)->get();

            $con = 1;

            $view->with([
                'countProductInCart' => $count,
                'cart' => $chitietgiohang->get(),
            ]);
        });
        View::composer('admin.adminlayout.navbar_admin', function ($view) {
            $nguoidung = NguoidungModel::where('id_nd', session('id'))->first();
            $quyen = $nguoidung->quyentruycap;
            $view->with([
                'quyen' => $quyen,
            ]);
        });
    }
}
