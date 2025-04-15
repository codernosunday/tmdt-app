<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanphamModel;
use App\Models\ChitietsanphamModel;
use App\Models\ChitietgiohangModel;
use App\Models\giabanModel;
use Illuminate\Support\Facades\DB;
use Exception;

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
        $giohang = session("id_giohang");
        $soluong = [
            "soluong" => $ctgiohang->soluong,
            "id_ctgh" => $ctgiohang->id_ctgh
        ];
        return view('trangdathang', compact('soluong', 'ctsp', 'giaban', 'tongtien', 'sanpham', 'giohang'));
    }

    public function thanhtoansanpham($ctgh)
    {
        try {
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function theodoidonhang()
    {
        return view('theodoidonhang');
    }
}
