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
use App\Models\ThuoctinhspModel;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Str;

class ThanhtoanController extends Controller
{
    //
    public function trangthanhtoan($id, $sl = null)
    {
        $ctgiohang = ChitietgiohangModel::where('id_ctgh', $id)->first();
        if ($ctgiohang) {
            $ctsp = ChitietsanphamModel::where('id_ctsp', $ctgiohang->id_ctsp)->first();
            $thuoctinh = ThuoctinhspModel::where('id_thuoctinh', $ctsp->id_thuoctinh)->first();
            $sanpham = SanphamModel::where('id_sp', $ctsp->id_sp)->first();
            $giaban = giabanModel::where('id_giaban', $ctsp->id_ctsp)->first();
            $tongtien = $ctgiohang->soluong * $giaban->giaban;
            $phi = vanchuyenModel::first();
            $giohang = session("id_giohang");
            $soluong = [
                "tong" => $ctgiohang->soluong * $giaban->giaban,
                "soluong" => $ctgiohang->soluong,
                "id_ctgh" => $ctgiohang->id_ctgh
            ];
            $phi = [
                "idphi" => $phi->id_phi,
                "giaphi" => $phi->giaphi,
            ];
            return view('trangdathang', compact('phi', 'soluong', 'ctsp', 'giaban', 'tongtien', 'sanpham', 'giohang', 'thuoctinh'));
        } else {
            $soluong = 1;
            if ($sl) {
                $soluong = (int) $sl;
            }
            $ctsp = ChitietsanphamModel::where('id_ctsp', $id)->first();
            $thuoctinh = ThuoctinhspModel::where('id_thuoctinh', $ctsp->id_thuoctinh)->first();
            $sanpham = SanphamModel::where('id_sp', $ctsp->id_sp)->first();
            $giaban = giabanModel::where('id_giaban', $ctsp->id_ctsp)->first();
            $tongtien = $soluong * $giaban->giaban;
            $phi = vanchuyenModel::first();
            $giohang = session("id_giohang");
            $soluong = [
                "tong" => $soluong * $giaban->giaban,
                "soluong" => $soluong,
                "id_ctgh" => null
            ];
            $phi = [
                "idphi" => $phi->id_phi,
                "giaphi" => $phi->giaphi,
            ];
            return view('trangdathang', compact('phi', 'soluong', 'ctsp', 'giaban', 'tongtien', 'sanpham', 'giohang', 'thuoctinh'));
        }
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
                'id_phi' => $request->input('id_phi'),
                'madonhang' => $madonhang,
                'sodt' => $request->input('sodt'),
                'hoten' => $request->input('ten'),
                'email' => $request->input('email'),
                'diachigiaohang' => $request->input('diachi'),
                'ghichu' => $request->input('ghichu'),
                'trangthaidonhang' => 'Chờ xác nhận',
                'tontien' => $request->input('tong'),
                'hinhthucthanhtoan' => $request->input('hinhthuctt'),
            ]);
            $id_hd = $hoadon->id_hoadon;
            thanhtoanModel::create([
                'id_thanhtoan' => $id_hd,
                'trangthaithanhtoan' => false,
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
            $capnhat = $request->input('id_ctgh');
            if ($capnhat) {
                ChitietgiohangModel::where('id_ctgh', $capnhat)->delete();
            }
            DB::commit();
            return response()->json([
                'dieukien' => true,
                'message' => 'Đặt hàng thành công mã đơn của bạn là ' . $madonhang . ' hãy lưu nó để theo dõi lịch sử đơn hàng',
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'dieukien' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    //giam gia sale
    public function sdMagiamgia(Request $request)
    {
        try {
            $ma = $request->input('magiamgia');
            $magiamgia = giasaleModel::where('magiamgia', $ma)
                ->where('trangthai', true)
                ->first();
            if ($magiamgia) {
                return response()->json([
                    'dieukien' => true,
                    'id_magiamgia' => $magiamgia->id_giasale,
                    'giasale' => $magiamgia->giasale,
                    'ten' => $magiamgia->ten,
                ], 200);
            } else {
                return response()->json([
                    'dieukien' => false,
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
    public function kiemtradonhang($madh)
    {
        $hoadon = hoadonModel::where('madonhang', $madh)->first();
        if (!$hoadon) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không tìm thấy đơn hàng.'
            ], 404);
        }

        $cthd = cthoadonModel::where('id_hoadon', $hoadon->id_hoadon)->first();
        if (!$cthd) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không tìm thấy chi tiết hóa đơn.'
            ], 404);
        }

        $tongGia = cthoadonModel::where('id_hoadon', $hoadon->id_hoadon)->sum('thanhtien');
        $ctsp = ChitietsanphamModel::where('id_ctsp', $cthd->id_ctsp)->first();
        $thuoctinh = ThuoctinhspModel::where('id_thuoctinh', $ctsp->id_thuoctinh)->first();
        $sanpham = SanphamModel::where('id_sp', $ctsp->id_sp)->first();
        $phi = vanchuyenModel::where('id_phi', $hoadon->id_phi)->first();
        $gia = $cthd->thanhtien / $cthd->soluong;
        $giasale = 0;
        if ($cthd->id_giasale) {
            $sale = giasaleModel::where('id_giasale', $cthd->id_giasale)->first();
            $giasale = $sale->giasale;
        }
        $tamtinh = $tongGia;
        $tongtien = $tamtinh + $phi->giaphi - $giasale;
        $data = [
            "madh" => $hoadon->madonhang,
            "ngaydat" => $hoadon->created_at->format('d/m/Y H:i'),
            "trangthai" => $hoadon->trangthaidonhang,
            "tongtien" => $tongtien,
            "phuongthuc" => $hoadon->hinhthucthanhtoan,
            "hoten" => $hoadon->hoten,
            "email" => $hoadon->email,
            "sodt" => $hoadon->sodt,
            "diachi" => $hoadon->diachigiaohang,
            "ngay" => $hoadon->updated_at->format('d/m/Y H:i'),
            "anhsp" => $sanpham->anhbase64,
            "tensp" => $sanpham->tensp,
            "mau" => $thuoctinh->mau,
            "soluong" => $cthd->soluong,
            "gia" => $gia,
            "giasale" => $giasale,
            "thanhtiencthd" => $cthd->thanhtien,
            "tamtinh" => $tamtinh,
            "phivanchuyen" => $phi->giaphi,
        ];
        return response()->json([
            'status' => 'success',
            'data' => view('components.thongtindonhang', compact('data'))->render()
        ]);
    }
}
