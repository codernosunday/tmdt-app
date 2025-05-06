<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\DanhmucsanphamModel;
use App\Models\DanhmucconModel;
use App\Models\SanphamModel;

class DanhmucsanphamProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::composer('layouts.partials.navigation', function ($view) {
            $danhMucSp = DanhmucsanphamModel::all();
            $danhmuccon = DanhmucconModel::where('trangthai', 'Hiện')->get();
            $view->with([
                'danhMucSp' => $danhMucSp,
                'danhmuccon' => $danhmuccon
            ]);
        });
        // View::composer('components.sanpham', function ($view) {

        //     $sp = SanphamModel::paginate(8);
        //     $view->with('sp', $sp);
        // });
        View::composer('components.listsanpham', function ($view) {

            $danhmuccon = DanhmucconModel::where('trangthai', 'Hiện')->get();
            $view->with('danhmuccon', $danhmuccon);
        });
    }
}
