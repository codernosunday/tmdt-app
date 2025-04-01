@vite(['resources/css/auth/auth.css'])
@section('title', 'Đăng nhập')
@include('layouts.partials.meta')

@if (!session('email'))
    <script>
        window.location.href = "register";
    </script>
@else
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
                    <div class="w-75">
                        <h1>Tạo mật khẩu của bạn</h1>
                        <span class="email">Tạo mật khẩu cho <span>{{ session('email') }}</span></span>
                        <form method="POST" action="" style="margin-top: 10px;">
                            @csrf
                            <input type="hidden" name="email" value="{{ session('email') }}"/>
                            <div class="mb-3">
                                <label for="email" class="form-label">Mật khẩu</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                    <input type="password" class="form-control border-0 shadow-none" name="password"
                                        placeholder="Nhập mật khẩu của bạn" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Xác nhận mật khẩu</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                                    <input type="password" class="form-control border-0 shadow-none" name="password_confirmation" name="password_confirmation"
                                        placeholder="Xác nhận mật khẩu của bạn" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-danger w-100">Tạo mật khẩu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endif