<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', auth()->id())->with('product')->get();
        return view('wishlist.index', compact('wishlist'));
    }

    public function add($product_id)
    {
        Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $product_id
        ]);
        return redirect()->back()->with('success', 'Product added to wishlist');
    }

    public function remove($product_id)
    {
        Wishlist::where('user_id', auth()->id())
            ->where('product_id', $product_id)
            ->delete();
        return redirect()->back()->with('success', 'Product removed from wishlist');
    }
}
