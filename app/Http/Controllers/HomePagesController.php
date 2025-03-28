<?php

namespace App\Http\Controllers;

use App\Models\SanphamModel;
use Illuminate\Http\Request;

class HomePagesController extends Controller
{
    //
    public function home()
    {
        return view('home');
    }

    public function locSPtheoDanhmuc($danhmuc)
    {
        if ($danhmuc != 0) {
            $sp = SanphamModel::where('id_ctdm', $danhmuc)->limit(8)->get();;
        } else {
            $sp = SanphamModel::limit(8)->get();
        }
        return view('components.sanpham', compact('sp'));
    }
}
