<?php

namespace App\Http\Controllers;

use App\Models\ChitietmuaModel;
use App\Models\ChitietsanphamModel;
use App\Models\DanhmucconModel;
use App\Models\diachiModel;
use App\Models\gianhapModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\hoadonModel;
use App\Models\NguoidungModel;
use App\Models\SanphamModel;

class thongkeController extends Controller
{
    //
    public function trangthongkedoanhthu()
    {
        return view('admin.thongkedoanhthu');
    }
    public function thongke(Request $request)
    {
        $period = $request->query('period', 'month'); // mặc định theo tháng
        $currentYear = Carbon::now()->year;

        switch ($period) {
            case 'year':
                $data = $this->thongKeTheoNam();
                break;
            case 'quarter':
                $data = $this->thongKeTheoQuy($currentYear);
                break;
            case 'month':
            default:
                $data = $this->thongKeTheoThang($currentYear);
                break;
        }

        return response()->json($data);
    }

    // Thống kê theo tháng
    public function thongKeTheoThang($year)
    {
        // Năm hiện tại
        $current = $this->layDuLieuTheoThang($year);
        // Năm trước
        $previous = $this->layDuLieuTheoThang($year - 1);

        return $this->formatData('Tháng ', $current, $previous);
    }

    // Thống kê theo năm
    public function thongKeTheoNam()
    {
        $current = $this->layDuLieuTheoNam();
        $previous = [];
        return $this->formatData('Năm ', $current, $previous);
    }

    // Thống kê theo quý
    public function thongKeTheoQuy($year)
    {
        $current = $this->layDuLieuTheoQuy($year);
        $previous = $this->layDuLieuTheoQuy($year - 1);

        return $this->formatData('Quý ', $current, $previous);
    }

    // Hàm lấy dữ liệu theo tháng
    private function layDuLieuTheoThang($year)
    {
        return hoadonModel::select(
            DB::raw('MONTH(created_at) as key_label'),
            DB::raw('SUM(tontien) as total_revenue'),
            DB::raw('COUNT(id_hoadon) as total_orders')
        )
            ->whereYear('created_at', $year)
            ->where('trangthaidonhang', 'đã giao hàng')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('key_label')
            ->get();
    }

    // Hàm lấy dữ liệu theo quý
    private function layDuLieuTheoQuy($year)
    {
        return hoadonModel::select(
            DB::raw('QUARTER(created_at) as key_label'),
            DB::raw('SUM(tontien) as total_revenue'),
            DB::raw('COUNT(id_hoadon) as total_orders')
        )
            ->whereYear('created_at', $year)
            ->where('trangthaidonhang', 'đã giao hàng')
            ->groupBy(DB::raw('QUARTER(created_at)'))
            ->orderBy('key_label')
            ->get();
    }
    // Hàm lấy dữ liệu theo năm
    private function layDuLieuTheoNam()
    {
        return hoadonModel::select(
            DB::raw('YEAR(created_at) as key_label'),
            DB::raw('SUM(tontien) as total_revenue'),
            DB::raw('COUNT(id_hoadon) as total_orders')
        )
            ->where('trangthaidonhang', 'đã giao hàng')
            ->groupBy('key_label')
            ->orderBy('key_label')
            ->get();
    }

    // Format dữ liệu trả về
    private function formatData($labelPrefix, $currentData, $previousData)
    {
        $labels = [];
        $revenues = [];
        $orders = [];
        $tableData = [];

        foreach ($currentData as $item) {
            $labels[] = $labelPrefix . $item->key_label;
            $revenues[] = $item->total_revenue;
            $orders[] = $item->total_orders;

            $avgValue = $item->total_orders > 0 ? intval($item->total_revenue / $item->total_orders) : 0;

            $tableData[] = [
                'time' => $labelPrefix . $item->key_label,
                'revenue' => $item->total_revenue,
                'orders' => $item->total_orders,
                'avgValue' => $avgValue,
                'growth' => 0, // Có thể xử lý sau
            ];
        }

        // Ghép dữ liệu năm trước nếu có
        $comparison = [
            'previous' => [],
            'current' => [],
        ];
        if (!empty($previousData)) {
            foreach ($previousData as $item) {
                $comparison['previous'][] = $item->total_revenue;
            }
            foreach ($currentData as $item) {
                $comparison['current'][] = $item->total_revenue;
            }
        }

        return [
            'revenueData' => [
                'labels' => $labels,
                'values' => $revenues,
            ],
            'comparisonData' => [
                'labels' => $labels,
                'values' => $comparison,
            ],
            'tableData' => $tableData,
        ];
    }


    public function loadDataCustom(Request $request)
    {
        $start = $request->query('start');
        $end = $request->query('end');

        // Query từ DB theo khoảng ngày
        return response()->json([
            'revenueData' => [
                'labels' => ['01/04', '02/04', '03/04', '04/04'],
                'values' => [50, 60, 70, 90],
            ],
            'comparisonData' => [
                'year2022' => [300, 310, 320, 330],
                'year2023' => [350, 370, 390, 400],
            ],
            'tableData' => [
                [
                    'time' => '01/04/2025',
                    'revenue' => 50000000,
                    'orders' => 450,
                    'avgValue' => 111111,
                    'growth' => 8.5,
                ],
                // ...
            ]
        ]);
    }
    public function exportReport(Request $request)
    {
        // Xử lý xuất Excel hoặc PDF
        return response()->json([
            'message' => 'Xuất báo cáo thành công (chưa làm phần thực tế)',
        ]);
    }
    // thong ke nguoi dung
    public function thongkenguoidung()
    {
        $tongNguoiDung = NguoidungModel::count();
        $nguoiDungMoiThangNay = NguoidungModel::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        $data = [
            "tong" => $tongNguoiDung,
            "ndmoi" => $nguoiDungMoiThangNay
        ];
        return view('admin.thongkenguoidung', compact('data'));
    }
    public function layDuLieuNguoiDung()
    {
        // Tổng số người dùng
        $tongNguoiDung = NguoidungModel::count();

        // Người dùng mới trong tháng này
        $nguoiDungMoi = NguoidungModel::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Tăng trưởng người dùng (6 tháng gần nhất)
        $userGrowth = NguoidungModel::select(
            DB::raw('MONTH(created_at) as thang'),
            DB::raw('YEAR(created_at) as nam'),
            DB::raw('COUNT(*) as soluong')
        )
            ->where('created_at', '>=', now()->subMonths(5))
            ->groupBy('nam', 'thang')
            ->orderBy('nam')
            ->orderBy('thang')
            ->get()
            ->map(function ($item) {
                return [
                    'label' => 'Tháng ' . $item->thang,
                    'value' => $item->soluong
                ];
            });

        // Phân bố người dùng theo tỉnh
        $userLocation = diachiModel::select('tinh', DB::raw('COUNT(*) as soluong'))
            ->groupBy('tinh')
            ->orderByDesc('soluong')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'label' => $item->tinh ?? 'Khác',
                    'value' => $item->soluong
                ];
            });


        // Phân bổ độ tuổi người dùng
        $ageDistribution = [
            '<18' => 0,
            '18-24' => 0,
            '25-34' => 0,
            '35-44' => 0,
            '45-54' => 0,
            '55+' => 0,
        ];

        $users = NguoidungModel::select('ngaysinh')->get();
        foreach ($users as $user) {
            if (!$user->ngaysinh) continue;
            $age = Carbon::parse($user->ngaysinh)->age;
            if ($age < 18) $ageDistribution['<18']++;
            elseif ($age <= 24) $ageDistribution['18-24']++;
            elseif ($age <= 34) $ageDistribution['25-34']++;
            elseif ($age <= 44) $ageDistribution['35-44']++;
            elseif ($age <= 54) $ageDistribution['45-54']++;
            else $ageDistribution['55+']++;
        }

        return response()->json([
            'tong' => $tongNguoiDung,
            'ndmoi' => $nguoiDungMoi,
            'userGrowth' => $userGrowth,
            'userLocation' => $userLocation,
            'ageDistribution' => $ageDistribution,
        ]);
    }
    // thong ke san pham
    public function thongkesanpham()
    {
        $tongsanpham = SanphamModel::count();
        $banchay = ChitietmuaModel::join('chitietsanpham', 'chitietmua.id_ctsp', '=', 'chitietsanpham.id_ctsp')
            ->join('sanpham', 'chitietsanpham.id_sp', '=', 'sanpham.id_sp')
            ->select('sanpham.id_sp', 'sanpham.tensp', DB::raw('SUM(chitietmua.soluong) as total_sold'))
            ->groupBy('sanpham.id_sp', 'sanpham.tensp')
            ->orderByDesc('total_sold')
            ->first();
        $topdanhmuc = SanphamModel::select('id_ctdm', DB::raw('COUNT(*) as product_count'))
            ->groupBy('id_ctdm')
            ->orderByDesc('product_count')
            ->with('danhmuccon') // cần thêm quan hệ trong SanphamModel
            ->first();
        $data = [
            'tongsp' => $tongsanpham,
            'sanphambanchay' => $banchay->tensp,
            'soluongban' => $banchay->total_sold,
            'danhmuc' => $topdanhmuc->danhmuccon->ten
        ];
        return view('admin.thongkesanpham', compact('data'));
    }

    public function thongKeSP()
    {
        try {
            // Đếm số lượng sản phẩm theo danh mục (chỉ lấy những danh mục có sản phẩm)
            $categoryData = DanhmucconModel::withCount('sanpham')
                ->having('sanpham_count', '>', 0)
                ->get(['id_ctdm', 'ten']);

            $totalProducts = $categoryData->sum('sanpham_count');

            $categoryDistribution = $categoryData->map(function ($item) use ($totalProducts) {
                return [
                    'tendanhmuc' => $item->ten,
                    'sanpham_count' => $item->sanpham_count,
                    'percentage' => $totalProducts > 0 ? round(($item->sanpham_count / $totalProducts) * 100, 2) : 0
                ];
            });

            // Tình trạng tồn kho
            $stocked = gianhapModel::where('soluong', '>', 10)->count();
            $low = gianhapModel::whereBetween('soluong', [1, 10])->count();
            $out = gianhapModel::where('soluong', '=', 0)->count();
            $totalInventory = $stocked + $low + $out;

            $inventoryStatus = [
                'stocked' => $totalInventory > 0 ? round(($stocked / $totalInventory) * 100, 2) : 0,
                'low' => $totalInventory > 0 ? round(($low / $totalInventory) * 100, 2) : 0,
                'out' => $totalInventory > 0 ? round(($out / $totalInventory) * 100, 2) : 0,
            ];

            // Top sản phẩm bán chạy
            $topSellingProducts = DB::table('sanpham as sp')
                ->join('chitietsanpham as ctsp', 'sp.id_sp', '=', 'ctsp.id_sp')
                ->join('chitietmua as ctm', 'ctsp.id_ctsp', '=', 'ctm.id_ctsp')
                ->select('sp.id_sp', 'sp.tensp', DB::raw('SUM(ctm.soluong) as total_sold'))
                ->groupBy('sp.id_sp', 'sp.tensp')
                ->orderByDesc('total_sold')
                ->limit(5)
                ->get();

            // Hiệu suất bán hàng theo danh mục
            $categoryPerformance = DB::table('bangdanhmuc as dmc')
                ->join('sanpham as sp', 'dmc.id_ctdm', '=', 'sp.id_ctdm') // dùng JOIN thường thay vì LEFT JOIN
                ->leftJoin('chitietsanpham as ctsp', 'sp.id_sp', '=', 'ctsp.id_sp')
                ->leftJoin('giaban', 'ctsp.id_ctsp', '=', 'giaban.id_ctsp')
                ->leftJoin('gianhap', 'ctsp.id_ctsp', '=', 'gianhap.id_ctsp')
                ->select(
                    'dmc.ten',
                    DB::raw('SUM(COALESCE(giaban.giaban,0)) as total_sales'),
                    DB::raw('SUM(COALESCE(giaban.giaban,0) - COALESCE(gianhap.gianhap,0)) as total_profit')
                )
                ->groupBy('dmc.id_ctdm', 'dmc.ten')
                ->get();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'categoryDistribution' => $categoryDistribution,
                    'inventoryStatus' => $inventoryStatus,
                    'topSellingProducts' => $topSellingProducts,
                    'categoryPerformance' => $categoryPerformance,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lỗi khi lấy dữ liệu thống kê',
                'error_detail' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }
}
