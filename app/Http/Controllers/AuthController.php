<?php

namespace App\Http\Controllers;

use App\Models\SanphamModel;
use Illuminate\Http\Request;
use App\Models\NguoidungModel;

use function Ramsey\Uuid\v1;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function verifyPage()
    {
        return view('auth.verify');
    }

    public function register(Request $request)
    {
        if (NguoidungModel::where('mail', $request->email)->exists()) {
            return redirect()->back()->with('error','Email đã tồn tại, vui lòng nhập email mới!');
        }

        // $user = NguoidungModel::create([
        //     'mail' => $request->email,
        //     'username' => $request->email,
        //     'password' => "",
        //     'maxacnhan' => $this->randomString(),
        // ]);

        $MailService = new MailController();
        $MailService->basic_email($request->email, $this->randomString());

        return redirect('verify')->with('success', 'Đăng ký thành công. Vui lòng kiểm tra email để xác nhận tài khoản.');
    }

        public function verifyCode(Request $request)
    {
       
    }

    public function randomString()
    {
        return $test = sprintf('%06d', rand(1, 1000000));
    }
}
