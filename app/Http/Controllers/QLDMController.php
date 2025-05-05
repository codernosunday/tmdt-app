<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\DanhmucconModel;
use App\Models\DanhmucsanphamModel;
use App\Models\ThuoctinhspModel;
use Illuminate\Auth\Events\Validated;

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
        $dmcha = DanhmucsanphamModel::all();
        $dmcon = $query->paginate(10);
        if ($request->ajax()) {
            return view('admin.danhmuccon.dmc_data', compact('dmcon'))->render();
        }
        return view('admin.danhmuccon.danhmuccon', compact('dmcon', 'dmcha'));
    }
    //Danh mục cha
    public function postthemDMcha(Request $request)
    {
        try {
            $validated = $request->validate([
                'tendanhmuc' => 'required|string|max:255',
                'ghichu' => 'nullable|string|max:255',
            ]);

            $existing = DanhmucsanphamModel::where('tendanhmuc', $validated['tendanhmuc'])->first();
            if ($existing) {
                return response()->json([
                    'success' => false,
                    'message' => 'Danh mục đã tồn tại!',
                ], 409);
            }

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
                'errors' => [
                    'system' => config('app.debug') ? $e->getMessage() : 'Có lỗi xảy ra, vui lòng thử lại.'
                ]
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
    public function postSuaDMcha(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_dm' => 'required|integer',
                'tendanhmuc' => 'nullable|string|max:255',
                'ghichu' => 'nullable|string|max:255',
            ]);

            $dm = DanhmucsanphamModel::find($validated['id_dm']);

            if (!$dm) {
                return response()->json([
                    'success' => false,
                    'message' => 'Danh mục không tồn tại!',
                ], 404);
            }
            unset($validated['id_dm']);
            $dm->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thành công!',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    //danh muc con
    public function postDeleteDMcon($id)
    {
        try {
            $dmc = DanhmucconModel::where('id_ctdm', $id)->first();
            if ($dmc) {
                $dmc->delete();
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
    public function trangsuaDMcon($id)
    {
        $dmcha = DanhmucsanphamModel::all();
        $dmcon = DanhmucconModel::where('id_ctdm', $id)->first();
        return view('admin.danhmuccon.suadanhmuccon', compact('dmcha', 'dmcon'));
    }
    public function postUpdateDMcon(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_ctdm' => 'required|integer',
                'id_dm' => 'required|integer',
                'ten' => 'nullable|string|max:255',
                'ghichu' => 'nullable|string|max:255',
                'trangthai' => 'nullable|string|max:255',
            ]);
            $dmc = DanhmucconModel::find($validated['id_ctdm']);
            if (!$dmc) {
                return response()->json([
                    'success' => false,
                    'message' => 'Danh mục không tồn tại!',
                ], 404);
            }
            if (isset($validated['ten'])) {
                $dmc->ten = $validated['ten'];
            }
            if (isset($validated['id_dm'])) {
                $dmc->id_dm = $validated['id_dm'];
            }
            if (isset($validated['ghichu'])) {
                $dmc->ghichu = $validated['ghichu'];
            }
            if (isset($validated['trangthai'])) {
                $dmc->trangthai = $validated['trangthai'];
            }
            $dmc->save();
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thành công!',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function postAddDMcon(Request $request)
    {
        try {
            $validated = $request->validate([
                'tendanhmuc' => 'required|string|max:255',
                'id_dmcha' => 'required|integer',
                'ghichu' => 'nullable|string|max:255',
            ]);
            $dmc = DanhmucconModel::where('ten', $validated['tendanhmuc'])->first();
            if ($dmc) {
                return response()->json([
                    'success' => false,
                    'message' => 'Danh mục đã tồn tại!',
                ], 409);
            }

            DanhmucconModel::create([
                'id_dm' => $validated['id_dmcha'],
                'ten' => $validated['tendanhmuc'],
                'ghichu' => $validated['ghichu']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thêm danh mục con thành công!',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    // Quản lý phân loại và màu sắc
    public function trangPhanloai()
    {
        $thuoctinh = ThuoctinhspModel::all();
        return view('admin.phanloaimau', compact('thuoctinh'));
    }
    public function postThemPhanloai(Request $request)
    {
        try {
            ThuoctinhspModel::create([
                'loai' => $request->loai,
                'kichthuoc' => $request->kichthuoc,
                'mau' => $request->mau,
                'mamau' => $request->mamau,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'thêm thành công',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function xoathuoctinh($id)
    {
        $thuoctinh = ThuoctinhspModel::find($id);
        if ($thuoctinh) {
            $thuoctinh->delete();
            return response()->json(['success' => true, 'message' => 'Đã xoá thuộc tính.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy thuộc tính.'], 404);
        }
    }
    public function suathuoctinh(Request $request)
    {
        $validated = $request->validate([
            'id_thuoctinh' => 'required|exists:thuoctinhsanpham,id_thuoctinh',
        ]);

        $thuoctinh = ThuoctinhspModel::find($request->id_thuoctinh);

        // Cập nhật các trường nếu có
        if ($request->has('loai')) {
            $thuoctinh->loai = $request->loai;
        }

        if ($request->has('kichthuoc')) {
            $thuoctinh->kichthuoc = $request->kichthuoc;
        }

        if ($request->has('mau')) {
            $thuoctinh->mau = $request->mau;
        }

        if ($request->has('mamau')) {
            $thuoctinh->mamau = $request->mamau;
        }

        $thuoctinh->save();

        return response()->json(['success' => true, 'message' => 'Cập nhật thuộc tính thành công.']);
    }
}
