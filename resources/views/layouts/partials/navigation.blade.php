@vite(['resources/css/navigation/navigation.css'])

<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasSearch" aria-labelledby="Search">
    <div class="offcanvas-header justify-content-center">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        {{-- <div class="order-md-last">
            <h4 class="text-primary text-uppercase mb-3">
                Tìm kiếm
            </h4>
            <div class="search-bar border border-success mb-2 rounded-2 overflow-hidden d-flex p-2">
                <input type="text" class="form-control border-0 " placeholder="Tìm kiếm sản phẩm..." />
                <button class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zm-5.442.656a5.5 5.5 5.5 0 1 1 0-11 5.5 5.5 5.5 0 0 1 0 11z" />
                    </svg>
                </button>
            </div>
        </div> --}}
    </div>
</div>
<header>
    <div class="container py-2">
        <div class="row py-4 pb-0 pb-sm-4 align-items-center ">
            <div class="col-sm-4 col-lg-3 text-center text-sm-start">
                <div class="main-logo">
                    <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="/">
                        <img src="{{asset('logobannermain.png')}}" alt="logo" class="img-fluid">
                    </a>
                </div>
            </div>
            <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-5 d-none d-lg-block">
                <div class="search-bar border border-black rounded-2 overflow-hidden d-flex custom-border hover-effect">
                    <input type="text" class="form-control border-0 px-3" placeholder="Tìm kiếm sản phẩm..." />
                    <button class="btn btn-outline-success d-flex align-items-center justify-content-center">
                        <span class="iconify" data-icon="mdi:search" style="font-size: 20px;"></span>
                    </button>
                </div>
            </div>


            <div
                class="col-sm-8 col-lg-4 d-flex justify-content-end gap-4 align-items-center mt-4 mt-sm-0 justify-content-center justify-content-sm-end">
                <div class="support-box text-end d-none d-xl-block">
                    <span class="fs-6 secondary-font text-muted">Số điện thoại</span>
                    <h5 class="mb-0">{{ session('sodt') ? session('sodt') : 'Chưa có' }}</h5>
                </div>
                <div class="support-box text-end d-none d-xl-block">
                    <span class="fs-6 secondary-font text-muted">Xin chào</span>
                    <h5 class="mb-0">{{ session('email') }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <hr class="m-0">
    </div>

    <div class="container">
        <nav class="main-menu d-flex navbar navbar-expand-lg justify-content-between align-items-center">
            <select class="filter-categories border-0 mb-0 me-3">
                <option>Danh mục</option>
                @foreach ($danhMucSp as $i)
                    <option value="{{$i->id_dm}}">{{$i->tendanhmuc}}</option>
                @endforeach
            </select>

            <li>
                <a href="#" class="mx-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart"
                    aria-controls="offcanvasCart">
                    <iconify-icon icon="mdi:cart" class="fs-4 position-relative"></iconify-icon>
                    <span class="position-absolute translate-middle badge rounded-circle bg-primary pt-2">
                        0
                    </span>
                </a>
            </li>

            <li>
                <a href="#" class="mx-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSearch"
                    aria-controls="offcanvasSearch">
                    <iconify-icon icon="tabler:search" class="fs-4"></iconify-icon>
                    </span>
                </a>
            </li>
            </ul>
    </div>

    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

        <div class="offcanvas-header justify-content-center">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body justify-content-between">
            <select class="filter-categories border-0 mb-0 me-5">
                <option>Shop by Category</option>
                @foreach ($danhMucSp as $i)
                    <option value="{{$i->id_dm}}">{{$i->tendanhmuc}}</option>
                @endforeach
            </select>
            <ul class="navbar-nav menu-list list-unstyled d-flex gap-md-3 mb-0">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link active">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" id="pages" data-bs-toggle="dropdown"
                        aria-expanded="false">Pages</a>
                    <ul class="dropdown-menu" aria-labelledby="pages">
                        <li><a href="index.html" class="dropdown-item">About Us</a></li>
                        <li><a href="index.html" class="dropdown-item">Shop</a></li>
                        <li><a href="index.html" class="dropdown-item">Single Product</a></li>
                        <li><a href="index.html" class="dropdown-item">Cart</a></li>
                        <li><a href="index.html" class="dropdown-item">Wishlist</a></li>
                        <li><a href="index.html" class="dropdown-item">Checkout</a></li>
                        <li><a href="index.html" class="dropdown-item">Blog</a></li>
                        <li><a href="index.html" class="dropdown-item">Single Post</a></li>
                        <li><a href="index.html" class="dropdown-item">Contact</a></li>
                        <li><a href="index.html" class="dropdown-item">FAQs</a></li>
                        <li><a href="index.html" class="dropdown-item">Account</a></li>
                        <li><a href="index.html" class="dropdown-item">Thankyou</a></li>
                        <li><a href="index.html" class="dropdown-item">Error 404</a></li>
                        <li><a href="index.html" class="dropdown-item">Styles</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('shop') }}" class="nav-link">Shop</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('blog') }}" class="nav-link">Blog</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                </li>
                <li class="nav-item">
                    <a href="/" class="nav-link">Others</a>
                </li>
            </ul>

            <div class="d-none d-lg-flex align-items-end">
                <ul class="d-flex justify-content-end list-unstyled m-0">
                    <li>
                        <a href="index.html" class="mx-3">
                            <iconify-icon icon="healthicons:person" class="fs-4"></iconify-icon>
                        </a>
                    </li>
                    <li>
                        <a href="index.html" class="mx-3">
                            <iconify-icon icon="mdi:heart" class="fs-4"></iconify-icon>
                        </a>
                    </li>

                    <li class="shopping-cart">
                        <a href="/cart/" class="mx-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart"
                            aria-controls="offcanvasCart">
                            <iconify-icon icon="mdi:cart" class="fs-4 position-relative"></iconify-icon>
                            <span class="position-absolute translate-middle badge rounded-circle bg-primary pt-2">
                                {{ $countProductInCart }}
                            </span>
                        </a>

                        <div class="list-shopping-cart">
                            @if ($countProductInCart > 0)
                                <div class="list-product-cart">
                                    @foreach ($cart as $item)
                                        <div class="product-cart-item d-flex align-items-center gap-2">
                                            <img src="{{ $item->anh }}" alt="product" class="img-fluid">
                                            <div class="product-cart-info">
                                                <h5>{{ $item->tensp }}</h5>
                                                <p>{{ number_format($item->price, 0, ',', '.') }} đ</p>
                                                <p>Số lượng: {{ $item->quantity }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <img src="{{ asset('img/shopping-cart/shopping-cart.png') }}" alt="Giỏ hàng trống"
                                    class="img-no-cart">
                                <h3>Chưa có sản phẩm nào trong giỏ hàng</h3>
                            @endif
                        </div>
                    </li>
                </ul>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">

                <div class="offcanvas-header justify-content-center">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="offcanvas-body justify-content-between">
                    <select class="filter-categories border-0 mb-0 me-5">
                        <option>Shop by Category</option>
                        @foreach ($danhMucSp as $i)
                            <option value="{{$i->id_dm}}">{{$i->tendanhmuc}}</option>
                        @endforeach
                    </select>
                    <ul class="navbar-nav menu-list list-unstyled d-flex gap-md-3 mb-0">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link active">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" id="pages" data-bs-toggle="dropdown"
                                aria-expanded="false">Pages</a>
                            <ul class="dropdown-menu" aria-labelledby="pages">
                                <li><a href="index.html" class="dropdown-item">About Us</a></li>
                                <li><a href="index.html" class="dropdown-item">Shop</a></li>
                                <li><a href="index.html" class="dropdown-item">Single Product</a></li>
                                <li><a href="index.html" class="dropdown-item">Cart</a></li>
                                <li><a href="index.html" class="dropdown-item">Wishlist</a></li>
                                <li><a href="index.html" class="dropdown-item">Checkout</a></li>
                                <li><a href="index.html" class="dropdown-item">Blog</a></li>
                                <li><a href="index.html" class="dropdown-item">Single Post</a></li>
                                <li><a href="index.html" class="dropdown-item">Contact</a></li>
                                <li><a href="index.html" class="dropdown-item">FAQs</a></li>
                                <li><a href="index.html" class="dropdown-item">Account</a></li>
                                <li><a href="index.html" class="dropdown-item">Thankyou</a></li>
                                <li><a href="index.html" class="dropdown-item">Error 404</a></li>
                                <li><a href="index.html" class="dropdown-item">Styles</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('shop') }}" class="nav-link">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('blog') }}" class="nav-link">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a href="/" class="nav-link">Others</a>
                        </li>
                    </ul>

                    <div class="d-none d-lg-flex align-items-end">
                        <ul class="d-flex justify-content-end list-unstyled m-0">
                            <li>
                                <a href="index.html" class="mx-3">
                                    <iconify-icon icon="healthicons:person" class="fs-4"></iconify-icon>
                                </a>
                            </li>
                            <li>
                                <a href="index.html" class="mx-3">
                                    <iconify-icon icon="mdi:heart" class="fs-4"></iconify-icon>
                                </a>
                            </li>

                            <li class="shopping-cart">
                                <a href="/cart/" class="mx-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart"
                                    aria-controls="offcanvasCart">
                                    <iconify-icon icon="mdi:cart" class="fs-4 position-relative"></iconify-icon>
                                    <span
                                        class="position-absolute translate-middle badge rounded-circle bg-primary pt-2">
                                        {{ $countProductInCart }}
                                    </span>
                                </a>

                                {{-- <div class="list-shopping-cart">
                                    @if ($countProductInCart > 0)
                                    <div class="list-product-cart">
                                        @foreach ($cart as $item)
                                        <div class="product-cart-item d-flex align-items-center gap-2">
                                            <img src="{{ $item->anh }}" alt="product" class="img-fluid">
                                            <div class="product-cart-info">
                                                <h5>{{ $item->tensp }}</h5>
                                                <p>{{ number_format($item->price, 0, ',', '.') }} đ</p>
                                                <p>Số lượng: {{ $item->quantity }}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @else
                                    <img src="{{ asset('img/shopping-cart/shopping-cart.png') }}"
                                        alt="Giỏ hàng trống" class="img-no-cart">
                                    <h3>Chưa có sản phẩm nào trong giỏ hàng</h3>
                                    @endif
                                </div> --}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            </nav>
        </div>

        <script>
            document.querySelector(".shopping-cart").addEventListener("click", () => {
                window.location.href = "/cart";
            })
        </script>
</header>