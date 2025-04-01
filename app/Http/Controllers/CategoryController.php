<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\DanhmucconModel;
use App\Models\SanphamModel;

class CategoryController extends Controller
{
    public function show($id_ctdm)
    {
        // Fetch the category by id_ctdm
        $category = DanhmucconModel::findOrFail($id_ctdm);

        // Fetch products belonging to the category
        $products = SanphamModel::where('id_ctdm', $id_ctdm)->paginate(8);

        // Return the view with the category and products
        return view('category.show', compact('category', 'products'));
    }
}
