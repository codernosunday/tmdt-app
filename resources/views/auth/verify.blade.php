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
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="w-75">
                    <h1>Nhập mã xác nhận.</h1>

                    <form method="POST" action="">
                        @csrf
                        <div class="mb-3">
                            <div class="otp-inputs">
                                <input type="text" maxlength="1" class="otp-input"/>
                                <input type="text" maxlength="1" class="otp-input" />
                                <input type="text" maxlength="1" class="otp-input" />
                                <input type="text" maxlength="1" class="otp-input" />
                                <input type="text" maxlength="1" class="otp-input" />
                                <input type="text" maxlength="1" class="otp-input" />
                                <!-- <input type="hidden" maxlength="1" class="otp-input" /> -->
                            </div>
                        </div>

                        <p class="resend-code"><i class="fa-solid fa-arrow-right"></i><span>Gửi lại mã</span></p>

                        <button type="submit" class="btn btn-danger w-100">Đăng kí</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const otpInputs = document.querySelectorAll('.otp-input');
        otpInputs[0].focus();
        let fullInput = false;
        otpInputs.forEach((otpInput, index) => {
            otpInput.addEventListener('input', (e) => { 
                if (!Number.isInteger(parseInt(e.data))) {
                    otpInput.value='';
                    return;
                }

                if (index === otpInputs.length - 1) {
                    fullInput = true;
                    return;
                }

                otpInputs[index + 1].focus();
            });

            otpInput.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace') {
                    if (index === 0) {
                        return;
                    }

                    if(fullInput) {
                        console.log(index);
                        otpInputs[otpInputs.length - 1].focus();
                        fullInput = false;
                        return;
                    }else{
                        otpInputs[index].value = '';
                        otpInputs[index - 1].focus();
                    }
                }
            });
        });
    </script>
</body>