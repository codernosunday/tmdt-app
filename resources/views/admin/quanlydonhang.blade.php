@vite('resources/scss/quanlysanpham.scss')
@vite('resources/js/adminscript/mainQLSP.js')
@extends('admin.adminlayout.layout_admin')
@section('content')
@section('title', 'Quản lý sản phẩm')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table_color">
                    <tr>
                        <th>Họ tên <i class="bi bi-sort-alpha-up"></i></th>
                        <th>Số điện thoại</th>
                        <th>Ngày đặt hàng</th>
                        <th>Địa chỉ</th>
                        <th>Khu vực</th>
                        <th>Trạng thái đơn hàng</th>
                        <th>Hình thức thanh toán</th>
                        <th>Ghi chú</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($danhsachdonhang as $donhang)
                        <tr>
                            <td>{{$donhang["hoten"]}}</td>
                            <td>{{$donhang["sodt"]}}</td>
                            <td>{{$donhang["created_at"]}}</td>
                            <td>{{$donhang["diachigiaohang"]}}</td>
                            <td>{{$donhang["vanchuyen"]["khuvuc"]}}</td>
                            <td>{{$donhang["trangthaidonhang"]}}</td>
                            <td>{{$donhang["hinhthucthanhtoan"]}}</td>
                            <td>{{$donhang["ghichu"] ? $donhang["ghichu"]:"Không có"}}</td>
                            <td>
                                {{-- <button class="btn btn-warning btn-sm me-1">Sửa</button> --}}
                                <button class="btn btn-danger btn-sm"><a
                                        class="delete_btn"><i class="bi bi-trash3-fill"></i></a></button>
                                <button class="btn btn-info btn-sm"><a class="edit_btn" href=""><i
                                            class="bi bi-pencil-square"></i> Sửa</a></button>
                                <button class="btn btn-info btn-sm"><a class="edit_btn"
                                        href="/administrator/quanlychitietdonhang/{{$donhang['id_hoadon']}}"><i class="bi bi-pencil-square"></i></a></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection