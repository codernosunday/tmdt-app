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
        // Fetch the product with its details and price
        $sanpham = SanphamModel::with(['giaban', 'chitietsp'])->findOrFail($id_sp);
        
        // Validate if the product name in URL matches the actual product name
        if ($tensp !== $sanpham->tensp) {
            abort(404);
        }

        // Get related products from the same category
        $relatedProducts = SanphamModel::where('id_ctdm', $sanpham->id_ctdm)
            ->where('id_sp', '!=', $id_sp)
            ->with('giaban')
            ->limit(4)
            ->get();

        return view('trangsanpham', compact('sanpham', 'relatedProducts'));
    }
}