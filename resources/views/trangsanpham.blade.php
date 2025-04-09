@vite(['resources/scss/trangsanpham.scss'])
@extends('layouts.app')
@section('title', $tensp)
@section('content')
    <div class="container my-5">
        <div class="row">
            <!-- Hình ảnh sản phẩm -->
            <div class="col-md-6">
                <img src="https://via.placeholder.com/600x600" class="product-image" alt="Bút chì 6-12 màu">
            </div>
            <!-- Thông tin sản phẩm -->
            <div class="col-md-6">
                <div class="product-info">
                    <h1>{{ $sanpham->tensp }}</h1>
                    <p class="text-muted">Thương hiệu: {{ $sanpham->thuonghieu ?? 'Không có' }}</p>
                    <p class="text-danger fw-bold">{{isset($i->giaban) ? number_format($sanpham->giaban ?? 0, 0, ',', '.') }} VNĐ</p>

                    <!-- Chọn màu sắc nếu có -->
                    @if($sanpham->chitietsp && $sanpham->chitietsp->mausac)
                    <div class="mb-3">
                        <label for="color-select" class="form-label">Chọn màu sắc:</label>
                        <select class="form-select" id="color-select">
                            <option selected>Chọn màu</option>
                            <option value="red">Đỏ</option>
                            <option value="blue">Xanh dương</option>
                            <option value="green">Xanh lá</option>
                        </select>
                    </div>

                    <!-- Chọn số lượng -->
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Số lượng:</label>
                        <input type="number" class="form-control" id="quantity" value="1" min="1">
                    </div>

                    <!-- Nút hành động -->
                    <button class="btn btn-primary btn-add-to-cart">Thêm vào giỏ hàng</button>
                    <button class="btn btn-buy-now text-white">Mua ngay</button>
                </div>

                <!-- Thông tin bổ sung -->
                <div class="product-details mt-4">
                    <h5>Thông tin sản phẩm</h5>
                    <ul>
                        <li>Bút chì 6-12 màu, thiết kế Kawaii dễ thương.</li>
                        <li>Chất liệu an toàn, không độc hại.</li>
                        <li>Phù hợp cho học sinh, văn phòng, và họa sĩ.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Đánh giá sản phẩm -->
        <div class="row mt-5">
            <div class="col">
                <h3>Đánh giá sản phẩm</h3>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Người dùng 1</h5>
                        <p class="card-text">Sản phẩm rất tốt, màu sắc đẹp và dễ sử dụng.</p>
                        <span class="text-warning">★★★★☆</span>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Người dùng 2</h5>
                        <p class="card-text">Giao hàng nhanh, chất lượng đảm bảo.</p>
                        <span class="text-warning">★★★★★</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection