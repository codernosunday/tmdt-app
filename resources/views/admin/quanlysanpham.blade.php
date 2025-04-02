@vite('resources/scss/quanlysanpham.scss')
@extends('admin.adminlayout.layout_admin')
@section('content')
@section('title', 'Quản lý sản phẩm')
    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Thông tin</th>
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
                                {{-- <button class="btn btn-warning btn-sm me-1">Sửa</button> --}}
                                <button class="btn btn-danger btn-sm"><a class="delete_btn"><i
                                            class="bi bi-trash3-fill"></i></a></button>
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