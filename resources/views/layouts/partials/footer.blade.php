<footer id="footer" class="my-5">
    <div class="container py-5 my-5">
        <div class="row">
            <div class="col-md-3">
                <div class="footer-menu">
                    <img src="{{asset('logobannermain.png')}}" alt="logo">
                    <p class="blog-paragraph fs-6 mt-3">Đăng ký nhận bản tin của chúng tôi để cập nhật những ưu đãi hấp
                        dẫn.</p>
                    <div class="social-links">
                        <ul class="d-flex list-unstyled gap-2">
                            <li class="social">
                                <a href="#">
                                    <iconify-icon class="social-icon" icon="ri:facebook-fill"></iconify-icon>
                                </a>
                            </li>
                            <li class="social">
                                <a href="#">
                                    <iconify-icon class="social-icon" icon="ri:twitter-fill"></iconify-icon>
                                </a>
                            </li>
                            <li class="social">
                                <a href="#">
                                    <iconify-icon class="social-icon" icon="ri:pinterest-fill"></iconify-icon>
                                </a>
                            </li>
                            <li class="social">
                                <a href="#">
                                    <iconify-icon class="social-icon" icon="ri:instagram-fill"></iconify-icon>
                                </a>
                            </li>
                            <li class="social">
                                <a href="#">
                                    <iconify-icon class="social-icon" icon="ri:youtube-fill"></iconify-icon>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="footer-menu">
                    <h3>Liên kết nhanh</h3>
                    <ul class="menu-list list-unstyled">
                        <li class="menu-item">
                            <a href="{{ Route('shop') }}" class="nav-link">Trang chủ</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('aboutus') }}" class="nav-link">Về chúng tôi</a>
                        </li>

                        <li class="menu-item">
                            <a href="{{ route('service') }}" class="nav-link">Dich vụ</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('contact') }}" class="nav-link">Liên hệ chúng tôi</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="footer-menu">
                    <h3>Trung tâm hỗ trợ</h3>
                    <ul class="menu-list list-unstyled">
                        <li class="menu-item">
                            <a href="#" class="nav-link">Câu hỏi thường gặp</a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="nav-link">Thanh toán</a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="nav-link">Hoàn trả & hoàn tiền</a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="nav-link">Thanh toán đơn hàng</a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="nav-link">Thông tin giao hàng</a>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- <div class="col-md-3">
                <div>
                    <h3>Bản tin của chúng tôi</h3>
                    <p class="blog-paragraph fs-6">Đăng ký nhận bản tin để không bỏ lỡ các ưu đãi đặc biệt.</p>
                    <div class="search-bar border rounded-pill border-dark-subtle px-2">
                        <form class="text-center d-flex align-items-center" action="" method="">
                            <input type="text" class="form-control border-0 bg-transparent"
                                placeholder="Nhập email của bạn" />
                            <iconify-icon class="send-icon" icon="tabler:location-filled"></iconify-icon>
                        </form>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</footer>
<div id="footer-bottom">
    <div class="container">
        <hr class="m-0">
        <div class="row mt-3">
            <div class="col-md-6 copyright">
                <p class="secondary-font">© 2025 Shopen. Trang web bán đồ dùng văn phòng phẩm.</p>
            </div>
        </div>
    </div>
</div>