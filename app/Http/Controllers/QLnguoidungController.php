<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NguoidungModel;

class QLnguoidungController extends Controller
{
    function pagesQLnguoidung()
    {
        $danhsachnguoidung = NguoidungModel::all();
        return view('admin.quanlynguoidung', compact('danhsachnguoidung'));
    }
}
