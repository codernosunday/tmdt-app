<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hoadonModel;
use Illuminate\Support\Collection;

class QLdonhangController extends Controller
{
    function pagesQLdonhang($select)
    {

        $trangthai = collect([
            'choxacnhan' => 'chờ xác nhận',
            'daxacnhan' => 'đã xác nhận',
            'danggiaohang' => 'đang giao hàng',
            'dagiohang' => 'đã giao hàng',
            'dahuy' => 'đã hủy'
        ]);

        if($select == 'all'){
            $danhsachdonhang = hoadonModel::with(['vanchuyen', 'nguoidung', 'hinhthuc'])->get()->toArray();
            return view('admin.quanlydonhang', compact('danhsachdonhang'));
        }else if($trangthai->has($select)){
            $danhsachdonhang = hoadonModel::where("trangthaidonhang", $trangthai[$select])->with(['vanchuyen', 'nguoidung', 'hinhthuc'])->get()->toArray();
            return view('admin.quanlydonhang', compact('danhsachdonhang'));

        }else{
            dd('không tìm thấy trạng thái đơn hàng');
        }
    }
}
