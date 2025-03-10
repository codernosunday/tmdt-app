@vite('resources/scss/quanlysanpham.scss')
@extends('admin.adminlayout.layout_admin')
@section('content')
@section('title', 'Quản lý sản phẩm')
    <div class="container">
        <h2 class="my-4 text-center">Danh sách sản phẩm</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Tóm tắt sản phẩm</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sp as $i)
                        <tr>
                            <td>{{$i->id_sp}}</td>
                            <td>{{$i->tensp}}</td>
                            <td class="summary">{{$i->tomtatsp}}</td>
                            <td>{{$i->created_at}}</td>
                            <td>{{$i->updated_at}}</td>
                            <td>
                                <button class="btn btn-warning btn-sm me-1">Sửa</button>
                                <button class="btn btn-danger btn-sm">Xóa</button>
                                <button class="btn btn-info btn-sm">Chi tiết sản phẩm</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection