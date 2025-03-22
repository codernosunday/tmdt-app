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
        $sp = SanphamModel::where('id_sp', $id_sp)->first();
        $ban = giabanModel::where('id_sp', $id_sp)->first();
        $nhap = gianhapModel::where('id_sp', $id_sp)->first();
        $ctsp = ChitietsanphamModel::where('id_sp', $id_sp)->first();
        return view('admin.chitietsanpham', compact('sp', 'ban', 'nhap', 'ctsp'));
    }

    function postQLchitietsanpham() {}

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
