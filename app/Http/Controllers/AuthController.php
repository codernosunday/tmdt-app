<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\NguoidungModel;
use Illuminate\Support\Facades\Auth;

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

    public function login(Request $request)
    {
         // Xác thực dữ liệu đầu vào
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Kiểm tra thông tin đăng nhập
        $credentials = [
            'mail' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công, chuyển hướng tới dashboard
            dd($request->input('email'), $request->input('password'), "Đăng nhập thành công!");
        }else{
            dd($request->input('email'), $request->input('password'), "Đăng nhập thất bại!");
        }

        // Đăng nhập thất bại, quay lại trang login
        // return redirect()->back()->with('error', 'Email hoặc mật khẩu không đúng.');
    }

    public function register(Request $request)
    {
        if (NguoidungModel::where('mail', $request->email)->exists()) {
            return redirect()->back()
                ->with('error','Email đã tồn tại, vui lòng nhập email mới!')
                ->with('email', $request->email);
        }

        $code = $this->randomString();

        $user = NguoidungModel::create([
            'mail' => $request->email,
            'username' => $request->email,
            'password' => "",
            'maxacnhan' => $code,
        ]);

        $MailService = new MailController();
        $MailService->basic_email($request->email, $code);

        return redirect('verify')
            ->with('success', 'Đăng ký thành công. Vui lòng kiểm tra email để xác nhận tài khoản.')
            ->with('email', $request->email);
    }

    public function verify(Request $request)
    {
        $code = $request->number_1 . 
                $request->number_2 . 
                $request->number_3 . 
                $request->number_4 . 
                $request->number_5 . 
                $request->number_6;
        $email = $request->email;

        $user = NguoidungModel::where('mail', $email)->where('maxacnhan',$code)->first();

        if($user) {
            return redirect('password')
                ->with('success', 'Xác nhận thành công. Hãy tạo mật khẩu để tiếp tục!')
                ->with('email', $request->email);
        }else{
            return redirect()->back()->with('error','Mã xác nhận không chính xác, vui lòng thử lại')
            ->with('email', $request->email);
        }
    }

    public function password(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;

        if($password != $password_confirmation) {
            return redirect()->back()
                ->with('error','Xác nhận mật khẩu không khớp, vui lòng thử lại!')
                ->with('email', $request->email);
        }

        $user = NguoidungModel::where('mail', $email)->update([
            'password' => bcrypt($password)
        ]);

        if($user) {
            return redirect('login')
                ->with('success', 'Tạo mật khẩu thành công. Hãy đăng nhập ngay!');
        }else{
            return redirect()->back()->with('error','Tạo mật khẩu không thành công, vui lòng thử lại')
            ->with('email', $email);
        }
    }

    public function passwordPage()
    {
        return view('auth.password');
    }

    public function randomString()
    {
        return sprintf('%06d', rand(1, 1000000));
    }
}
