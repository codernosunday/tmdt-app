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
                'ten' => 'nullable|string|max:255',
                'ghichu' => 'nullable|string|max:255',
            ]);

            // Tìm bản ghi cần cập nhật
            $dm = DanhmucsanphamModel::find($validated['ten']);

            if (!$dm) {
                return response()->json([
                    'success' => false,
                    'message' => 'Danh mục không tồn tại!',
                ], 404);
            }

            // Chỉ cập nhật những trường có giá trị
            if (isset($validated['ten'])) {
                $dm->tendanhmuc = $validated['ten'];
            }
            if (isset($validated['ghichu'])) {
                $dm->ghichu = $validated['ghichu'];
            }

            $dm->save();

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
}
