<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\DanhgiaModel;
use App\Models\NguoidungModel;
use App\Models\SanphamModel;

class danhgiaController extends Controller
{
    //
    public function danhgia($id, Request $request)
    {
        try {
            $sanpham = SanphamModel::where('id_sp', $id)->first();
            $nguoidung = NguoidungModel::where('id_nd', session('id'))->first();
            $dadanhgia = DanhgiaModel::where('id_nd', session('id'))->first();
            if ($sanpham && $nguoidung && !$dadanhgia) {
                DanhgiaModel::create([
                    'id_nd' => session('id'),
                    'id_sp' => $id,
                    'sosao' => $request->input('rating'),
                    'noidungbinhluan' => $request->input('comment'),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Đánh giá đã được ghi nhận',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy sản phẩm hoặc người dùng',
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi server: ' . $e->getMessage(),
            ], 500);
        }
    }
}
