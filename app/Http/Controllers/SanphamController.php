<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChitietsanphamModel;
use App\Models\giabanModel;
use App\Models\SanphamModel;

class SanphamController extends Controller
{
    //
    public function chitietsanpham($tensp, $sp)
    {
        $sp = SanphamModel::where('id_sp', $sp)->firstOrFail();
        $ctsp = ChitietsanphamModel::where('id_sp', $sp->id_sp)->first();
        $giaban = giabanModel::where('id_sp', $sp->id_sp)->latest('updated_at')->first();
        $dschitiet = ChitietsanphamModel::with(['thuoctinh', 'giaban'])->where('id_sp', $sp->id_sp)->get();
        return view('trangsanpham', compact('sp', 'ctsp', 'giaban', 'dschitiet'));
    }
}
