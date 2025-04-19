<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChitietgiohangModel;
use App\Models\GioHangModel;
use App\Models\SanphamModel;
use App\Models\ChitietsanphamModel;

class CartController extends Controller
{
    //
    public function cart()
    {
        $cartItems = DB::table('chitietgiohang')
            ->join('chitietsanpham', 'chitietgiohang.id_ctsp', '=', 'chitietsanpham.id_ctsp')
            ->join('sanpham', 'chitietsanpham.id_sp', '=', 'sanpham.id_sp')
            ->join('giaban', 'chitietsanpham.id_ctsp', '=', 'giaban.id_ctsp')
            ->leftJoin('thuoctinhsanpham', 'chitietsanpham.id_thuoctinh', '=', 'thuoctinhsanpham.id_thuoctinh') // dùng leftJoin
            ->select(
                'chitietgiohang.*',
                'sanpham.tensp',
                'sanpham.anhbase64',
                'thuoctinhsanpham.mau',
                'giaban.giaban',
                DB::raw('chitietgiohang.soluong * giaban.giaban as thanh_tien')
            )
            ->where('chitietgiohang.id_giohang', session("id_giohang"))
            ->get();
        // $sanpham= SanphamModel::
        return view('cart');
    }

    public function addToCart(Request $request)
    {
        $giohang = GiohangModel::where('id_giohang', session("id_giohang"))->first();

        if ($giohang) {
            $sanpham = SanphamModel::where('id_sp', $request->id_sp)->first();
            $chitietgiohang = ChitietgiohangModel::where('id_giohang', $giohang->id_giohang)->where('id_sp', $sanpham->id_sp)->first();

            if ($sanpham && $chitietgiohang) {
                $soluong = $chitietgiohang->soluong ? $chitietgiohang->soluong + 1 : 1;
                $chitietgiohang::where('id_ctgh', $chitietgiohang->id_ctgh)->update([
                    'soluong' => $soluong
                ]);
            } else {
                $id_ctsp = ChitietsanphamModel::where('id_sp', $request->id_sp)->first()->id_ctsp;
                ChitietgiohangModel::create([
                    'id_giohang' => session('id_giohang'),
                    'id_ctsp' => $id_ctsp,
                    'id_sp' => $request->id_sp,
                    'soluong' => 1,
                ]);
            }

            return response()->json([
                'message' => 'Thêm vào giỏ hàng thành công'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Không thể thêm vào giỏ hàng',
            ], 400);
        }
    }
}
