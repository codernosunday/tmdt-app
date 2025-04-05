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
                    <h1 class="mt-4">Bắt đầu miễn phí và nhận nhiều ưu đãi hấp dẫn.</h1>
                </div>
            </div>
            <!-- Cột phải -->
            <div class="relative col-md-6 d-flex align-items-center justify-content-center col-right">
                @if (session('error'))
                    <div class="error">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="w-75">
                    <h1>Quên mật khẩu.</h1>
                    <form method="POST" action="">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                <input type="email" class="form-control border-0 shadow-none" name="email"
                                    placeholder="Nhập địa chỉ email" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger w-100">Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        var col = document.querySelector(".error");
        const timeout = setTimeout(()=>{
            if(col){
                col.style.display = "none";
            }
        },3000);
    </script>
</body>