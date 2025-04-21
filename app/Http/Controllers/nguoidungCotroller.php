<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NguoidungModel;
use Exception;

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
    public function capnhatthongtin(Request $request)
    {
        try {
            $info = $request->input('field');
            $value = $request->input('value');
            $nguoidung = NguoidungModel::find(session('id'));
            if (!$nguoidung) {
                return response()->json([
                    'success' => false,
                    'message' => 'Người dùng không tồn tại.',
                ], 404);
            }
            if ($info == 'phone') {
                $nguoidung->update([
                    'soDT' => $value,
                ]);
            }
            if ($info == 'name') {
                $nguoidung->update([
                    'hovaten' => $value,
                ]);
            }
            if ($info == 'email') {
                $nguoidung->update([
                    'mail' => $value,
                ]);
            }
            if ($info == 'dob') {
                $nguoidung->update([
                    'ngaysinh' => $value,
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thành công',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi hệ thống!',
                'errors' => [
                    'system' => 'Lỗi hệ thống khi cập nhật.'
                ]
            ], 500);
        }
    }
}
