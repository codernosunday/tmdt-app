<?php

namespace App\Http\Controllers;

use App\Models\SanphamModel;
use App\Models\ChitietsanphamModel;
use App\Models\giabanModel;
use Illuminate\Http\Request;


class SanphamController extends Controller
{
    public function chitietsanpham($tensp, $id_sp)
    {
        $sp = SanphamModel::where('id_sp', $sp)->firstOrFail();

        $ctsp = ChitietsanphamModel::where('id_sp', $sp->id_sp)->first();

        $giaban = giabanModel::where('id_sp', $sp->id_sp)->latest('updated_at')->first();

        return view('trangsanpham', [
            'tensp' => $tensp,
            'sp' => $sp,
            'ctsp' => $ctsp,
            'giaban' => $giaban
        ]);
    }
}