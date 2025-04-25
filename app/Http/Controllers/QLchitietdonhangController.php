<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\ChitietmuaModel;
use App\Models\SanphamModel;
use App\Models\hoadonModel;
use Barryvdh\DomPDF\Facade\Pdf;


class QLchitietdonhangController extends Controller
{
    function pagesQLchitietdonhang($id)
    {
        $chitietdonhang = ChitietmuaModel::where('id_hoadon', $id)->with(['chitietsanpham'])->get();
        $donhang = hoadonModel::where('id_hoadon', $id)->first();
        $chitietdonhang = $chitietdonhang->map(function ($item) {
            $sanpham = SanphamModel::where('id_sp', $item['chitietsanpham']['id_sp'])->first();

            return array_merge($item->toArray(), [
                'thongtinsp' => $sanpham ? $sanpham->toArray() : null,
            ]);
        });

        $data = collect([
            'donhang' => $donhang,
            'chitietdonhang' => $chitietdonhang
        ]);

        return view('admin.quanlychitietdonhang', compact('data'));
    }

    function createPDF(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];

        $chitietdonhang = ChitietmuaModel::where('id_hoadon', $id)->with(['chitietsanpham'])->get();
        $donhang = hoadonModel::where('id_hoadon', $id)->first();

        $total = $chitietdonhang->sum(function ($item) {
            return $item['soluong'] * $item['thanhtien'];
        });

        $chitietdonhang = $chitietdonhang->map(function ($item) {
            $sanpham = SanphamModel::where('id_sp', $item['chitietsanpham']['id_sp'])->first();

            return array_merge($item->toArray(), [
                'thongtinsp' => $sanpham ? $sanpham->toArray() : null,
            ]);
        });

        $data = [
            'donhang' => $donhang,
            'chitietdonhang' => $chitietdonhang,
            'tongtien' => $total,
        ];

        $pdf = Pdf::loadView('template.donhangPDF', ['data' => $data])->setPaper('A4');
        return $pdf->download('hoa-don.pdf');
    }
}
