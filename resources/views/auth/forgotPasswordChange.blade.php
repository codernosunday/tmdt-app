@vite(['resources/css/auth/auth.css'])
@section('title', 'Đăng nhập')
@include('layouts.partials.meta')

@if (!session('email'))
    <script>
        window.location.href = "forgot";
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
                        <h1>Tạo mật khẩu của bạn</h1>
                        <span class="email">Tạo mật khẩu cho <span>{{ session('email') }}</span></span>
                        <span class="fail"></span>
                        <form method="POST" action="" style="margin-top: 10px;">
                            @csrf
                            <input type="hidden" name="email" value="{{ session('email') }}"/>
                            <div class="mb-3">
                                <label for="email" class="form-label">Mật khẩu</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                    <input type="password" class="form-control border-0 shadow-none" name="password" id="password"
                                        placeholder="Nhập mật khẩu của bạn" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Xác nhận mật khẩu</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                                    <input type="password" class="form-control border-0 shadow-none" name="password_confirmation" id="password_confirmation"
                                        placeholder="Xác nhận mật khẩu của bạn" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-danger w-100">Tạo mật khẩu</button>
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
        <script>
           function validatePassword(password) {
                var regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                return regex.test(password);
            }

            var passwordInput = document.querySelector('#password');
            var passwordConfirmationInput = document.querySelector('#password_confirmation');
            var errorMessage = document.querySelector('.fail');
            var input = document.querySelectorAll('.input-group');
            
            passwordInput.addEventListener('input', function() {
                if(!validatePassword(this.value)) {
                    errorMessage.innerHTML = "Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.";
                    errorMessage.style.display = "block";
                    input.forEach(input => {
                        input.classList.add('border-red');
                    });
                    return;
                }else {
                    errorMessage.style.display = "none";
                    input.forEach(input => {
                        input.classList.remove('border-red');
                    });
                }
                
                if (this.value !== passwordConfirmationInput.value) {
                    errorMessage.innerHTML = "Xác nhận mật khẩu không khớp. Vui lòng kiểm tra lại.";
                    errorMessage.style.display = "block";
                    input.forEach(input => {
                        input.classList.add('border-red');
                    });
                } else {
                    errorMessage.style.display = "none";
                    input.forEach(input => {
                        input.classList.remove('border-red');
                    });
                }
            });
            passwordConfirmationInput.addEventListener('input', function() {
                if(!validatePassword(this.value)) {
                    errorMessage.innerHTML = "Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.";
                    errorMessage.style.display = "block";
                    input.forEach(input => {
                        input.classList.add('border-red');
                    });
                    return;
                }else {
                    errorMessage.style.display = "none";
                    input.forEach(input => {
                        input.classList.remove('border-red');
                    });
                }

                if (this.value !== passwordInput.value) {
                    errorMessage.innerHTML = "Xác nhận mật khẩu không khớp. Vui lòng kiểm tra lại.";
                    errorMessage.style.display = "block";
                    input.forEach(input => {
                        input.classList.remove('border-red');
                    });
                } else {
                    errorMessage.style.display = "none";
                    input.forEach(input => {
                        input.classList.remove('border-red');
                    });
                }
            });
        </script>
    </body>
@endif