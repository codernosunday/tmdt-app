<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SanphamModel;
// use App\Models\ChitietsanphamModel;
use App\Models\giabanModel;
// use App\Models\gianhapModel;
use App\Models\DanhmucconModel;
use App\Models\DanhmucsanphamModel;

class ShopController extends Controller
{
    //
    public function shop()
    {
        // dd(session('email'));
        $dm = DanhmucsanphamModel::all();
        $danhmuccon = DanhmucconModel::all();
        $sp = SanphamModel::with('giaban')->get();
        return view('shop', compact('dm', 'danhmuccon'));
    }
    //loc theo danh muc
    public function locSP($danhmuc)
    {
        if ($danhmuc != 0) {
            $sp = SanphamModel::where('id_ctdm', $danhmuc)->limit(16)->get();
        } else {
            $sp = SanphamModel::limit(16)->get();
        }
        return view('components.sanpham', compact('sp'));
    }
    public function locnangcao(Request $request)
    {
        try {
            $filters = $request->json()->all();
            $query = SanphamModel::with('giaban')
                ->join('chitietsanpham', 'sanpham.id_sp', '=', 'chitietsanpham.id_sp');;

            // Lọc theo danh mục 
            if (!empty($filters['id_ctdm'])) {
                $query->where('id_ctdm', $filters['id_ctdm']);
            }

            // Lọc theo thứ tự giá (sắp xếp theo giá bán mới nhất)
            if (!empty($filters['priceOrder'])) {
                $query->whereHas('giaban') // Đảm bảo sản phẩm có giá
                    ->orderBy(
                        GiabanModel::select('giaban')
                            ->whereColumn('giaban.id_sp', 'sanpham.id_sp')
                            ->latest('updated_at')
                            ->limit(1),
                        $filters['priceOrder'] === 'priceLowHigh' ? 'asc' : 'desc'
                    );
            }

            // Lọc theo thứ tự tên sản phẩm
            if (!empty($filters['nameOrder'])) {
                $query->orderByRaw("LEFT(tensp, 1) " . ($filters['nameOrder'] === 'nameAZ' ? 'ASC' : 'DESC'));
            }

            // Lọc theo khoảng giá (dựa trên quan hệ giaban)
            if (!empty($filters['priceRange']) && is_array($filters['priceRange'])) {
                $query->whereHas('giaban', function ($q) use ($filters) {
                    $q->where(function ($subQuery) use ($filters) {
                        foreach ($filters['priceRange'] as $price) {
                            if ($price === 'giaduoi50k') {
                                $subQuery->orWhere('giaban.giaban', '<', 50000);
                            }
                            if ($price === 'gia50k_200k') {
                                $subQuery->orWhereBetween('giaban.giaban', [50000, 200000]);
                            }
                            if ($price === 'gia200k_100m') {
                                $subQuery->orWhereBetween('giaban.giaban', [200000, 1000000]);
                            }
                            if ($price === 'gia100m') {
                                $subQuery->orWhere('giaban.giaban', '>', 1000000);
                            }
                        }
                    });
                });
            }
            if (!empty($filters['brand']) && is_array($filters['brand'])) {
                $query->where(function ($q) use ($filters) {
                    foreach ($filters['brand'] as $brand) {
                        if ($brand == 'brandthienlong') {
                            $q->orWhere('chitietsanpham.thuonghieu', 'LIKE', "Thiên Long");
                        }
                        if ($brand == 'brandFlexOffice') {
                            $q->orWhere('chitietsanpham.thuonghieu', 'LIKE', "Flexoffice");
                        }
                        if ($brand == 'brandColorKid') {
                            $q->orWhere('chitietsanpham.thuonghieu', 'LIKE', "Color Kid");
                        }
                    }
                });
            }
            // Lấy danh sách sản phẩm đã lọc
            $sp = $query->get();
            return response()->json([
                'status' => 'success',
                'data' => view('components.sanpham', compact('sp'))->render()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Lỗi xử lý dữ liệu',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
