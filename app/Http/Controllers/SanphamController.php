<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChitietsanphamModel;
use App\Models\giabanModel;
use App\Models\gianhapModel;
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
    public function xemctsp($ctsp)
    {
        $ctsp = ChitietsanphamModel::where('id_ctsp', $ctsp)->first();
        if ($ctsp) {
            $giaban = giabanModel::where('id_ctsp', $ctsp->id_ctsp)->first();
            $gianhap = gianhapModel::where('id_ctsp', $ctsp->id_ctsp)->first();
            return response()->json([
                'giaban' => $giaban->giaban ?? 0,
                'soluong' => $gianhap->soluong ?? 0,
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false
            ], 400);
        }
    }
}
