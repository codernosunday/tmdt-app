<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\DanhmucconModel;
use App\Models\DanhmucsanphamModel;

class QLDMController extends Controller
{
    //Hiển thị giao diện
    function danhmuccha()
    {
        $dmcha = DanhmucsanphamModel::all();
        return view('admin.danhmuccha.danhmuccha', compact('dmcha'));
    }
    public function danhmuccon(Request $request)
    {
        $query = DanhmucconModel::with('danhmuccha');
        $dmcon = $query->paginate(10);
        if ($request->ajax()) {
            return view('admin.danhmuccon.dmc_data', compact('dmcon'))->render();
        }
        return view('admin.danhmuccon.danhmuccon', compact('dmcon'));
    }
    //Danh mục cha
    public function postthemDMcha(Request $request)
    {
        try {
            $validated = $request->validate([
                'tendanhmuc' => 'required|string|max:255',
                'ghichu' => 'nullable|string|max:255',
            ]);
            DanhmucsanphamModel::create([
                'tendanhmuc' => $validated['tendanhmuc'],
                'ghichu' => $validated['ghichu']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thêm thành công!',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi hệ thống!',
                'errors' => ['system' => 'Có lỗi xảy ra, vui lòng thử lại.']
            ], 500);
        }
    }
    public function deleteDMcha($id)
    {
        try {
            $dmsp = DanhmucsanphamModel::find($id);
            if ($dmsp) {
                $dmsp->delete();
            }
            return response()->json([
                'message' => 'Danh mục đã được xoá',
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi hệ thống!',
                'errors' => ['system' => 'Có lỗi xảy ra, vui lòng thử lại.']
            ], 500);
        }
    }
}
