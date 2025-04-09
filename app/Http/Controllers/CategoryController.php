<?php
namespace App\Http\Controllers;

use App\Models\Category; // Đảm bảo namespace đúng
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($id_ctdm)
    {
        $category = Category::findOrFail($id_ctdm);
        $products = $category->products; // Quan hệ products đã được định nghĩa trong model Category
        return view('categories.show', compact('category', 'products'));
    }
}
