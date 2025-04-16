@vite(['resources/scss/dathang.scss'])
@vite(['resources/js/giohangscript/dathang.js'])
@extends('layouts.app')
@section('title', 'Đặt hàng ')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Giỏ hàng -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Giỏ hàng của bạn</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Tổng</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Sản phẩm 1 -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{$sanpham->anh}}" alt="Product" class="cart-item-img me-3">
                                                <div>
                                                    <h6 class="mb-1">{{$sanpham->tensp}}</h6>
                                                    <p class="text-muted mb-0">Màu: {{$ctsp->mau}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">{{number_format($giaban->giaban, 0, ',', '.') . ' đ'}}</td>
                                        <td class="align-middle">
                                            <div class="input-group" style="width: 120px;">
                                                {{$soluong["soluong"]}}
                                            </div>
                                        </td>
                                        <td class="align-middle">{{number_format($tongtien, 0, ',', '.') . ' đ'}}</td>
                                        {{-- <td class="align-middle">
                                            <button class="btn btn-outline-danger btn-sm"><i
                                                    class="fas fa-trash"></i></button>
                                        </td> --}}
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Voucher -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-tag me-2"></i>Mã giảm giá</h5>
                    </div>
                    <div class="card-body">
                        <div class="voucher-box">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="magiamgia" placeholder="Nhập mã giảm giá">
                                <button class="btn btn-primary" onclick="magiamgia()">Áp dụng</button>
                            </div>
                            <div class="badge-container">
                                <div id="dsgiamgia" name="dsgiamgia">

                                </div>
                                <p id="mggnote"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Địa chỉ giao hàng -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Địa chỉ giao hàng</h5>
                    </div>
                    @if(1 > 2)
                        <div class="card-body">
                            <div class="row">
                                <!-- Địa chỉ 1 -->
                                <div class="col-md-6 mb-3">
                                    <div class="card address-card selected h-100">
                                        <div class="card-body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="address" id="address1"
                                                    checked>
                                                <label class="form-check-label fw-bold" for="address1">
                                                    Nhà riêng
                                                </label>
                                            </div>
                                            <p class="mb-1">Nguyễn Văn A</p>
                                            <p class="mb-1">0987654321</p>
                                            <p class="mb-0">Số 1, Đường ABC, Phường XYZ, Quận 1, TP.HCM</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Địa chỉ 2 -->
                                <div class="col-md-6 mb-3">
                                    <div class="card address-card h-100">
                                        <div class="card-body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="address" id="address2">
                                                <label class="form-check-label fw-bold" for="address2">
                                                    Công ty
                                                </label>
                                            </div>
                                            <p class="mb-1">Nguyễn Văn A</p>
                                            <p class="mb-1">0987654321</p>
                                            <p class="mb-0">Tòa nhà DEF, Số 123, Đường LMN, Quận 3, TP.HCM</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-outline-primary"><i class="fas fa-plus me-2"></i>Thêm địa chỉ mới</button>
                        </div>
                    @else
                        <div class="card-body">
                            <form id="orderForm">
                                <div class="form-group mb-3">
                                    <label for="phone" class="form-label">Số điện thoại*</label>
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                        placeholder="Nhập số điện thoại" required>
                                    <div id="phoneError" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="phone" class="form-label">Nhập Email*</label>
                                    <input type="tel" class="form-control" id="email" name="email" placeholder="Nhập email"
                                        required>
                                    <div id="emailError" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="address" class="form-label">Nhập họ tên*</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên"
                                        required>
                                    <div id="nameError" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="address" class="form-label">Địa chỉ nhận hàng*</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Nhập địa chỉ chi tiết" required>
                                    <div id="addressError" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="note" class="form-label">Ghi chú</label>
                                    <textarea class="form-control" id="note" name="note" rows="3"
                                        placeholder="Ghi chú về đơn hàng (nếu có)"></textarea>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>

                <!-- Phương thức thanh toán -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-credit-card me-2"></i>Phương thức thanh toán</h5>
                    </div>
                    <div class="card-body">
                        <div class="payment-method selected">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="cod" checked>
                                <label class="form-check-label fw-bold" for="cod">
                                    Thanh toán khi nhận hàng (COD)
                                </label>
                            </div>
                        </div>
                        <div class="payment-method">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="banking">
                                <label class="form-check-label fw-bold" for="banking">
                                    Chuyển khoản ngân hàng
                                </label>
                            </div>
                            <div class="mt-2 ps-4">
                                <p class="mb-1">Ngân hàng: Vietcombank</p>
                                <p class="mb-1">Số tài khoản: 123456789</p>
                                <p class="mb-0">Chủ tài khoản: CÔNG TY TNHH ABC</p>
                            </div>
                        </div>
                        <div class="payment-method">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="momo">
                                <label class="form-check-label fw-bold" for="momo">
                                    Ví điện tử MoMo
                                </label>
                            </div>
                            <div class="mt-2 ps-4">
                                <img src="https://via.placeholder.com/100x30?text=MoMo" alt="MoMo" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tóm tắt đơn hàng -->
            <div class="col-lg-4">
                <div class="card sticky-top" style="top: 20px;">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Tóm tắt đơn hàng</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tạm tính:</span>
                            <span>{{number_format($tongtien, 0, ',', '.') . ' đ'}}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Giảm giá:</span>
                            <span id="giaSale" class="special">Nhập mã giảm giá</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Phí vận chuyển:</span>
                            <span>{{number_format($phi["giaphi"], 0, ',', '.') . ' đ'}}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>Tổng cộng:</span>
                            <span class="special" id="tongdh">{{number_format($soluong["tong"], 0, ',', '.') . ' đ'}}</span>
                        </div>
                        <hr>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="agreeTerms" checked>
                            <label class="form-check-label" for="agreeTerms">
                                Tôi đồng ý với <a href="#">điều khoản và điều kiện</a> của cửa hàng
                            </label>
                        </div>
                        <button class="btn btn-danger w-100 py-3 fw-bold" onclick="dathang()">ĐẶT HÀNG</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.appData = {
            tongTienGoc: {{ intval($soluong['tong'] ?? 0) }},
            id_ctsp: {{ $ctsp->id_ctsp }},
            id_phi: {{ $phi["idphi"] }},
            id_ctgh: {{ $soluong['id_ctgh']}},
            soluong: {{$soluong['soluong']}},
            id_giasale:{{-1}}
            };
    </script>
@endsection