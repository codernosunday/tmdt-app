@vite(['resources/css/auth/auth.css'])
@section('title', 'Đăng nhập')
@include('layouts.partials.meta')

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Cột trái -->
            <div class="col-md-6 d-flex align-items-center justify-content-center bg-light p-5">
                <div class="text-center">
                    <img class="img-fluid" src="{{ asset('img/login/cart-illustration.png') }}" alt="Cart Illustration">
                    <h1 class="mt-4">Bắt đầu miễn phí và nhận nhiều ưu đãi hấp dẫn</h1>
                </div>
            </div>
            <!-- Cột phải -->
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                @if (session('success'))
                    <div class="success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="error">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="w-75">
                    <h1>Đăng nhập.</h1>
                    <p style="font-size: 1.2rem;">Bạn chưa có tài khoản? <a href="/register">Đăng kí</a></p>

                    <div class="d-flex gap-3 mt-3">
                        <button class="btn text-black border w-100"
                            style="background-color: #ffffff; display: flex; align-items: center; justify-content: center;">
                            <img src="{{ asset('img/login/google-icon.png') }}" width="24px" alt="Google"> <span>Đăng nhập với Google</span>
                        </button>
                        <button class="btn text-white border-0 w-100"
                            style="background-color: #3b5998; display: flex; align-items: center; justify-content: center;">
                            <img src="{{ asset('img/login/facebook-icon.svg') }}" width="24px" alt="Facebook"> <span>Log
                                in with Facebook</span>
                        </button>
                    </div>


                    <p class="socials-divider"><span class="text-center my-3" style="font-size: 1.2rem;">hoặc</span></p>

                    <form method="POST" action="">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                <input type="email" class="form-control border-0 shadow-none" name="email"
                                    placeholder="Nhập email của bạn" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                                <input type="password" class="form-control border-0 shadow-none" name="password"
                                    placeholder="Nhập mật khẩu của bạn" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <a href="/forgot" class="forgot">Quên mật khẩu?</a>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="terms">
                            <label class="form-check-label" for="terms">
                                Tôi đồng ý với  <a href="#">Điều khoản dịch vụ</a> và <a href="#">Chính sách bảo mật</a> của nền tảng
                            </label>
                        </div>

                        <button type="submit" class="btn btn-danger w-100">Đăng nhập</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var err = document.querySelector(".error");
        var suc = document.querySelector(".success");
        const timeout = setTimeout(()=>{
            if(err){
                err.style.display = "none";
            }
            if(suc){
                suc.style.display = "none";
            }
        },3000);
    </script>
</body>