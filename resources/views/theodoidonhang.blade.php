@vite(['resources/js/theodoiDH.js'])
@vite(['resources/scss/theodoidonhang.scss'])
@extends('layouts.app')
@section('content')
@section('title', 'Xem đơn hàng')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h4 class="mb-0"><i class="fas fa-search me-2"></i>Kiểm tra đơn hàng</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" id="mahoandon" class="form-control" placeholder="Nhập mã đơn hàng">
                                    <button class="btn btn-primary" type="button" id="btnCheckOrder" onclick="kiemtradh()">
                                        <i class="bi bi-search"></i> Tra cứu
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Kết quả tra cứu (sẽ hiển thị khi có dữ liệu) -->
                        <div id="thongtindonhang"></div>
                        <!-- Thông báo khi không tìm thấy đơn hàng -->
                        <div id="orderNotFound" class="alert alert-warning text-center" style="display: none;">
                            <i class="fas fa-exclamation-triangle me-2"></i>Không tìm thấy đơn hàng. Vui lòng kiểm tra lại
                            mã đơn hàng.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection