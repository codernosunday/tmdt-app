<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\ChitietmuaModel;
use App\Models\SanphamModel;

class QLchitietdonhangController extends Controller
{
    function pagesQLchitietdonhang($id)
    {  
        $chitietdonhang = ChitietmuaModel::where('id_hoadon', $id)->with(['chitietsanpham'])->get();
        $chitietdonhang = $chitietdonhang->map(function ($item) {
            $sanpham = SanphamModel::where('id_sp', $item['chitietsanpham']['id_sp'])->first();
        
            return array_merge($item->toArray(), [
                'thongtinsp' => $sanpham ? $sanpham->toArray() : null,
            ]);
        });

        //dd($chitietdonhang);
        
        return view('admin.quanlychitietdonhang', compact('chitietdonhang'));
    }
}
