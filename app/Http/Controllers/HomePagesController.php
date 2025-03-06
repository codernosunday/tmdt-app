<?php

namespace App\Http\Controllers;

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
}
