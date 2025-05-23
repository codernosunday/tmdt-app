@vite(['resources/scss/trangsanpham.scss'])
@vite(['resources/js/listspscript/sanpham.js'])
@extends('layouts.app')
@section('title', $sp->tensp)
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container my-5">
        <div class="row">
            <!-- Hình ảnh sản phẩm -->
            <div class="col-md-6">
                <img src="{{ $sp->anhbase64 ? asset('storage/' . $sp->anhbase64) : '' }}" class="product-image"
                    alt="Bút chì 6-12 màu">
            </div>
            <!-- Thông tin sản phẩm -->
            <div class="col-md-6">
                <div class="product-info">
                    <h1>{{$sp->tensp}}</h1>
                    <p class="text-muted">Thương hiệu: {{$chitiet->thuonghieu}}</p>
                    <p class="text-muted" id="soluong">
                        {{$chitiet->soluong >= 1 ? 'Còn hàng: ' . $chitiet->soluong : 'hết hàng'}}
                    </p>
                    <div class="d-flex align-items-center">
                        <p class="mr-2">Giá bán: </p>
                        <p id="giaban" class="giaban">
                            {{ isset($sp->giaban->giaban) ? number_format($sp->giaban->giaban, 0, ',', '.') . ' đ' : 'Liên hệ' }}
                        </p>
                    </div>
                    <!-- Chọn màu sắc -->
                    <div class="mb-3">
                        <label for="chonchitiet" class="form-label">Chọn màu sắc:</label>
                        <select class="form-select" id="chonchitiet" name="chonchitiet">
                            @foreach ($dschitiet as $i)
                                @if (!is_null(optional($i->thuoctinh)->mau))
                                    <option value="{{ $i->id_ctsp }}">
                                        {{ $i->thuoctinh->mau }}
                                    </option>
                                @else
                                    <option value="{{$ctsp->id_ctsp}}">
                                        Không có màu sắc
                                    </option>
                                @endif
                            @endforeach
                        </select>

                    </div>
                    <!-- Chọn số lượng -->
                    <div class="mb-3">
                        <label for="soluong" class="form-label">Số lượng:</label>
                        <input type="number" class="form-control" id="soluongmua" value="1" min="1">
                    </div>
                    <!-- Nút hành động -->
                    @if($chitiet->soluong >= 1)
                        <button type="button" onclick="themvaogio({{$sp->id_sp}})" class="btn btn-primary btn-add-to-cart">
                            Thêm vào giỏ hàng
                        </button>
                        <button class="btn btn-primary btn-add-to-cart" onclick="muangay({{$chitiet->id_ctsp}})">Mua
                            ngay</button>
                    @else
                        <button class="btn btn-primary btn-add-to-cart">Sản phẩm hết hàng</button>
                    @endif

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
                            <td>{{$chitiet->thuonghieu ?? 'Chưa cập nhật'}}</td>
                        </tr>
                        <tr>
                            <th>Xuất xứ</th>
                            <td>{{ $chitiet->xuatsu ?? 'Chưa cập nhật' }}</td>
                        </tr>
                        <tr>
                            <th>Sản xuất</th>
                            <td>{{ $chitiet->sanxuat ?? 'Chưa cập nhật' }}</td>
                        </tr>
                        <tr>
                            <th>Tiêu chuẩn</th>
                            <td>{{ $chitiet->tieuchuan ?? 'Đang cập nhật' }}</td>
                        </tr>
                        <tr>
                            <th>Kích thước</th>
                            <td>{{$chitiet->kichthuoc ?? 'Đang cập nhật'}}</td>
                        </tr>
                    </tbody>
                </table>
                @if($chitiet->tinhnangnoibat)
                    <h3>Tính năng nổi bật</h3>
                    <div>{{$chitiet->tinhnangnoibat}}</div>
                @endif
                @if($chitiet->loiich)
                    <h3>Lợi ích</h3>
                    <div>{{$chitiet->loiich}}</div>
                @endif
            </div>
        </div>
        <div class="row">
            {{-- <h3>Đánh giá sản phẩm</h3> --}}
            @include('components.danhgia')
        </div>
    </div>
@endsection