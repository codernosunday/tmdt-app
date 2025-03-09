<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SanphamController extends Controller
{
    //
    public function chitietsanpham($tensp, $sp)
    {
        return view('trangsanpham', [
            'tensp' => $tensp,
            'sp' => $sp,
        ]);
    }
}
