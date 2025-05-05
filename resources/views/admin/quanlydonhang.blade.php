@vite('resources/scss/quanlysanpham.scss')
@vite('resources/js/adminscript/quanlydonhang/capnhattrangthaidonhang.js')
@extends('admin.adminlayout.layout_admin')
@section('content')
@section('title', 'Quản lý đơn hàng')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="filterStatus" class="form-label fw-bold">Lọc theo trạng thái đơn hàng:</label>
                <select id="filterStatus" class="form-select">
                    <option value="">-- Tất cả --</option>
                    <option value="chờ xác nhận">Chờ xác nhận</option>
                    <option value="đã xác nhận">Đã xác nhận</option>
                    <option value="đang giao hàng">Đang giao hàng</option>
                    <option value="đã giao hàng">Đã giao hàng</option>
                    <option value="đã hủy">Đã hủy</option>
                </select>
            </div>
        </div>
        <div id='bangdonhang'>
            @include('admin.bangdonhang')
        </div>
    </div>
@endsection