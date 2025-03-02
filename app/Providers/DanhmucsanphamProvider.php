<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\DanhmucsanphamModel;

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
    }
}
