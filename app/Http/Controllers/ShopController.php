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
    public function locnangcao(Request $request)
    {
        $filters = $request->json()->all();
        $query = SanphamModel::with('giaban');
        return view('components.sanpham');
        if (!empty($filters['priceOrder'])) {
            $query->join('giaban', 'sanpham.id', '=', 'giaban.id_sanpham')
                ->orderBy('giaban.giaban', $filters['priceOrder'] === 'priceLowHigh' ? 'asc' : 'desc');
        }
        if (!empty($filters['nameOrder'])) {
            $query->orderBy('ten', $filters['nameOrder'] === 'nameAZ' ? 'asc' : 'desc');
        }
        if (!empty($filters['priceRange'])) {
            $query->where(function ($q) use ($filters) {
                foreach ($filters['priceRange'] as $price) {
                    if ($price == 'duoi50k') {
                        $q->orWhere('giaban', '<', 50000);
                    } elseif ($price == 'gia2') {
                        $q->orWhereBetween('giaban', [50000, 200000]);
                    } elseif ($price == 'gia3') {
                        $q->orWhereBetween('giaban', [200000, 1000000]);
                    } elseif ($price == 'gia4') {
                        $q->orWhere('giaban', '>', 1000000);
                    }
                }
            });
        }
    }
}
