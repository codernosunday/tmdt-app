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
                        <th>Tên sản phẩm <i class="bi bi-sort-alpha-up"></i></th>
                        <th>Ảnh</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sp as $i)
                        <tr>
                            <td><i class="bi bi-info-circle"></i></td>
                            <td>{{$i->tensp}}</td>
                            <td class="summary" id="anh">
                                <i class="bi bi-card-image"></i>
                                <div class="image-popup">
                                    <img src="{{$i->anh}}" alt="{{$i->tensp}}" class="img-fluid">
                                </div>
                            </td>
                            <td>{{$i->created_at}}</td>
                            <td>{{$i->updated_at}}</td>
                            <td>
                                {{-- <button class="btn btn-warning btn-sm me-1">Sửa</button> --}}
                                <button class="btn btn-danger btn-sm" onclick="deleteSP({{$i->id_sp}}) "><a
                                        class="delete_btn"><i class="bi bi-trash3-fill"></i></a></button>
                                <button class="btn btn-info btn-sm"><a class="edit_btn" href="quanlysanpham/{{$i->id_sp}}"><i
                                            class="bi bi-pencil-square"></i> Sửa</a></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection