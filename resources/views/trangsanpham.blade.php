@vite(['resources/scss/trangsanpham.scss'])
@extends('layouts.app')
@section('title', $tensp)
@section('content')
    <div class="container my-5">
        <div class="row">
            <!-- Hình ảnh sản phẩm -->
            <div class="col-md-6">
                <img src="{{$sp->anh}}" class="product-image" alt="Bút chì 6-12 màu">
            </div>
            <!-- Thông tin sản phẩm -->
            <div class="col-md-6">
                <div class="product-info">
                    <h1>{{$sp->tensp}}</h1>
                    <p class="text-muted">Thương hiệu: {{$ctsp->thuonghieu}}</p>
                    <p class="text-danger fw-bold">
                        {{ isset($i->giaban) ? number_format($giaban->giaban, 0, ',', '.') . ' đ' : 'Liên hệ' }}
                    </p>
                    <!-- Chọn màu sắc -->
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

            </div>
        </div>
        <div class="row">
            <div class="product-details mt-4">
                <h5>Thông tin sản phẩm</h5>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th class="w-25">Thương hiệu</th>
                            <td>{{$ctsp->thuonghieu}}</td>
                        </tr>
                        <tr>
                            <th>Đường kính viên bi</th>
                            <td>0.5 mm</td>
                        </tr>
                        <tr>
                            <th>Kích thước ruột bút</th>
                            <td>127.4 mm</td>
                        </tr>
                        <tr>
                            <th>Phụ kiện</th>
                            <td>Thay thế cho Gel-027, Gel-031, Gel-018, FO-Gel018/VN, TP-Gel01, TP-Gel03.</td>
                        </tr>
                        <tr>
                            <th>Xuất xứ</th>
                            <td>Việt Nam</td>
                        </tr>
                        <tr>
                            <th>Sản xuất</th>
                            <td>Việt Nam</td>
                        </tr>
                        <tr>
                            <th>Khuyến cáo</th>
                            <td>Tránh nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.</td>
                        </tr>
                    </tbody>
                </table>
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