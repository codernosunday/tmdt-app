<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NguoidungModel;
use App\Models\GiohangModel;
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

    public function forgotPage()
    {
        return view('auth.forgotPassword');
    }

    public function forgotPasswordChangePage()
    {
        return view('auth.forgotPasswordChange');
    }
    public function forgotPasswordVerifyPage()
    {
        return view('auth.forgotPasswordVerify');
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
            $user = Auth::user();

            $id_giohang = GiohangModel::where('id_giohang', $user->id_nd)->first()->id_giohang;

            session([
                'id' => $user->id_nd,
                'username' => $user->username,
                'email' => $user->mail,
                'sodt' => $user->soDT,
                'id_giohang' => $id_giohang,
            ]);

            if($user->quyentruycap === "admin"){
                return redirect('administrator/quanlysanpham');
            }else{
                return redirect('shop');
            }
        } else {
            return redirect()->back()
                ->with('error', 'Đăng nhập thất bại,email hoặc mật khẩu không đúng.');
        }

        // Đăng nhập thất bại, quay lại trang login
        // return redirect()->back()->with('error', 'Email hoặc mật khẩu không đúng.');
    }

    public function forgot(Request $request)
    {
        if (!NguoidungModel::where('mail', $request->email)->exists()) {
            return redirect()->back()
                ->with('error', 'Email chưa được đăng ký, vui lòng kiểm tra lại!')
                ->with('email', $request->email);
        }

        $code = $this->randomString();

        $user = NguoidungModel::where('mail', $request->email)->update([
            'maxacnhan' => $code
        ]);

        $MailService = new MailController();
        $MailService->basic_email($request->email, $code);

        return redirect('forgotPasswordVerify')
            ->with('success', 'Thành công, vui lòng kiểm tra email để xác nhận tài khoản.')
            ->with('email', $request->email);
    }

    public function forgotPasswordVerify(Request $request)
    {
        $code = $request->number_1 .
            $request->number_2 .
            $request->number_3 .
            $request->number_4 .
            $request->number_5 .
            $request->number_6;
        $email = $request->email;

        $user = NguoidungModel::where('mail', $email)->where('maxacnhan', $code)->first();

        if ($user) {
            return redirect('forgotPasswordChange')
                ->with('success', 'Xác nhận thành công. Hãy tạo mật khẩu mới!')
                ->with('email', $request->email);
        } else {
            return redirect()->back()->with('error', 'Mã xác nhận không chính xác, vui lòng thử lại')
                ->with('email', $request->email);
        }
    }

    public function forgotPasswordChange(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;

        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/', $password)) {
            return redirect()->back()->with('error', 'Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt!')
                ->with('email', $email);
        }

        if ($password != $password_confirmation) {
            return redirect()->back()
                ->with('error', 'Xác nhận mật khẩu không khớp, vui lòng thử lại!')
                ->with('email', $request->email);
        }

        $user = NguoidungModel::where('mail', $email)->update([
            'password' => bcrypt($password)
        ]);

        if ($user) {
            return redirect('login')
                ->with('success', 'Thay đổi mật khẩu thành công. Hãy đăng nhập ngay!');
        } else {
            return redirect()->back()->with('error', 'Thay đổi mật khẩu không thành công, vui lòng thử lại')
                ->with('email', $email);
        }
    }


    public function register(Request $request)
    {
        $user = NguoidungModel::where('mail', $request->email);
        $code = $this->randomString();
        if ($user->exists()) {
            if($user->where('password', null)) {
                $MailService = new MailController();
                $MailService->basic_email($request->email, $code);

                NguoidungModel::where('mail', $request->email)->update([
                    'maxacnhan' => $code
                ]);

                return redirect('verify')
                    ->with('success', 'Email đã tồn tại nhưng chưa được kích hoạt, hãy lấy mã và kích hoạt tài khoản')
                    ->with('email', $request->email);

            }else{
                return redirect()->back()
                ->with('error', 'Email đã tồn tại, vui lòng nhập email mới!')
                ->with('email', $request->email);
            }
        }

        $user = NguoidungModel::create([
            'mail' => $request->email,
            'username' => $request->email,
            'password' => "",
            'maxacnhan' => $code,
            'quyentruycap' => "user"
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

        $user = NguoidungModel::where('mail', $email)->where('maxacnhan', $code)->first();

        if ($user) {
            return redirect('password')
                ->with('success', 'Xác nhận thành công. Hãy tạo mật khẩu để tiếp tục!')
                ->with('email', $request->email);
        } else {
            return redirect()->back()->with('error', 'Mã xác nhận không chính xác, vui lòng thử lại')
                ->with('email', $request->email);
        }
    }

    public function password(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;

        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/', $password)) {
            return redirect()->back()->with('error', 'Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt!')
                ->with('email', $email);
        }

        if ($password != $password_confirmation) {
            return redirect()->back()
                ->with('error', 'Xác nhận mật khẩu không khớp, vui lòng thử lại!')
                ->with('email', $request->email);
        }

        $user = NguoidungModel::where('mail', $email)->update([
            'password' => bcrypt($password)
        ]);

        $id_giohang = NguoidungModel::where('mail', $email)->first()->id_nd;

        $giohang = GiohangModel::create([
            'id_giohang' => $id_giohang,
        ]);

        if ($user) {
            return redirect('login')
                ->with('success', 'Tạo mật khẩu thành công. Hãy đăng nhập ngay!');
        } else {
            return redirect()->back()->with('error', 'Tạo mật khẩu không thành công, vui lòng thử lại')
                ->with('email', $email);
        }
    }

    public function passwordPage()
    {
        return view('auth.password');
    }

    public function randomString()
    {
        return $test = sprintf('%06d', rand(1, 1000000));
    }
}
