<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\SanphamModel;
// use App\Models\ChitietsanphamModel;
use App\Models\giabanModel;
// use App\Models\gianhapModel;
use App\Models\DanhmucconModel;
use App\Models\DanhmucsanphamModel;
use App\Models\giasaleModel;

class ShopController extends Controller
{
    //
    public function shop()
    {
        // dd(session('email'));
        $dm = DanhmucsanphamModel::all();
        $danhmuccon = DanhmucconModel::where('trangthai', 'Hiện')->get();
        $sp = SanphamModel::with('giaban')->get();
        return view('shop', compact('dm', 'danhmuccon'));
    }
    //loc theo danh muc
    public function locSP($danhmuc)
    {
        $sale = giasaleModel::where('trangthai', 1)->get();
        if ($danhmuc != 0) {
            $sp = SanphamModel::where('id_ctdm', $danhmuc)
                ->where('trangthai', 'conhang')
                ->limit(16)
                ->get();
        } else {
            $sp = SanphamModel::where('trangthai', 'conhang')
                ->limit(40)
                ->get();
        }
        return view('components.sanpham', compact('sp', 'sale'));
    }
    public function locnangcao(Request $request)
    {
        try {
            $sale = giasaleModel::where('trangthai', 1)->get();
            $filters = $request->json()->all();

            $query = SanphamModel::with(['giaban', 'chitietsanpham'])
                ->where('trangthai', 'conhang');

            // Lọc theo danh mục
            if (!empty($filters['id_ctdm'])) {
                $query->where('id_ctdm', $filters['id_ctdm']);
            }

            // Lọc theo khoảng giá
            if (!empty($filters['priceRange']) && is_array($filters['priceRange'])) {
                $query->whereHas('giaban', function ($q) use ($filters) {
                    $q->where(function ($subQuery) use ($filters) {
                        foreach ($filters['priceRange'] as $price) {
                            if ($price === 'giaduoi50k') {
                                $subQuery->orWhere('giaban', '<', 50000);
                            }
                            if ($price === 'gia50k_200k') {
                                $subQuery->orWhereBetween('giaban', [50000, 200000]);
                            }
                            if ($price === 'gia200k_100m') {
                                $subQuery->orWhereBetween('giaban', [200000, 1000000]);
                            }
                            if ($price === 'gia100m') {
                                $subQuery->orWhere('giaban', '>', 1000000);
                            }
                        }
                    });
                });
            }
            // Lọc theo thương hiệu
            if (!empty($filters['brand']) && is_array($filters['brand'])) {
                $brandMap = [
                    'brandthienlong' => 'Thiên Long',
                    'brandFlexOffice' => 'Flexoffice',
                    'brandColorKid' => 'Color Kid',
                ];
                $query->whereHas('chitietsanpham', function ($q) use ($filters, $brandMap) {
                    $q->where(function ($subQ) use ($filters, $brandMap) {
                        foreach ($filters['brand'] as $brandKey) {
                            if (isset($brandMap[$brandKey])) {
                                $subQ->orWhere('thuonghieu', 'LIKE', $brandMap[$brandKey]);
                            }
                        }
                    });
                });
            }

            // Sắp xếp theo giá (giá mới nhất)
            if (!empty($filters['priceOrder'])) {
                $query->join(
                    DB::raw("(SELECT id_sp, giaban FROM giaban gb1
                                       WHERE updated_at = (SELECT MAX(updated_at)
                                                           FROM giaban
                                                           WHERE id_sp = gb1.id_sp)) as latest_price"),
                    'sanpham.id_sp',
                    '=',
                    'latest_price.id_sp'
                )
                    ->orderBy('latest_price.giaban', $filters['priceOrder'] === 'priceHighLow' ? 'desc' : 'asc')
                    ->select('sanpham.*'); // Đảm bảo chỉ lấy cột từ bảng chính
            }

            // Sắp xếp theo tên
            if (!empty($filters['nameOrder'])) {
                $query->orderBy('tensp', $filters['nameOrder'] === 'nameAZ' ? 'asc' : 'desc');
            }

            $sp = $query->get();

            return response()->json([
                'status' => 'success',
                'data' => view('components.sanpham', compact('sp', 'sale'))->render()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Lỗi xử lý dữ liệu',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
