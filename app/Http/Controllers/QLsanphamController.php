<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\SanphamModel;
use App\Models\ChitietsanphamModel;
use App\Models\giabanModel;
use App\Models\gianhapModel;
use App\Models\DanhmucconModel;
use App\Models\ThuoctinhspModel;

class QLsanphamController extends Controller
{
    //
    function pagesQLsanpham()
    {
        $sp = SanphamModel::all();
        return view('admin.quanlysanpham', compact('sp'));
    }
    function pagesQLchitietsanpham($id_sp)
    {
        $danhmuc = DanhmucconModel::all();
        $sp = SanphamModel::where('id_sp', $id_sp)->first();
        $ban = giabanModel::where('id_sp', $id_sp)->first();
        $nhap = gianhapModel::where('id_sp', $id_sp)->first();
        $ctsp = ChitietsanphamModel::where('id_sp', $id_sp)->first();
        return view('admin.chitietsanpham', compact('sp', 'ban', 'nhap', 'ctsp', 'danhmuc'));
    }

    public function postcapnhatsanpham(Request $request)
    {
        try {
            // Kiểm tra đầu vào
            $validated = $request->validate([
                'danhmuc' => 'required|integer',
                'id_sp' => 'required|exists:sanpham,id_sp',
                'tensp' => 'required|string|max:255',
                'anh' => 'nullable|string|max:255',
                'tomtatsp' => 'nullable|string',
                'tinhtrang' => 'nullable|boolean',
                'gianhap' => 'nullable|numeric|min:0',
                'soluong' => 'nullable|integer|min:0',
                'giaban' => 'nullable|numeric|min:0',
                'tieuchuan' => 'nullable|string',
                'loiich' => 'nullable|string',
                'sanxuat' => 'nullable|string',
                'xuatsu' => 'nullable|string',
                'tinhnang' => 'nullable|string',
                'kichthuoc' => 'nullable|string'
            ]);
            DB::beginTransaction();
            // Kiểm tra sản phẩm tồn tại
            $sanpham = SanphamModel::find($validated['id_sp']);
            if (!$sanpham) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sản phẩm không tồn tại!',
                    'errors' => ['id_sp' => 'ID sản phẩm không hợp lệ.']
                ], 404);
            }
            // Cập nhật sản phẩm
            $sanpham->update([
                'id_ctdm' => $validated['danhmuc'],
                'tensp' => $validated['tensp'],
                'anh' => $validated['anh'] ?? $sanpham->anh,
                'tomtatsp' => $validated['tomtatsp'],
                'tinhtrang' => $validated['tinhtrang']
            ]);
            // Cập nhật chi tiết sản phẩm
            ChitietsanphamModel::updateOrCreate(
                ['id_sp' => $validated['id_sp']],
                [
                    'doday' => $request->input('doday'),
                    'soluong' => $validated['soluong'] ?? 0,
                    'sotrang' => $request->input('sotrang'),
                    'thuonghieu' => $request->input('thuonghieu'),
                    'anhsp' => $validated['anh'] ?? $sanpham->anh,
                    'mausac' => $request->input('mausac'),
                    'mamau' => $request->input('mamau'),
                    'dattinh' => $request->input('dattinh'),
                    'tieuchuan' => $validated['tieuchuan'],
                    'loiich' => $validated['loiich'],
                    'xuatsu' => $validated['xuatsu'],
                    'tinhnangnoibat' => $validated['tinhnang'],
                    'kichthuoc' => $validated['kichthuoc']
                ]
            );
            // Cập nhật giá nhập
            gianhapModel::updateOrCreate(
                ['id_sp' => $validated['id_sp']],
                [
                    'gianhap' => $validated['gianhap'] ?? null,
                    'soluong' => $validated['soluong'] ?? null
                ]
            );
            // Cập nhật giá bán
            giabanModel::updateOrCreate(
                ['id_sp' => $validated['id_sp']],
                ['giaban' => $validated['giaban'] ?? null]
            );

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Sản phẩm được cập nhật thành công!',
                'data' => $sanpham
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi xác thực dữ liệu!',
                'errors' => $e->errors()
            ], 422);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Lỗi truy vấn database!',
                'errors' => ['database' => $e->getMessage()]
            ], 500);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Lỗi hệ thống!',
                'errors' => ['system' => config('app.debug') ? $e->getMessage() : 'Có lỗi xảy ra, vui lòng thử lại.']
            ], 500);
        }
    }



    function pagesthemsanpham()
    {
        $danhmuccon = DanhmucconModel::all();
        $thuoctinh = ThuoctinhspModel::all();
        return view('admin.themsanpham', compact('danhmuccon', 'thuoctinh'));
    }
    function postthemsanpham(Request $request)
    {
        $validated = $request->validate([
            'danhmuc' => 'required|integer',
            'tensp' => 'required|string|max:255',
            'anh' => 'nullable|string|max:255',
            'tomtatsp' => 'nullable|string',
            'tinhtrang' => 'nullable|boolean',
            'gianhap' => 'nullable|numeric|min:0',
            'soluong' => 'nullable|integer|min:0',
            'giaban' => 'nullable|numeric|min:0',
            'kichthuoc' => 'nullable|string',
            'sanxuat' => 'nullable|string',
            'tieuchuan' => 'nullable|string',
            'loiich' => 'nullable|string',
            'xuatsu' => 'nullable|string',
            'tinhnang' => 'nullable|string'
        ]);
        DB::beginTransaction();
        try {
            $sanpham = SanphamModel::create([
                'id_ctdm' => $validated['danhmuc'],
                'tensp' => $validated['tensp'],
                'anh' => $validated['anh'],
                'tomtatsp' => $validated['tomtatsp'],
                'tinhtrang' => $validated['tinhtrang']
            ]);
            $id_sp = $sanpham->id_sp;
            $ctsp = ChitietsanphamModel::create([
                'id_sp' => $id_sp,
                'id_thuoctinh' => $request->input('thuoctinh'),
                'doday' => $request->input('doday'),
                'soluong' => $request->input('soluong'),
                'sotrang' => $request->input('sotrang'),
                'thuonghieu' => $request->input('thuonghieu'),
                'anhsp' => $request->input('anh'),
                'dattinh' => $request->input('mamau'),
                'sanxuat' => $validated['sanxuat'],
                'tieuchuan' => $validated['tieuchuan'],
                'loiich' => $validated['loiich'],
                'kichthuoc' => $validated['kichthuoc'],
                'xuatsu' => $validated['xuatsu'],
                'tinhnangnoibat' => $validated['tinhnang']
            ]);
            $id_ctsp = $ctsp->id_ctsp;
            gianhapModel::create([
                'id_ctsp' => $id_ctsp,
                'id_sp' => $id_sp,
                'gianhap' => $request->input('gianhap'),
                'soluong' => $request->input('soluong')
            ]);
            giabanModel::create([
                'id_ctsp' => $id_ctsp,
                'id_sp' => $id_sp,
                'giaban' => $request->input('giaban')
            ]);
            DB::commit();
            return response()->json([
                'message' => 'Sản phẩm được thêm thành công!',
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    function deleteSP($id)
    {
        try {
            $sanpham = SanphamModel::find($id);
            if ($sanpham) {
                $sanpham->delete();
            }
            return response()->json([
                'message' => 'Sản phẩm đã được xoá',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e,
            ], 500);
        }
    }
    //thêm chi tiết sản phẩm
    function chiTietSanPham($id)
    {
        $sp = sanphamModel::where('id_sp', $id)->first();
        $thuoctinh = ThuoctinhspModel::all();
        return view('admin.themchitietsanpham', compact('sp', 'thuoctinh'));
    }
    function PostThemchiTietSanPham(Request $request)
    {
        DB::beginTransaction();
        try {
            $ctsp = ChitietsanphamModel::create([
                'id_sp' => $request->input('id_sp'),
                'id_thuoctinh' => $request->input('mausac'),
                'doday' => $request->input('doday'),
                'soluong' => $request->input('soluong'),
                'sotrang' => $request->input('sotrang'),
                'thuonghieu' => $request->input('thuonghieu'),
                'anhsp' => $request->input('anh'),
                'sanxuat' => $request->input('sanxuat'),
                'tieuchuan' => $request->input('tieuchuan'),
                'loiich' => $request->input('loiich'),
                'kichthuoc' => $request->input('kichthuoc'),
                'xuatsu' => $request->input('xuatsu'),
                'tinhnangnoibat' => $request->input('tinhnang')
            ]);
            $id_ctsp = $ctsp->id_ctsp;
            gianhapModel::create([
                'id_ctsp' => $id_ctsp,
                'gianhap' => $request->input('gianhap'),
                'soluong' => $request->input('soluong')
            ]);
            giabanModel::create([
                'id_ctsp' => $id_ctsp,
                'giaban' => $request->input('giaban')
            ]);
            DB::commit();
            return response()->json([
                'message' => 'Sản phẩm được thêm thành công!',
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
