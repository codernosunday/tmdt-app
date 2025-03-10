<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function admin(){
        return view('admin.layout-admin');
    }
}
