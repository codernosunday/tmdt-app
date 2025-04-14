@vite(['resources/scss/trangsanpham.scss'])
@vite(['resources/js/listspscript/sanpham.js'])
@extends('layouts.app')
<<<<<<< HEAD
@section('title', $sp->tensp)
=======
@section('title', $sanpham->tensp)
>>>>>>> parent of e71fce6 (Revert "Merge branch 'Phuc'")
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container my-5">
        <div class="row">
            <!-- Hình ảnh sản phẩm -->
            <div class="col-md-6">
                <img src="{{ $sanpham->anh }}" class="product-image" alt="{{ $sanpham->tensp }}">
            </div>
            <!-- Thông tin sản phẩm -->
            <div class="col-md-6">
                <div class="product-info">
                    <h1>{{$sp->tensp}}</h1>
                    <p class="text-muted">Thương hiệu: {{$ctsp->thuonghieu}}</p>
                    <p class="text-muted">Còn hàng: {{$ctsp->soluong}}</p>
                    <p class="">
                        {{ isset($sp->giaban->giaban) ? number_format($sp->giaban->giaban, 0, ',', '.') . ' đ' : 'Liên hệ' }}
                    </p>
                    <!-- Chọn màu sắc -->
                    <div class="mb-3">
<<<<<<< HEAD
                        <label for="chonchitiet" class="form-label">Chọn màu sắc:</label>
                        <select class="form-select" id="chonchitiet">
                            <option selected>Chọn màu</option>
                            @foreach ($dschitiet as $i)
                                <option value="{{$i->id_ctsp}}">{{$i->thuoctinh->mau}}</option>
=======
                        <label for="color-select" class="form-label">Chọn màu sắc:</label>
                        <select class="form-select" id="color-select">
                            @foreach(explode(',', $sanpham->chitietsp->mausac) as $color)
                            <option value="{{ $color }}">{{ ucfirst($color) }}</option>
>>>>>>> parent of e71fce6 (Revert "Merge branch 'Phuc'")
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <!-- Chọn số lượng -->
                    <div class="mb-3">
                        <label for="soluong" class="form-label">Số lượng:</label>
                        <input type="number" class="form-control" id="soluong" value="1" min="1">
                    </div>

                    <!-- Nút hành động -->
                    <button type="button" onclick="themvaogio({{$sp->id_sp}})" class="btn btn-primary btn-add-to-cart">
                        Thêm vào giỏ hàng
                    </button>
                    <button class="btn btn-primary btn-add-to-cart">Mua ngay</button>
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
                            <th>Xuất xứ</th>
                            <td>{{$ctsp->xuatsu}}</td>
                        </tr>
                        <tr>
                            <th>Sản xuất</th>
                            <td>{{$ctsp->sanxuat}}</td>
                        </tr>
                        <tr>
                            <th>Tiêu chuẩn</th>
                            <td>{{$ctsp->tieuchuan}}</td>
                        </tr>
                        <tr>
                            <th>Khuyến cáo</th>
                            <td>{{$sp->tomtatsp}}</td>
                        </tr>
                    </tbody>
                </table>
                <h3>Tính năng nổi bật</h3>
                <div>{{$ctsp->tinhnangnoibat}}</div>
                <h3>Lợi ích</h3>
                <div>{{$ctsp->loiich}}</div>
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
                        <span class="" style="color:black">★★★★☆</span>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Người dùng 2</h5>
                        <p class="card-text">Giao hàng nhanh, chất lượng đảm bảo.</p>
                        <span class="" style="color:black">★★★★★</span>
                        {{-- text-warning --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection