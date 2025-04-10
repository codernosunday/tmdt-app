<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show($id_ctdm)
    {
        // Tìm danh mục theo ID
        $category = Category::findOrFail($id_ctdm);

        // Lấy danh sách sản phẩm thuộc danh mục
        $products = $category->products;

        // Truyền dữ liệu sang view
        return view('categories.show', compact('category', 'products'));
    }
}
