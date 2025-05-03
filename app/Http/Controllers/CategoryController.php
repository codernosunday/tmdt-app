<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SanphamModel;
use App\Models\ChitietsanphamModel;
use App\Models\giabanModel;

class CategoryController extends Controller
{
    public function show($id_ctdm)
    {
        // Tìm danh mục theo ID
        $category = Category::findOrFail($id_ctdm);

        $sanpham = SanphamModel::where('id_ctdm', $id_ctdm)->get();

        $thongtinsanpham = $sanpham->map(function ($item) {
            $chitietsanpham = ChitietsanphamModel::where('id_sp', $item['id_sp'])->first();
            $giasanpham = giabanModel::where('id_sp', $item['id_sp'])->first();

            return array_merge($item->toArray(), [
                'chitietsanpham' => $chitietsanpham ? $chitietsanpham->toArray() : null,
                'giaban' => $giasanpham ? $giasanpham->toArray() : null,
            ]);
        });

        // Truyền dữ liệu sang view
        return view('categories.show', compact('category', 'thongtinsanpham'));
    }
}
