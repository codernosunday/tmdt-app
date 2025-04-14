@extends('layouts.app')
@section('content')
@section('title', 'Trang chủ')
    @include('components.banner')
    @include('components.listsanpham')
    <section id="foodies" class="my-5">
        <div class="container my-5 py-5">
            <div class="section-header d-md-flex justify-content-between align-items-center">
                <h2 class="display-3 fw-normal">Gợi ý hôm nay</h2>

                <div>
                    <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                        shop now
                        <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                            <use xlink:href="#arrow-right"></use>
                        </svg></a>
                </div>
            </div>

            @include('components.sanphamgoiy')

        </div>
    </section>

    <section id="banner-2" class="my-3" style="background: #F9F3EC;">
        <div class="container">
            <div class="row flex-row-reverse banner-content align-items-center">
                <div class="img-wrapper col-12 col-md-6">
                    <img src="images/banner-img2.png" class="img-fluid">
                </div>
                <div class="content-wrapper col-12 offset-md-1 col-md-5 p-5">
                    <div class="secondary-font text-primary text-uppercase mb-3 fs-4">Giảm giá lên đến 40%</div>
                    <h2 class="banner-title display-1 fw-normal">Xả kho siêu khủng !!!</h2>
                    <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                        Mua ngay
                        <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                            <use xlink:href="#arrow-right"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>


    <section id="testimonial">
        <div class="container my-5 py-5">
            <div class="row">
                <div class="offset-md-1 col-md-10">
                    <div class="swiper testimonial-swiper">
                        <div class="swiper-wrapper">

                            <div class="swiper-slide">
                                <div class="row">
                                    <div class="col-2">
                                        <iconify-icon icon="ri:double-quotes-l"
                                            class="quote-icon text-primary"></iconify-icon>
                                    </div>
                                    <div class="col-md-10 mt-md-5 p-5 pt-0 pt-md-5">
                                        <p class="testimonial-content fs-2">
                                            Cốt lõi trong thực tiễn của chúng tôi là ý tưởng rằng các thành phố
                                            là nơi ươm mầm cho những thành tựu vĩ đại nhất của chúng ta và là
                                            hy vọng tốt nhất cho một tương lai bền vững.
                                        </p>
                                        <p class="text-black">- Joshima Lin</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="row">
                                    <div class="col-2">
                                        <iconify-icon icon="ri:double-quotes-l"
                                            class="quote-icon text-primary"></iconify-icon>
                                    </div>
                                    <div class="col-md-10 mt-md-5 p-5 pt-0 pt-md-5">
                                        <p class="testimonial-content fs-2">
                                            Cốt lõi trong thực tiễn của chúng tôi là ý tưởng rằng các thành phố
                                            là nơi ươm mầm cho những thành tựu vĩ đại nhất của chúng ta và là
                                            hy vọng tốt nhất cho một tương lai bền vững.
                                        </p>
                                        <p class="text-black">- Joshima Lin</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="row">
                                    <div class="col-2">
                                        <iconify-icon icon="ri:double-quotes-l"
                                            class="quote-icon text-primary"></iconify-icon>
                                    </div>
                                    <div class="col-md-10 mt-md-5 p-5 pt-0 pt-md-5">
                                        <p class="testimonial-content fs-2">
                                            Cốt lõi trong thực tiễn của chúng tôi là ý tưởng rằng các thành phố
                                            là nơi ươm mầm cho những thành tựu vĩ đại nhất của chúng ta và là
                                            hy vọng tốt nhất cho một tương lai bền vững.
                                        </p>
                                        <p class="text-black">- Joshima Lin</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="swiper-pagination"></div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="bestselling" class="my-5 overflow-hidden">
        <div class="container py-5 mb-5">

            <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
                <h2 class="display-3 fw-normal">Best selling products</h2>
                <div>
                    <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                        shop now
                        <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                            <use xlink:href="#arrow-right"></use>
                        </svg></a>
                </div>
            </div>

            <div class=" swiper bestselling-swiper">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <!-- <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
                                                                                                                  New
                                                                                                                </div> -->
                        <div class="card position-relative">
                            <a href="single-product.html"><img src="images/item5.jpg" class="img-fluid rounded-4"
                                    alt="image"></a>
                            <div class="card-body p-0">
                                <a href="single-product.html">
                                    <h3 class="card-title pt-4 m-0">Grey hoodie</h3>
                                </a>

                                <div class="card-text">
                                    <span class="rating secondary-font">
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        5.0</span>

                                    <h3 class="secondary-font text-primary">$18.00</h3>

                                    <div class="d-flex flex-wrap mt-3">
                                        <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                                            <h5 class="text-uppercase m-0">Add to Cart</h5>
                                        </a>
                                        <a href="#" class="btn-wishlist px-4 pt-3 ">
                                            <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                                        </a>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <!-- <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
                                                                                                                  New
                                                                                                                </div> -->
                        <div class="card position-relative">
                            <a href="single-product.html"><img src="images/item6.jpg" class="img-fluid rounded-4"
                                    alt="image"></a>
                            <div class="card-body p-0">
                                <a href="single-product.html">
                                    <h3 class="card-title pt-4 m-0">Grey hoodie</h3>
                                </a>

                                <div class="card-text">
                                    <span class="rating secondary-font">
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        5.0</span>

                                    <h3 class="secondary-font text-primary">$18.00</h3>

                                    <div class="d-flex flex-wrap mt-3">
                                        <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                                            <h5 class="text-uppercase m-0">Add to Cart</h5>
                                        </a>
                                        <a href="#" class="btn-wishlist px-4 pt-3 ">
                                            <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                                        </a>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
                            Sale
                        </div>
                        <div class="card position-relative">
                            <a href="single-product.html"><img src="images/item7.jpg" class="img-fluid rounded-4"
                                    alt="image"></a>
                            <div class="card-body p-0">
                                <a href="single-product.html">
                                    <h3 class="card-title pt-4 m-0">Grey hoodie</h3>
                                </a>

                                <div class="card-text">
                                    <span class="rating secondary-font">
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        5.0</span>

                                    <h3 class="secondary-font text-primary">$18.00</h3>

                                    <div class="d-flex flex-wrap mt-3">
                                        <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                                            <h5 class="text-uppercase m-0">Add to Cart</h5>
                                        </a>
                                        <a href="#" class="btn-wishlist px-4 pt-3 ">
                                            <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                                        </a>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <!-- <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
                                                                                                                  New
                                                                                                                </div> -->
                        <div class="card position-relative">
                            <a href="single-product.html"><img src="images/item8.jpg" class="img-fluid rounded-4"
                                    alt="image"></a>
                            <div class="card-body p-0">
                                <a href="single-product.html">
                                    <h3 class="card-title pt-4 m-0">Grey hoodie</h3>
                                </a>

                                <div class="card-text">
                                    <span class="rating secondary-font">
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        5.0</span>

                                    <h3 class="secondary-font text-primary">$18.00</h3>

                                    <div class="d-flex flex-wrap mt-3">
                                        <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                                            <h5 class="text-uppercase m-0">Add to Cart</h5>
                                        </a>
                                        <a href="#" class="btn-wishlist px-4 pt-3 ">
                                            <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                                        </a>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
                            -10%
                        </div>
                        <div class="card position-relative">
                            <a href="single-product.html"><img src="images/item3.jpg" class="img-fluid rounded-4"
                                    alt="image"></a>
                            <div class="card-body p-0">
                                <a href="single-product.html">
                                    <h3 class="card-title pt-4 m-0">Grey hoodie</h3>
                                </a>

                                <div class="card-text">
                                    <span class="rating secondary-font">
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        5.0</span>

                                    <h3 class="secondary-font text-primary">$18.00</h3>

                                    <div class="d-flex flex-wrap mt-3">
                                        <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                                            <h5 class="text-uppercase m-0">Add to Cart</h5>
                                        </a>
                                        <a href="#" class="btn-wishlist px-4 pt-3 ">
                                            <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                                        </a>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <!-- <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
                                                                                                                  New
                                                                                                                </div> -->
                        <div class="card position-relative">
                            <a href="single-product.html"><img src="images/item4.jpg" class="img-fluid rounded-4"
                                    alt="image"></a>
                            <div class="card-body p-0">
                                <a href="single-product.html">
                                    <h3 class="card-title pt-4 m-0">Grey hoodie</h3>
                                </a>

                                <div class="card-text">
                                    <span class="rating secondary-font">
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        5.0</span>

                                    <h3 class="secondary-font text-primary">$18.00</h3>

                                    <div class="d-flex flex-wrap mt-3">
                                        <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                                            <h5 class="text-uppercase m-0">Add to Cart</h5>
                                        </a>
                                        <a href="#" class="btn-wishlist px-4 pt-3 ">
                                            <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                                        </a>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <!-- / category-carousel -->


        </div>
    </section>

    <section id="register" style="background: url('images/background-img.png') no-repeat;">
        <div class="container">
            <div class="row my-5 py-5">
                <div class="offset-md-3 col-md-6 my-5">
                    <h2 class="display-3 fw-normal text-center">
                        Giảm ngay <span class="text-primary">20%</span> cho đơn hàng đầu tiên!
                    </h2>
                    <form>
                        <div class="mb-3">
                            <input type="email" class="form-control form-control-lg" name="email" id="email"
                                placeholder="Nhập địa chỉ email của bạn">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control form-control-lg" name="password" id="password1"
                                placeholder="Tạo mật khẩu">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control form-control-lg" name="confirm_password"
                                id="password2" placeholder="Nhập lại mật khẩu">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-dark btn-lg rounded-1">Đăng ký ngay</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <section id="latest-blog" class="my-5">
        <div class="container py-5 my-5">
            <div class="row mt-5">
                <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
                    <h2 class="display-3 fw-normal">Bài Viết Mới Nhất</h2>
                    <div>
                        <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                            Xem tất cả
                            <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                <use xlink:href="#arrow-right"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 my-4 my-md-0">
                    <div class="z-1 position-absolute rounded-3 m-2 px-3 pt-1 bg-light">
                        <h3 class="secondary-font text-primary m-0">20</h3>
                        <p class="secondary-font fs-6 m-0">Tháng 2</p>
                    </div>
                    <div class="card position-relative">
                        <a href="single-post.html"><img src="images/blog1.jpg" class="img-fluid rounded-4" alt="image"></a>
                        <div class="card-body p-0">
                            <a href="single-post.html">
                                <h3 class="card-title pt-4 pb-3 m-0">10 lý do để giúp đỡ mọi loài động vật</h3>
                            </a>
                            <div class="card-text">
                                <p class="blog-paragraph fs-6">
                                    Cốt lõi trong hoạt động của chúng tôi là ý tưởng rằng các thành phố là nơi ươm mầm cho
                                    những thành tựu vĩ đại nhất của con người và là hy vọng lớn nhất cho một tương lai bền
                                    vững.
                                </p>
                                <a href="single-post.html" class="blog-read">Đọc thêm</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 my-4 my-md-0">
                    <div class="z-1 position-absolute rounded-3 m-2 px-3 pt-1 bg-light">
                        <h3 class="secondary-font text-primary m-0">21</h3>
                        <p class="secondary-font fs-6 m-0">Tháng 2</p>
                    </div>
                    <div class="card position-relative">
                        <a href="single-post.html"><img src="images/blog2.jpg" class="img-fluid rounded-4" alt="image"></a>
                        <div class="card-body p-0">
                            <a href="single-post.html">
                                <h3 class="card-title pt-4 pb-3 m-0">Làm sao để biết thú cưng của bạn đang đói?</h3>
                            </a>
                            <div class="card-text">
                                <p class="blog-paragraph fs-6">
                                    Cốt lõi trong hoạt động của chúng tôi là ý tưởng rằng các thành phố là nơi ươm mầm cho
                                    những thành tựu vĩ đại nhất của con người và là hy vọng lớn nhất cho một tương lai bền
                                    vững.
                                </p>
                                <a href="single-post.html" class="blog-read">Đọc thêm</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 my-4 my-md-0">
                    <div class="z-1 position-absolute rounded-3 m-2 px-3 pt-1 bg-light">
                        <h3 class="secondary-font text-primary m-0">22</h3>
                        <p class="secondary-font fs-6 m-0">Tháng 2</p>
                    </div>
                    <div class="card position-relative">
                        <a href="single-post.html"><img src="images/blog3.jpg" class="img-fluid rounded-4" alt="image"></a>
                        <div class="card-body p-0">
                            <a href="single-post.html">
                                <h3 class="card-title pt-4 pb-3 m-0">Ngôi nhà tốt nhất cho thú cưng của bạn</h3>
                            </a>
                            <div class="card-text">
                                <p class="blog-paragraph fs-6">
                                    Cốt lõi trong hoạt động của chúng tôi là ý tưởng rằng các thành phố là nơi ươm mầm cho
                                    những thành tựu vĩ đại nhất của con người và là hy vọng lớn nhất cho một tương lai bền
                                    vững.
                                </p>
                                <a href="single-post.html" class="blog-read">Đọc thêm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="service">
        <div class="container py-5 my-5">
            <div class="row g-md-5 pt-4">
                <div class="col-md-3 my-3">
                    <div class="card">
                        <div>
                            <iconify-icon class="service-icon text-primary" icon="la:shopping-cart"></iconify-icon>
                        </div>
                        <h3 class="card-title py-2 m-0">Giao hàng miễn phí</h3>
                        <div class="card-text">
                            <p class="blog-paragraph fs-6">Chúng tôi giao hàng miễn phí đến tận nơi cho bạn.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 my-3">
                    <div class="card">
                        <div>
                            <iconify-icon class="service-icon text-primary" icon="la:user-check"></iconify-icon>
                        </div>
                        <h3 class="card-title py-2 m-0">Thanh toán 100% an toàn</h3>
                        <div class="card-text">
                            <p class="blog-paragraph fs-6">Bảo mật tuyệt đối, thanh toán an toàn và nhanh chóng.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 my-3">
                    <div class="card">
                        <div>
                            <iconify-icon class="service-icon text-primary" icon="la:tag"></iconify-icon>
                        </div>
                        <h3 class="card-title py-2 m-0">Ưu đãi mỗi ngày</h3>
                        <div class="card-text">
                            <p class="blog-paragraph fs-6">Nhiều chương trình khuyến mãi hấp dẫn mỗi ngày.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 my-3">
                    <div class="card">
                        <div>
                            <iconify-icon class="service-icon text-primary" icon="la:award"></iconify-icon>
                        </div>
                        <h3 class="card-title py-2 m-0">Đảm bảo chất lượng</h3>
                        <div class="card-text">
                            <p class="blog-paragraph fs-6">Sản phẩm chất lượng cao, cam kết làm hài lòng khách hàng.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="insta" class="my-5">
        <div class="row g-0 py-5">
            <div class="col instagram-item  text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="images/insta1.jpg" alt="insta-img" class="img-fluid rounded-3">
                </a>
            </div>
            <div class="col instagram-item  text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="images/insta2.jpg" alt="insta-img" class="img-fluid rounded-3">
                </a>
            </div>
            <div class="col instagram-item  text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="images/insta3.jpg" alt="insta-img" class="img-fluid rounded-3">
                </a>
            </div>
            <div class="col instagram-item  text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="images/insta4.jpg" alt="insta-img" class="img-fluid rounded-3">
                </a>
            </div>
            <div class="col instagram-item  text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="images/insta5.jpg" alt="insta-img" class="img-fluid rounded-3">
                </a>
            </div>
            <div class="col instagram-item  text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="images/insta6.jpg" alt="insta-img" class="img-fluid rounded-3">
                </a>
            </div>
        </div>
    </section>
@endsection