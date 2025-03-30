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
        $sp = SanphamModel::with('giaban')->get();
        return view('shop', compact('dm', 'danhmuccon', 'sp'));
    }
    //loc theo danh muc
    public function locSP($danhmuc)
    {
        if ($danhmuc != 0) {
            $sp = SanphamModel::where('id_ctdm', $danhmuc)->limit(8)->get();;
        } else {
            $sp = SanphamModel::limit(8)->get();
        }
        return view('components.sanpham', compact('sp'));
    }
}
