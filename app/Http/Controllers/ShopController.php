<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SanphamModel;
use App\Models\ChitietsanphamModel;
use App\Models\giabanModel;
use App\Models\gianhapModel;
use App\Models\DanhmucconModel;
use App\Models\DanhmucsanphamModel;

class ShopController extends Controller
{
    //
    public function shop()
    {
        $dm = DanhmucsanphamModel::all();
        $danhmuccon = DanhmucconModel::all();
        $sp = SanphamModel::all();
        return view('shop', compact('dm', 'danhmuccon', 'sp'));
    }
}
