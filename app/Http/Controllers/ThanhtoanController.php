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
use App\Models\thanhtoanModel;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Str;

class ThanhtoanController extends Controller
{
    //
    public function trangthanhtoan($ctgh)
    {
        $ctgiohang = ChitietgiohangModel::where('id_ctgh', $ctgh)->first();
        $ctsp = ChitietsanphamModel::where('id_ctsp', $ctgiohang->id_ctsp)->first();
        $sanpham = SanphamModel::where('id_sp', $ctsp->id_sp)->first();
        $giaban = giabanModel::where('id_giaban', $ctsp->id_ctsp)->first();
        $tongtien = $ctgiohang->soluong * $giaban->giaban;
        $phi = vanchuyenModel::first();
        $giohang = session("id_giohang");
        $soluong = [
            "tong" => $ctgiohang->soluong * $giaban->giaban + $phi->giaphi,
            "soluong" => $ctgiohang->soluong,
            "id_ctgh" => $ctgiohang->id_ctgh
        ];
        $phi = [
            "id_phi" => $phi->id_phi,
            "giaphi" => $phi->giaphi,
        ];
        return view('trangdathang', compact('phi', 'soluong', 'ctsp', 'giaban', 'tongtien', 'sanpham', 'giohang'));
    }

    public function thanhtoansanpham(Request $request)
    {
        try {
            $id_nd = session('id');
            do {
                $madonhang = strtoupper(Str::random(6));
            } while (hoadonModel::where('madonhang', $madonhang)->exists());
            DB::beginTransaction();
            $hoadon = hoadonModel::create([
                'id_nd' => $id_nd,
                'madonhang' => $madonhang,
                'sodt' => $request->input('sodt'),
                'hoten' => $request->input('ten'),
                'email' => $request->input('email'),
                'tongtien' => $request->input('tong'),
                'diachigiaohang' => $request->input('diachi'),
                'ghichu' => $request->input('ghichu'),
            ]);
            $id_hd = $hoadon->id_hoadon;
            thanhtoanModel::create([
                'id_thanhtoan' => $id_hd,
                'id_phi' => $request->input('id_phi'),
                'trangthaidonhang' => 'Chờ xác nhận',
                'hinhthucthanhtoan' => $request->input('hinhthuctt'),
            ]);
            $giasale = $request->input('id_giasale');
            if ($giasale < 0) {
                $giasale = null;
            }
            cthoadonModel::create([
                'id_hoadon' => $id_hd,
                'id_giasale' => $giasale,
                'id_ctsp' => $request->input('id_ctsp'),
                'thanhtien' => $request->input('tong'),
                'soluong' => $request->input('soluong'),
            ]);
            DB::commit();
            return response()->json([
                'message' => 'Đặt hàng thành công',
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    //giam gia sale
    public function sdMagiamgia(Request $request)
    {
        try {
            $ma = $request->input('magiamgia');
            $magiamgia = giasaleModel::where('magiamgia', $ma)->first();
            if ($magiamgia) {
                return response()->json([
                    'dieukien' => true,
                    'id_magiamgia' => $magiamgia->id_giasale,
                    'giasale' => $magiamgia->giasale,
                    'ten' => $magiamgia->ten,
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    //don hang
    public function theodoidonhang()
    {
        return view('theodoidonhang');
    }
}
