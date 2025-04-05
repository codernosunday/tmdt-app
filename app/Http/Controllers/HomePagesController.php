<?php

namespace App\Http\Controllers;

use App\Models\SanphamModel;
use App\Models\DanhmucconModel;
use Illuminate\Http\Request;

class HomePagesController extends Controller
{
    public function home()
    {
        $products = SanphamModel::with('giaban')->paginate(8);
        return view('home', compact('products'));
    }

    public function services(){
        return view('service');
    }
    
    public function contact(){
        return view('contact');
    }

    public function aboutus(){
        return view('aboutus');
    }

    public function locSPtheoDanhmuc($slug)
    {
        // Fetch the category by slug
        $danhmuc = DanhmucconModel::where('slug', $slug)->first();

        if (!$danhmuc) {
            abort(404, 'Danh mục không tồn tại.');
        }

        // Fetch products belonging to the category
        $sp = SanphamModel::where('id_ctdm', $danhmuc->id_ctdm)->paginate(8);

        // Return the view with the products
        return view('components.sanpham', compact('sp'));
    }
}
