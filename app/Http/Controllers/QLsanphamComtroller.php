<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QLsanphamComtroller extends Controller
{
    //
    function pagesQLsanpham()
    {
        return view('admin.quanlysanpham');
    }
}
