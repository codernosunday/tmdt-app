@vite('resources/scss/quanlysanpham.scss')
@vite('resources/js/adminscript/quanlynguoidung/capnhatnguoidung.js')
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
                            <td ondblclick="editCell(this)" key="hovaten" id="{{$nguoidung->id_nd}}">{{$nguoidung->hovaten ? $nguoidung->hovaten:"-----" }}</td>
                            <td ondblclick="editCell(this)" key="ngaysinh" id="{{$nguoidung->id_nd}}">{{ $nguoidung->ngaysinh ? $nguoidung->ngaysinh:"------" }}</td>
                            <td ondblclick="editCell(this)" key="sodt" id="{{$nguoidung->id_nd}}">{{ $nguoidung->soDT ? $nguoidung->soDT:"------" }}</td>
                            <td key="mail" id="{{$nguoidung->id_nd}}">{{ $nguoidung->mail ? $nguoidung->mail:"------" }}</td>
                            <td key="ngaytao" id="{{$nguoidung->id_nd}}">{{ $nguoidung->created_at ? $nguoidung->created_at:"------" }}</td>
                            <td ondblclick="editCell(this)" key="tinhtrantk" id="{{$nguoidung->id_nd}}">{{ $nguoidung->tinhtrantk ? $nguoidung->tinhtrantk:"------" }}</td>
                            <td ondblclick="editCell(this)" key="quyentruycap" id="{{$nguoidung->id_nd}}">{{ $nguoidung->quyentruycap ? $nguoidung->quyentruycap:"------" }}</td>
                            <td>
                                {{-- <button class="btn btn-warning btn-sm me-1">Sửa</button> --}}
                                <form action="xoanguoidung" method='post'>
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $nguoidung->id_nd }}">
                                    <button class="btn btn-danger btn-sm me-1"><i class="bi bi-trash3-fill"></i></button>
                                </form>
                                <button class="btn btn-info btn-sm" onClick="suanguoidung({{$nguoidung->id_nd}})"><a class="edit_btn"><i
                                            class="bi bi-pencil-square"></i> Sửa</a></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if (session('DeleteSuccess'))
        <script>
            alert("{{ session('DeleteSuccess') }}");
        </script>
    @endif

    @if (session('DeleteFail'))
        <script>
            alert("{{ session('DeleteFail') }}");
        </script>
    @endif
@endsection

