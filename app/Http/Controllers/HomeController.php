<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanphamModel;

class HomeController extends Controller
{
    public function index()
    {
        $products = SanphamModel::with('giaban')->paginate(8);
        return view('home', compact('products'));
    }

    public function product()
    {
        $products = SanphamModel::with('giaban')->paginate(8);
        return view('home', compact('products'));
    }
}