@vite(['resources/scss/trangsanpham.scss'])
@extends('layouts.app')
@section('title', $sanpham->tensp)
@section('content')
    <div class="container my-5">
        <div class="row">
            <!-- Hình ảnh sản phẩm -->
            <div class="col-md-6">
                <img src="{{ $sanpham->anh }}" class="product-image img-fluid" alt="{{ $sanpham->tensp }}">
            </div>
            <!-- Thông tin sản phẩm -->
            <div class="col-md-6">
                <div class="product-info">
                    <h1>{{ $sanpham->tensp }}</h1>
                    <p class="text-muted">Thương hiệu: {{ $sanpham->chitietsp->thuonghieu ?? 'Không có' }}</p>
                    <p class="text-danger fw-bold">{{ number_format($sanpham->giaban->giaban ?? 0, 0, ',', '.') }} VNĐ</p>

                    <!-- Chọn màu sắc nếu có -->
                    @if($sanpham->chitietsp && $sanpham->chitietsp->mausac)
                    <div class="mb-3">
                        <label for="color-select" class="form-label">Chọn màu sắc:</label>
                        <select class="form-select" id="color-select">
                            <option selected>{{ $sanpham->chitietsp->mausac }}</option>
                        </select>
                    </div>
                    @endif

                    <!-- Chọn số lượng -->
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Số lượng:</label>
                        <input type="number" class="form-control" id="quantity" value="1" min="1" 
                               max="{{ $sanpham->chitietsp->soluong ?? 1 }}">
                    </div>

                    <!-- Nút hành động -->
                    @if($sanpham->tinhtrang)
                        <button class="btn btn-primary btn-add-to-cart mb-2">Thêm vào giỏ hàng</button>
                        <button class="btn btn-success btn-buy-now mb-2">Mua ngay</button>
                    @else
                        <div class="alert alert-warning">Sản phẩm hiện đang hết hàng</div>
                    @endif

                    <!-- Thông tin chi tiết sản phẩm -->
                    <div class="product-details mt-4">
                        <h5>Thông tin sản phẩm</h5>
                        <div class="mt-3">
                            {!! $sanpham->tomtatsp !!}
                        </div>
                        @if($sanpham->chitietsp)
                        <ul class="list-unstyled mt-3">
                            @if($sanpham->chitietsp->kichthuoc)
                            <li><strong>Kích thước:</strong> {{ $sanpham->chitietsp->kichthuoc }}</li>
                            @endif
                            @if($sanpham->chitietsp->doday)
                            <li><strong>Độ dày:</strong> {{ $sanpham->chitietsp->doday }}mm</li>
                            @endif
                            @if($sanpham->chitietsp->sotrang)
                            <li><strong>Số trang:</strong> {{ $sanpham->chitietsp->sotrang }}</li>
                            @endif
                            @if($sanpham->chitietsp->dattinh)
                            <li><strong>Đặc tính:</strong> {{ $sanpham->chitietsp->dattinh }}</li>
                            @endif
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sản phẩm liên quan -->
        @if($relatedProducts && $relatedProducts->count() > 0)
        <div class="related-products mt-5">
            <h3>Sản phẩm liên quan</h3>
            <div class="row">
                @foreach($relatedProducts as $product)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <a href="{{ route('sanpham.show', ['tensp' => $product->tensp, 'id_sp' => $product->id_sp]) }}">
                            <img src="{{ $product->anh }}" class="card-img-top" alt="{{ $product->tensp }}">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->tensp }}</h5>
                            <p class="card-text text-danger">
                                {{ number_format($product->giaban->giaban ?? 0, 0, ',', '.') }} VNĐ
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
@endsection