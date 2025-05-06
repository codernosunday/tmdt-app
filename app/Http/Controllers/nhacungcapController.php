<?php

namespace App\Http\Controllers;

use App\Models\nhacungcapModel;
use Exception;
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
}
