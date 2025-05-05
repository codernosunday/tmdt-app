<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\DanhmucconModel;
use App\Models\DanhmucsanphamModel;
use Illuminate\Http\Request;
use App\Models\SanphamModel;
use App\Models\ChitietsanphamModel;
use App\Models\giabanModel;
use App\Models\gianhapModel;
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
            ->with('nguoidung')
            ->latest()
            ->get();

        // Calculate stats
        $diemTrungBinh = $danhgia->avg('diem') ?? 0;
        $tongDanhGia = $danhgia->count();

        return view('trangsanpham', compact(
            'sp',
            'chitiet',
            'dschitiet',
            'splienquan',
            'danhgia',
            'diemTrungBinh',
            'tongDanhGia'
        ));
    }
    public function xemctsp($ctsp)
    {
        $ctsp = ChitietsanphamModel::where('id_ctsp', $ctsp)->first();
        if ($ctsp) {
            $giaban = giabanModel::where('id_ctsp', $ctsp->id_ctsp)->first();
            $gianhap = gianhapModel::where('id_ctsp', $ctsp->id_ctsp)->first();
            return response()->json([
                'giaban' => $giaban->giaban ?? 0,
                'soluong' => $gianhap->soluong ?? 0,
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false
            ], 400);
        }
    }
    public function timkiemsanpham(Request $request)
    {
        $keyword = $request->get('keyword');

        if (!$keyword) {
            return response()->json([]);
        }

        $sanphams = SanphamModel::where('tensp', 'like', "%$keyword%")
            ->select('id_sp', 'tensp')
            ->limit(10)
            ->get();

        $results = $sanphams->map(function ($sp) {
            $slugTensp = Str::slug($sp->tensp);
            return [
                'id' => $sp->id_sp,
                'name' => $sp->tensp,
                'slug' => "sanpham/{$slugTensp}/{$sp->id_sp}"
            ];
        });

        return response()->json($results);
    }
}
