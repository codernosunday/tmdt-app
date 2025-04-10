@vite(['resources/scss/trangsanpham.scss'])
@extends('layouts.app')
@section('title', $sanpham->tensp)
@section('content')
    <div class="container my-5">
        <div class="row">
            <!-- Hình ảnh sản phẩm -->
            <div class="col-md-6">
                <img src="{{ $sanpham->anh }}" class="product-image" alt="{{ $sanpham->tensp }}">
            </div>
            <!-- Thông tin sản phẩm -->
            <div class="col-md-6">
                <div class="product-info">
                    <h1>{{ $sanpham->tensp }}</h1>
                    <p class="text-muted">Thương hiệu: {{ $sanpham->thuonghieu ?? 'Không có' }}</p>
                    <p class="text-danger fw-bold">{{ number_format($sanpham->giaban, 0, ',', '.') }} VNĐ</p>

                    <!-- Chọn màu sắc nếu có -->
                    @if($sanpham->chitietsp && $sanpham->chitietsp->mausac)
                    <div class="mb-3">
                        <label for="color-select" class="form-label">Chọn màu sắc:</label>
                        <select class="form-select" id="color-select">
                            @foreach(explode(',', $sanpham->chitietsp->mausac) as $color)
                            <option value="{{ $color }}">{{ ucfirst($color) }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif

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
                        <li>{{ $sanpham->tomtatsp }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection