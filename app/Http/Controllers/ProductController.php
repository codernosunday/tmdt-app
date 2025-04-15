<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // ...existing code...

    public function show($tensp, $id_sp)
    {
        $product = Product::findOrFail($id_sp);
        return view('products.show', compact('product'));
    }

    // ...existing code...
}