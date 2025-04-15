<?php

namespace App\Http\Controllers;

use App\Models\DanhmucconModel;
use App\Models\DanhmucsanphamModel;
use Illuminate\Http\Request;
use App\Models\SanphamModel;
use App\Models\ChitietsanphamModel;
use App\Models\giabanModel;
use App\Models\DanhmucModel;
use App\Models\DanhgiaModel;

class SanphamController extends Controller
{
    public function chitietsanpham($tensp, $sp)
    {
        // Get main product info with relationships
        $sp = SanphamModel::with(['giaban'])->find($sp);
        if (!$sp) {
            abort(404);
        }

        // Get full product details - change to get first() instead of get()
        $chitiet = ChitietsanphamModel::where('id_sp', $sp->id_sp)->first();
        
        // Get all variations of this product
        $dschitiet = ChitietsanphamModel::with(['thuoctinh'])
            ->where('id_sp', $sp->id_sp)
            ->get();
            
        // Get related products (same category)
        $splienquan = SanphamModel::where('id_sp', '!=', $sp->id_sp)
            ->inRandomOrder()
            ->take(4)
            ->get();
            
        // Get product ratings with user info
        $danhgia = DanhgiaModel::where('id_sp', $sp->id_sp)
            ->with('user')
            ->latest()
            ->get();
            
        // Calculate stats
        $diemTrungBinh = $danhgia->avg('diem') ?? 0;
        $tongDanhGia = $danhgia->count();
        
        return view('trangsanpham', compact(
            'sp',
            'chitiet', // change from ctsp to chitiet
            'dschitiet',
            'splienquan',
            'danhgia',
            'diemTrungBinh',
            'tongDanhGia'
        ));
    }
}
