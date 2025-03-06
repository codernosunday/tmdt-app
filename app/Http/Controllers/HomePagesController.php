<?php

namespace App\Http\Controllers;

use App\Models\SanphamModel;
use Illuminate\Http\Request;

class HomePagesController extends Controller
{
    //
    public function home()
    {
        return view('home');
    }

    public function loginPage()
    {
        return view('auth.login');
    }
    public function locSPtheoDanhmuc($danhmuc)
    {
        $sp = SanphamModel::find($danhmuc);
        if ($sp->count() > 8) {
            $sp = $sp->paginate(8);
        }
        return view('components.listsanpham', compact('sp'));
    }
}
