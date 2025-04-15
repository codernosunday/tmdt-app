<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NguoidungModel;

class QLnguoidungController extends Controller
{
    function pagesQLnguoidung()
    {
        $danhsachnguoidung = NguoidungModel::all();
        return view('admin.quanlynguoidung', compact('danhsachnguoidung'));
    }

    function xoaNguoiDung(Request $request)
    {
        $nguoidung = NguoidungModel::find($request->id);
        if ($nguoidung) {
            $nguoidung->delete();
            return redirect()->back()->with('DeleteSuccess', 'Xóa người dùng thành công!');
        } else {
            return redirect()->back()->with('DeleteError', 'Không thể xóa người dùng này!');
        }
    }

    public function suaNguoiDung(Request $request)
    {
        // Nhận dữ liệu JSON từ fetch
        $data = $request->all();

        // Tìm người dùng theo ID
        $nguoidung = NguoidungModel::find($data['id']);

        if (!$nguoidung) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy người dùng.'
            ], 404);
        }

        // Cập nhật thông tin
        $nguoidung->hovaten     = $data['hovaten'] ?? $nguoidung->hovaten;
        $nguoidung->ngaysinh    = $data['ngaysinh'] ?? $nguoidung->ngaysinh;
        $nguoidung->soDT        = $data['sodt'] ?? $nguoidung->soDT;
        $nguoidung->tinhtrantk  = $data['tinhtrantk'] ?? $nguoidung->tinhtrantk;
        $nguoidung->quyentruycap= $data['quyentruycap'] ?? $nguoidung->quyentruycap;

        // Lưu lại
        $nguoidung->save();

        // Trả về JSON báo thành công
        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thành công!'
        ]);
    }
}
