@vite('resources/scss/quanlysanpham.scss')
@vite('resources/js/adminscript/mainQLSP.js')
@extends('admin.adminlayout.layout_admin')
@section('content')
@section('title', 'Quản lý sản phẩm')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="danhmuc" class="form-label">Danh mục sản phẩm</label>
                <select id="danhmuc" class="form-select">
                    <option value="all">Tất cả</option>
                    @foreach($danhmucs as $dm)
                        <option value="{{ $dm->id_ctdm }}">{{ $dm->ten }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="trangthai" class="form-label">Trạng thái hàng</label>
                <select id="trangthai" class="form-select">
                    <option value="all">Tất cả</option>
                    <option value="conhang">Còn hàng</option>
                    <option value="hethang">Hết hàng</option>
                    <option value="an">Ẩn</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="search" class="form-label">Tìm kiếm sản phẩm</label>
                <div class="input-group">
                    <input type="text" id="search" name="timkiem" class="form-control" placeholder="Nhập tên sản phẩm...">
                    <button class="btn btn-primary" id="btnSearch" onclick="searchProduct()" type="button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <div id="listsanpham">

            </div>
        </div>
    </div>
@endsection