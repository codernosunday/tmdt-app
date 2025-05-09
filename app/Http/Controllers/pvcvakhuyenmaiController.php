<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SanphamModel;
use App\Models\ChitietsanphamModel;
use App\Models\ChitietgiohangModel;
use App\Models\giabanModel;
use App\Models\giasaleModel;
use App\Models\vanchuyenModel;
use App\Models\hoadonModel;
use App\Models\cthoadonModel;
use App\Models\DanhmucconModel;
use App\Models\thanhtoanModel;
use App\Models\ThuoctinhspModel;

class pvcvakhuyenmaiController extends Controller
{
    public function qlphivanchuyen()
    {
        $shippingFees = vanchuyenModel::all();
        return view('admin.qlphivanchuyen', compact('shippingFees'));
    }

    public function themphivanchuyen(Request $request)
    {
        $validated = $request->validate([
            'khuvuc' => 'required|string|max:255',
            'phuongthuc' => 'required|string|max:255',
            'giaphi' => 'required|numeric|min:0',
            'ghichu' => 'nullable|string|max:500',
        ]);

        vanchuyenModel::create($validated);

        return response()->json(['message' => 'Thêm phí vận chuyển thành công']);
    }

    public function timvanchuyen($id)
    {
        $shippingFee = vanchuyenModel::find($id);
        if (!$shippingFee) {
            return response()->json(['message' => 'Không tìm thấy phí vận chuyển'], 404);
        }
        return response()->json($shippingFee);
    }

    public function capnhatphivanchuyen(Request $request, $id)
    {
        $shippingFee = vanchuyenModel::find($id);
        if (!$shippingFee) {
            return response()->json(['message' => 'Không tìm thấy phí vận chuyển'], 404);
        }

        $validated = $request->validate([
            'khuvuc' => 'required|string|max:255',
            'phuongthuc' => 'required|string|max:255',
            'giaphi' => 'required|numeric|min:0',
            'ghichu' => 'nullable|string|max:500',
        ]);

        $shippingFee->update($validated);

        return response()->json(['message' => 'Cập nhật phí vận chuyển thành công']);
    }

    public function xoaphivanchuyen($id)
    {
        $shippingFee = vanchuyenModel::find($id);
        if (!$shippingFee) {
            return response()->json(['message' => 'Không tìm thấy phí vận chuyển'], 404);
        }

        if (method_exists($shippingFee, 'hoadon') && $shippingFee->hoadon()->count() > 0) {
            return response()->json(['message' => 'Không thể xóa vì có hóa đơn liên quan'], 400);
        }

        $shippingFee->delete();
        return response()->json(['message' => 'Xóa phí vận chuyển thành công']);
    }
    //khuyen mai
    public function trangsale()
    {
        $giasales = giasaleModel::all();
        $danhmuc = DanhmucconModel::where('trangthai', 'Hiện')->get();
        return view('admin.qlsale', compact('giasales', 'danhmuc'));
    }

    public function themgiasale(Request $request)
    {
        $validated = $request->validate([
            'ten' => 'required|string|max:255',
            'magiamgia' => 'required|string|max:255',
            'giasale' => 'required|numeric|min:0',
            'ketthuc' => 'required|date',
            'trangthai' => 'nullable|boolean'
        ]);

        // Gán mặc định trạng thái là false nếu không gửi
        $validated['trangthai'] = $request->has('trangthai') ? true : false;

        giasaleModel::create($validated);

        return response()->json(['success' => 'Thêm chương trình khuyến mãi thành công']);
    }


    public function xemgiasale($id)
    {
        $giasale = giasaleModel::findOrFail($id);
        return response()->json($giasale);
    }

    public function capnhatgiasale(Request $request, $id)
    {
        $request->validate([
            'ten' => 'required|string|max:255',
            'magiamgia' => 'required|string|max:255',
            'giasale' => 'required|numeric|min:0',
            'ketthuc' => 'required|date',
            'hoatdong' => 'nullable|boolean'
        ]);

        $giasale = giasaleModel::findOrFail($id);

        // Chuyển request hoatdong thành trangthai
        $data = $request->except('hoatdong');
        $data['trangthai'] = $request->has('hoatdong') ? true : false;

        $giasale->update($data);

        return response()->json(['success' => 'Cập nhật chương trình khuyến mãi thành công']);
    }



    public function xoagiasale($id)
    {
        $giasale = giasaleModel::findOrFail($id);

        // Kiểm tra xem chương trình khuyến mãi có liên quan đến sản phẩm nào không
        if ($giasale->giaban()->count() > 0) {
            return response()->json(['error' => 'Không thể xóa vì có sản phẩm liên quan'], 400);
        }

        $giasale->delete();

        return response()->json(['success' => 'Xóa chương trình khuyến mãi thành công']);
    }
}
