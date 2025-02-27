<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePagesController extends Controller
{
    //
    public function homepage()
    {
        return view('home');
        // return "hello";
    }
}
