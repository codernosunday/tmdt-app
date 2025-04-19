<div id="orderResult" style="">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Thông tin đơn hàng</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">Mã đơn hàng:</th>
                            <td id="orderId">{{$data["madh"]}}</td>
                        </tr>
                        <tr>
                            <th>Ngày đặt:</th>
                            <td id="orderDate">{{$data["ngaydat"]}}</td>
                        </tr>
                        <tr>
                            <th>Tình trạng:</th>
                            <td><span class="badge" id="orderStatus">{{$data["trangthai"]}}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Tổng tiền:</th>
                            <td id="orderTotal">{{number_format($data["tongtien"], 0, ',', '.') . ' đ'}}</td>
                        </tr>
                        <tr>
                            <th>Phương thức thanh toán:</th>
                            <td id="paymentMethod">{{$data["phuongthuc"]}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-user me-2"></i>Thông tin khách hàng</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">Họ tên:</th>
                            <td id="customerName">{{$data["hoten"]}}</td>
                        </tr>
                        <tr>
                            <th>Số điện thoại:</th>
                            <td id="customerPhone">{{$data["sodt"]}}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td id="customerEmail">{{$data["email"]}}</td>
                        </tr>
                        <tr>
                            <th>Địa chỉ:</th>
                            <td id="customerAddress">{{$data["diachi"]}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fas fa-truck me-2"></i>Trạng thái đơn hàng</h5>
        </div>
        <div class="card-body">
            <div class="order-status">
                <div class="step completed">
                    <h6>Đơn hàng {{$data["trangthai"]}}</h6>
                    <p class="text-muted mb-2">{{$data["ngay"]}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fas fa-box-open me-2"></i>Chi tiết đơn hàng</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="60%">Sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody id="orderItems">
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $data["anhsp"] ? asset('storage/' . $data["anhsp"]) : '' }}"
                                        alt="Product" class="product-img me-3">
                                    <div>
                                        <h6 class="mb-1">{{$data["tensp"]}}</h6>
                                        <p class="text-muted mb-0">Màu: {{$data["mau"]}}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{number_format($data["gia"], 0, ',', '.') . ' đ'}}</td>
                            <td>{{$data["soluong"]}}</td>
                            <td>{{number_format($data["thanhtiencthd"], 0, ',', '.') . ' đ'}}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Tạm tính:</th>
                            <td>{{number_format($data["tamtinh"], 0, ',', '.') . ' đ'}}</td>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end">Phí vận chuyển:</th>
                            <td>{{number_format($data["phivanchuyen"], 0, ',', '.') . ' đ'}}</td>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end">Giảm giá:</th>
                            <td>{{number_format($data["giasale"], 0, ',', '.') . ' đ'}}</td>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end">Tổng cộng:</th>
                            <td>{{number_format($data["tongtien"], 0, ',', '.') . ' đ'}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>