<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hoadonModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;  // <-- thêm dòng này

class QLdonhangController extends Controller
{
    function pagesQLdonhang()
    {
        $danhsachdonhang = hoadonModel::with(['vanchuyen', 'nguoidung', 'hinhthuc'])->get()->toArray();
        return view('admin.quanlydonhang', compact('danhsachdonhang'));
    }
    //loc don hang
    public function locDonHang(Request $request)
    {
        // Get the 'trangthai' parameter from the request
        $trangthai = $request->query('trangthai');

        // Start building the query on the hoadonModel
        $query = hoadonModel::with(['vanchuyen', 'nguoidung', 'hinhthuc']);  // Eager load relationships

        // If 'trangthai' is not empty, add the filter condition
        if (!empty($trangthai)) {
            $query->where('trangthaidonhang', $trangthai);
        }

        // Get the orders, ordered by the created_at column
        $danhsachdonhang = $query->orderBy('created_at', 'desc')->get();

        // Return the view with the filtered list of orders
        return view('admin.bangdonhang', compact('danhsachdonhang'));
    }

    public function suaTTDH(Request $request)
    {
        $data = $request->all();

        Log::info('ID nhận được: ' . ($data['id'] ?? 'null'));

        // Tìm don hang theo ID
        $donhang = hoadonModel::find($data['id']);

        if (!$donhang) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy đơn hàng.'
            ], 404);
        }

        // Cập nhật thông tin
        $donhang->trangthaidonhang  = $data['trangthaidonhang'] ??  $donhang->trangthaidonhang;

        $donhang->save();

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thành công!'
        ]);
    }
}
