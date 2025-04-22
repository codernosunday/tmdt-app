<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hoadonModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;  // <-- thêm dòng này

class QLdonhangController extends Controller
{
    function pagesQLdonhang($select)
    {
        $trangthai = collect([
            'choxacnhan' => 'chờ xác nhận',
            'daxacnhan' => 'đã xác nhận',
            'danggiaohang' => 'đang giao hàng',
            'dagiohang' => 'đã giao hàng',
            'dahuy' => 'đã hủy'
        ]);

        if($select == 'all'){
            $danhsachdonhang = hoadonModel::with(['vanchuyen', 'nguoidung', 'hinhthuc'])->get()->toArray();
            return view('admin.quanlydonhang', compact('danhsachdonhang'));
        }else if($trangthai->has($select)){
            $danhsachdonhang = hoadonModel::where("trangthaidonhang", $trangthai[$select])->with(['vanchuyen', 'nguoidung', 'hinhthuc'])->get()->toArray();
            return view('admin.quanlydonhang', compact('danhsachdonhang'));

        }else{
            dd('không tìm thấy trạng thái đơn hàng');
        }
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
