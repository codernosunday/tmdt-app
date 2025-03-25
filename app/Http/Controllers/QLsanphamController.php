<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\SanphamModel;
use App\Models\ChitietsanphamModel;
use App\Models\giabanModel;
use App\Models\gianhapModel;
use App\Models\DanhmucconModel;

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

            // Cập nhật chi tiết sản phẩm
            ChitietsanphamModel::updateOrCreate(
                ['id_sp' => $validated['id_sp']],
                [
                    'chieurong' => $request->input('chieurong'),
                    'chieucao' => $request->input('chieucao'),
                    'doday' => $request->input('doday'),
                    'soluong' => $validated['soluong'] ?? 0,
                    'sotrang' => $request->input('sotrang'),
                    'thuonghieu' => $request->input('thuonghieu'),
                    'anhsp' => $validated['anh'] ?? $sanpham->anh,
                    'mausac' => $request->input('mausac'),
                    'mammau' => $request->input('mamau'),
                    'dattinh' => $request->input('dattinh')
                ]
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
        return view('admin.themsanpham', compact('danhmuccon'));
    }
    function postthemsanpham(Request $request)
    {
        DB::beginTransaction();
        try {
            $sanpham = SanphamModel::create([
                'id_ctdm' => $request->input('danhmuc'),
                'tensp' => $request->input('tensp'),
                'anh' => $request->input('anh'),
                'tomtatsp' => $request->input('tomtatsp'),
                'tinhtrang' => $request->input('tinhtrang')
            ]);
            $id_sp = $sanpham->id_sp;
            gianhapModel::create([
                'id_sp' => $id_sp,
                'gianhap' => $request->input('gianhap'),
                'soluong' => $request->input('soluong')
            ]);
            giabanModel::create([
                'id_sp' => $id_sp,
                'giaban' => $request->input('giaban')
            ]);
            ChitietsanphamModel::create([
                'id_sp' => $id_sp,
                'chieurong' => $request->input('chieurong'),
                'chieucao' => $request->input('chieucao'),
                'doday' => $request->input('doday'),
                'soluong' => $request->input('soluong'),
                'sotrang' => $request->input('sotrang'),
                'thuonghieu' => $request->input('thuonghieu'),
                'anhsp' => $request->input('anh'),
                'mausac' => $request->input('mausac'),
                'mammau' => $request->input('mamau'),
                'dattinh' => $request->input('mamau')
            ]);
            DB::commit();
            return response()->json([
                'message' => 'Sản phẩm được thêm thành công!',
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e,
            ], 500);
        }
    }
}
