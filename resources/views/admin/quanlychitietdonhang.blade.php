@vite('resources/scss/quanlysanpham.scss')
@vite('resources/js/adminscript/mainQLSP.js')
@extends('admin.adminlayout.layout_admin')
@section('content')
@section('title', 'Quản lý sản phẩm')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <div class="d-flex justify-content-end align-items-center mb-3">
            <form action="/administrator/pdf" method="post">
                @csrf
                <input type="hidden" value="{{$data['donhang']['id_hoadon']}}" name="id">
                <input type="submit" class="btn btn-success btn-sm" value="In đơn hàng" name="export_pdf">
            </form>
        </div>
        <div>
            <p>Tên người dùng: {{$data['donhang']['hoten']}}</p>
            <p>Email: {{$data['donhang']['email']}}</p>
            <p>Địa chỉ: {{$data['donhang']['diachigiaohang']}}</p>
            <p>Số điện thoại: {{$data['donhang']['sodt']}}</p>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table_color">
                    <tr>
                        <th>Tên sản phẩm</i></th>
                        <th>Ảnh</th>
                        <th>Thương hiệu</th>
                        <th>Xuất xứ</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        {{-- <th>Thao tác</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['chitietdonhang'] as $chitiet)
                        <tr>
                            <td>{{$chitiet["thongtinsp"]["tensp"]}}</td>
                            <td><img src="{{$chitiet['thongtinsp']['anh']}}" alt=""></td>
                            <td>{{$chitiet["chitietsanpham"]["thuonghieu"]}}</td>
                            <td>{{$chitiet["chitietsanpham"]["xuatsu"]}}</td>
                            <td>{{$chitiet["soluong"]}}</td>
                            <td>{{$chitiet["thanhtien"]}}</td>
                            {{-- <td>

                                <button class="btn btn-danger btn-sm"><a class="delete_btn"><i
                                            class="bi bi-trash3-fill"></i></a></button>
                                <button class="btn btn-info btn-sm"><a class="edit_btn" href=""><i
                                            class="bi bi-pencil-square"></i> Sửa</a></button>
                                <button class="btn btn-info btn-sm"><a class="edit_btn" href=""><i
                                            class="bi bi-pencil-square"></i>
                                        Thêm chi tiết sản phẩm</a></button>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection