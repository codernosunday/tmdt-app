@vite(['resources/css/auth/login.css', 'resources/css/app.css'])
@section('title', 'Đăng nhập')
@include('layouts.partials.meta')

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Cột trái -->
            <div class="col-md-6 d-flex align-items-center justify-content-center bg-light p-5">
                <div class="text-center">
                    <img class="img-fluid" src="{{ asset('img/login/cart-illustration.png') }}" alt="Cart Illustration">
                    <h1 class="mt-4">Bắt đầu miễn phí và nhận nhiều ưu đãi hấp dẫn.</h1>
                </div>
            </div>
            <!-- Cột phải -->
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="w-75">
                    <h1>Nhập mã xác nhận.</h1>

                    <form method="POST" action="">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Mã xác nhận</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                <input type="email" class="form-control border-0 shadow-none" name="email"
                                    placeholder="Nhập mã xác nhận" required>
                            </div>
                        </div>

                        <p class="resend-code"><i class="fa-solid fa-arrow-right"></i><span>Gửi lại mã</span></p>

                        <button type="submit" class="btn btn-danger w-100">Đăng kí</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>