@vite(['resources/css/auth/login.css'])
@section('title', 'Đăng nhập')
@include('layouts.partials.meta')

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Cột trái -->
            <div class="col-md-6 d-flex align-items-center justify-content-center bg-light p-5">
                <div class="text-center">
                    <img class="img-fluid" src="{{ asset('img/login/cart-illustration.png') }}" alt="Cart Illustration">
                    <h1 class="mt-4">Start for free and get attractive offers.</h1>
                </div>
            </div>
            <!-- Cột phải -->
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="w-75">
                    <h1>Get started.</h1>
                    <p style="font-size: 1.2rem;">Already have an account? <a href="#">Sign up</a></p>

                    <div class="d-flex gap-3 mt-3">
                        <button class="btn text-black border w-100"
                            style="background-color: #ffffff; display: flex; align-items: center; justify-content: center;">
                            <img src="{{ asset('img/login/google-icon.png') }}" width="24px" alt="Google"> <span>Log in
                                with Google</span>
                        </button>
                        <button class="btn text-white border-0 w-100"
                            style="background-color: #3b5998; display: flex; align-items: center; justify-content: center;">
                            <img src="{{ asset('img/login/facebook-icon.svg') }}" width="24px" alt="Facebook"> <span>Log
                                in with Facebook</span>
                        </button>
                    </div>


                    <p class="socials-divider"><span class="text-center my-3" style="font-size: 1.2rem;">or</span></p>

                    <form method="POST" action="">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                <input type="email" class="form-control border-0 shadow-none" name="email"
                                    placeholder="example@gmail.com" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                                <input type="password" class="form-control border-0 shadow-none" name="password"
                                    placeholder="Your password" required>
                            </div>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="terms">
                            <label class="form-check-label" for="terms">
                                I agree to Platform's <a href="#">Terms of Service</a> and <a href="#">Privacy
                                    Policy</a>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-danger w-100">Log in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>