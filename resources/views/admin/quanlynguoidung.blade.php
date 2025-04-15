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
                        <th><i class="bi bi-info-circle-fill"></i></th>
                        <th>Họ và tên <i class="bi bi-sort-alpha-up"></i></th>
                        <th>Ngày sinh</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Ngày đăng kí</th>
                        <th>Tình trạng tài khoản</th>
                        <th>Quyền truy cập</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($danhsachnguoidung as $nguoidung)
                        <tr>
                            <td><i class="bi bi-info-circle"></i></td>
                            <td>{{$nguoidung->hovaten ? $nguoidung->hovaten:"-----" }}</td>
                            <td>{{ $nguoidung->ngaysinh ? $nguoidung->ngaysinh:"------" }}</td>
                            <td>{{ $nguoidung->soDT ? $nguoidung->soDT:"------" }}</td>
                            <td>{{ $nguoidung->mail ? $nguoidung->mail:"------" }}</td>
                            <td>{{ $nguoidung->created_at ? $nguoidung->created_at:"------" }}</td>
                            <td>{{ $nguoidung->tinhtrantk ? $nguoidung->tinhtrantk:"------" }}</td>
                            <td>{{ $nguoidung->quyentruycap ? $nguoidung->quyentruycap:"------" }}</td>
                            <td>
                                {{-- <button class="btn btn-warning btn-sm me-1">Sửa</button> --}}
                                <button class="btn btn-danger btn-sm"><a
                                        class="delete_btn"><i class="bi bi-trash3-fill"></i></a></button>
                                <button class="btn btn-info btn-sm"><a class="edit_btn"><i
                                            class="bi bi-pencil-square"></i> Sửa</a></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection