<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\DanhmucsanphamModel;
use App\Models\DanhmucconModel;

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
            $view->with('danhMucSp', $danhMucSp);
        });
        View::composer('components.listsanpham', function ($view) {
            $danhmuccon = DanhmucconModel::all();
            $view->with('danhmuccon', $danhmuccon);
        });
    }
}
