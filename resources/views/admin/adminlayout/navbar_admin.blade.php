<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasSearch" aria-labelledby="Search">
    <div class="offcanvas-header justify-content-center">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
</div>
<header>
    <div class="container py-2">
        <div class="row py-4 pb-0 pb-sm-4 align-items-center ">
            <div class="col-sm-4 col-lg-3 text-center text-sm-start">
                <div class="main-logo">
                    <a class="nav-link {{ request()->is('welcome') ? 'active' : '' }}" href="/">
                        <img src="{{asset('logobannermain.png')}}" alt="logo" class="img-fluid">
                    </a>
                </div>
            </div>
            <div
                class="col-sm-8 col-lg-4 d-flex justify-content-end gap-5 align-items-center mt-4 mt-sm-0 justify-content-center justify-content-sm-end">
                <div class="support-box text-end d-none d-xl-block">
                    <h3 class="mb-0">Giao diện quản lý</h3>
                </div>
            </div>

            <div class="container-fluid">
                <hr class="m-0">
            </div>

            <div class="container">
                <nav class="main-menu d-flex navbar navbar-expand-lg ">
                    <div class="d-flex d-lg-none align-items-end mt-3">
                        <ul class="d-flex justify-content-end list-unstyled m-0">
                            <li>
                                <a href="account.html" class="mx-3">
                                    <iconify-icon icon="healthicons:person" class="fs-4"></iconify-icon>
                                </a>
                            </li>
                            <li>
                                <a href="wishlist.html" class="mx-3">
                                    <iconify-icon icon="mdi:heart" class="fs-4"></iconify-icon>
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

                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                        aria-labelledby="offcanvasNavbarLabel">

                        <div class="offcanvas-header justify-content-center">
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>

                        <div class="offcanvas-body justify-content-between">
                            <ul class="navbar-nav menu-list list-unstyled d-flex gap-md-3 mb-0">
                                <li class="nav-item">
                                    <a href="{{ route('home') }}" class="nav-link active">Home</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" role="button" id="pages"
                                        data-bs-toggle="dropdown" aria-expanded="false">Quản lý sản phẩm</a>
                                    <ul class="dropdown-menu" aria-labelledby="pages">
                                        <li><a href="/administrator/quanlysanpham" class="dropdown-item">Quản lý sản
                                                phẩm</a>
                                        </li>
                                        <li><a href="/administrator/themsanpham" class="dropdown-item">Thêm mới sản
                                                phẩm</a>
                                        </li>
                                        <li><a href="index.html" class="dropdown-item">Thống kê</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" role="button" id="pages"
                                        data-bs-toggle="dropdown" aria-expanded="false">Quản lý người dùng</a>
                                    <ul class="dropdown-menu" aria-labelledby="pages">
                                        <li><a href="#" class="dropdown-item">Quản lý người dùng</a>
                                        </li>
                                        <li><a href="#" class="dropdown-item">Thêm mới người dùng</a>
                                        </li>
                                        <li><a href="#" class="dropdown-item">Danh sách chặn</a>
                                        </li>
                                        <li><a href="#" class="dropdown-item">Quản lý địa chỉ</a></li>
                                        <li><a href="#" class="dropdown-item">Thống kê nâng cao</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" role="button" id="pages"
                                        data-bs-toggle="dropdown" aria-expanded="false">Danh mục và khuyến mãi</a>
                                    <ul class="dropdown-menu" aria-labelledby="pages">
                                        <li><a href="/administrator/quanlydanhmuccha" class="dropdown-item">Quản lý danh
                                                mục cha</a>
                                        </li>
                                        <li><a href="/administrator/quanlydanhmucccon" class="dropdown-item">Quản lý
                                                danh mục con</a>
                                        </li>
                                        <li><a href="#" class="dropdown-item">Thêm mới danh mục con</a>
                                        </li>
                                        <li><a href="#" class="dropdown-item">Thêm mới danh mục cha</a>
                                        </li>
                                        <li><a href="#" class="dropdown-item">Quản lý khuyến mãi</a></li>
                                        <li><a href="#" class="dropdown-item">Thêm chương trình khuyến mãi</a></li>
                                        <li><a href="#" class="dropdown-item">Quản lý banner</a></li>
                                        <li><a href="#" class="dropdown-item">Thêm mới banner</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('blog') }}" class="nav-link">Quản lý đơn hàng</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('contact') }}" class="nav-link">Phản hồi</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/" class="nav-link">Thống kê chung</a>
                                </li>
                            </ul>

                            <div class="d-none d-lg-flex align-items-end">
                                <ul class="d-flex justify-content-end list-unstyled m-0">
                                    <li>
                                        <a href="index.html" class="mx-3">
                                            <iconify-icon icon="healthicons:person" class="fs-4"></iconify-icon>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
</header>