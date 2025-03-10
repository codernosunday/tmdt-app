<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanphamModel;

class QLsanphamComtroller extends Controller
{
    //
    function pagesQLsanpham()
    {
        $sp = SanphamModel::all();
        return view('admin.quanlysanpham', compact('sp'));
    }
    function pagesQLchitietsanpham($id_sp)
    {
        $sp = SanphamModel::limit(8)->get();
        return view('admin.chitietsanpham', compact('sp'));
    }
    function postQLchitietsanpham() {}
}
