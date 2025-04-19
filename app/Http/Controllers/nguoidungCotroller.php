<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NguoidungModel;

class nguoidungCotroller extends Controller
{
    //
    public function trangnguoidung()
    {
        $id = session('id');
        if (!$id) {
            return redirect('login');
        }
        $nguoidung = NguoidungModel::where('id_nd', $id)->first();
        $data = [
            "hoten" => $nguoidung->hovaten,
            "email" => $nguoidung->mail,
            "sodt" => $nguoidung->soDT,
            "ngaysinh" => $nguoidung->ngaysinh,
            "tinhtrangtk" => $nguoidung->tinhtrantk
        ];
        return view('nguoidung', compact('data'));
    }
}
