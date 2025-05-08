<?php

namespace App\Http\Controllers;

use App\Models\ChitietsanphamModel;
use App\Models\gianhapModel;
use App\Models\nhacungcapModel;
use App\Models\SanphamModel;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class nhacungcapController extends Controller
{
    //
    public function trangnhacungcap()
    {
        $nhacc = nhacungcapModel::all();
        return view('admin.quanlynhacungcap', compact('nhacc'));
    }

    public function themnhacungcap(Request $request)
    {
        $validated = $request->validate([
            'ten' => 'required|string|max:255',
            'lienhe' => 'nullable|string|max:500',
        ]);
        try {
            nhacungcapModel::create($validated);
            return response()->json(['message' => 'Thêm nhà cung cấp thành công']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
    public function xoanhacungcap($id)
    {
        $nhacungcap = nhacungcapModel::find($id);
        if (!$nhacungcap) {
            return response()->json(['message' => 'Không tìm thấy nhà cung cấp'], 404);
        }

        if (method_exists($nhacungcap, 'gianhap') && $nhacungcap->gianhap()->count() > 0) {
            return response()->json(['message' => 'Không thể xóa vì có hàng hoá liên quan'], 400);
        }

        $nhacungcap->delete();
        return response()->json(['message' => 'Xóa phí nhà cung cấp thành công']);
    }
    public function xemnhacungcap($id)
    {
        $ncc = nhacungcapModel::find($id);
        if (!$ncc) {
            return response()->json(['message' => 'Không tìm thấy nhà cung cấp'], 404);
        }
        return response()->json($ncc);
    }
    public function capnhatnhacungcap(Request $request, $id)
    {
        $ncc = nhacungcapModel::find($id);
        if (!$ncc) {
            return response()->json(['message' => 'Không tìm thấy nhà cung cấp'], 404);
        }

        $validated = $request->validate([
            'ten' => 'required|string|max:255',
            'lienhe' => 'nullable|string|max:500',
        ]);

        $ncc->update($validated);

        return response()->json(['message' => 'Cập nhật nhà cung cấp thành công']);
    }
    //  Quan ly gia nhap
    public function tranggianhap($id)
    {
        $sp = SanphamModel::find($id);
        $gianhap = gianhapModel::with('nhacungcap')->where('id_sp', $id)->get();
        $nhacungcap = nhacungcapModel::all();
        $ctsp = ChitietsanphamModel::where('id_sp', $id)->get();
        return view('admin.nhapsanpham', compact('gianhap', 'ctsp', 'sp', 'nhacungcap'));
    }
    public function themgianhap(Request $request)
    {
        $validated = $request->validate([
            'id_sanpham' => 'required|integer|exists:sanpham,id_sp',
            'chitietsanpham' => 'required|integer|exists:chitietsanpham,id_ctsp',
            'gianhap' => 'required|numeric|min:0',
            'soluong' => 'required|integer|min:1',
            'nhacungcap' => 'required|integer|exists:nhacungcap,id_nhacungcap',
        ]);
        DB::beginTransaction();
        try {
            $gianhap = new GianhapModel();
            $gianhap->id_sp = $validated['id_sanpham'];
            $gianhap->id_ctsp = $validated['chitietsanpham'];
            $gianhap->gianhap = $validated['gianhap'];
            $gianhap->soluong = $validated['soluong'];
            $gianhap->id_nhacungcap = $validated['nhacungcap'];
            $gianhap->save();
            $ctsp = ChitietsanphamModel::find($validated['chitietsanpham']);
            if ($ctsp) {
                $ctsp->soluong += $validated['soluong'];
                $ctsp->save();
            }
            DB::commit();
            return response()->json(['success' => 'Thêm giá nhập và cập nhật tồn kho thành công!']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Đã xảy ra lỗi khi thêm giá nhập!'], 500);
        }
    }
    public function xemgianhap($id)
    {

        $gianhap = GianhapModel::with(['nhacungcap', 'ctsp'])->find($id);
        if (!$gianhap) {
            return response()->json(['error' => 'Không tìm thấy giá nhập'], 404);
        }
        return response()->json([
            'id_gianhap' => $gianhap->id_gianhap,
            'id_ctsp' => $gianhap->id_ctsp,
            'id_nhacungcap' => $gianhap->id_nhacungcap,
            'gianhap' => $gianhap->gianhap,
            'soluong' => $gianhap->soluong,
        ]);
    }
    public function suagianhap(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validate dữ liệu
            $request->validate([
                'id_gianhap' => 'required|exists:gianhap,id_gianhap',
                'gianhap' => 'required|numeric|min:0',
                'soluong' => 'required|integer|min:0',
                'chitietsanpham' => 'required|exists:chitietsanpham,id_ctsp',
                'nhacungcap' => 'required|exists:nhacungcap,id_nhacungcap',
            ]);

            $gianhap = GianhapModel::findOrFail($request->id_gianhap);

            $gianhap->id_ctsp = $request->chitietsanpham;
            $gianhap->id_nhacungcap = $request->nhacungcap;
            $gianhap->gianhap = $request->gianhap;
            $gianhap->soluong = $request->soluong;
            $gianhap->save();

            // $ctsp = ChitietsanphamModel::findOrFail($request->chitietsanpham);
            // $ctsp->soluong += $request->soluong; 
            // $ctsp->save();

            DB::commit();

            return response()->json(['success' => 'Cập nhật thành công!']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Cập nhật thất bại: ' . $e->getMessage()], 500);
        }
    }
    public function xoagianhap($id)
    {
        try {
            $gianhap = GianhapModel::findOrFail($id);
            $gianhap->delete();
            return response()->json(['success' => 'Xoá giá nhập thành công!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Xoá thất bại: ' . $e->getMessage()], 500);
        }
    }
}
