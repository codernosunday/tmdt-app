@vite('resources/scss/quanlysanpham.scss')
@vite('resources/scss/quanlydanhmuc.scss')
@vite('resources/js/adminscript/thuoctinhSP.js')
@extends('admin.adminlayout.layout_admin')
@section('content')
@section('title', 'Quản lý danh mục cha')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table_color">
                    <tr>
                        <th><i class="bi bi-info-circle-fill"></i></th>
                        <th>Loại<i class="bi bi-sort-alpha-up"></i></th>
                        <th>kích thước</th>
                        <th>Màu</th>
                        <th>Mã màu</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($thuoctinh as $i)
                        <tr>
                            <td>
                                <div
                                    style="width: 15px; height: 15px; background-color: {{ $i->mamau }}; border: 1px solid #ccc;">
                                </div>
                            </td>
                            <td ondblclick="editCell(this)" data-field="loai">{{$i->loai}}</td>
                            <td ondblclick="editCell(this)" data-field="kichthuoc">{{$i->kichthuoc}}</td>
                            <td ondblclick="editCell(this)" data-field="mau">{{$i->mau}}
                            </td>
                            <td ondblclick="editCell(this)" data-field="mamau">{{$i->mamau}}</td>
                            <td>
                                {{-- <button class="btn btn-warning btn-sm me-1">Sửa</button> --}}
                                <button class="btn btn-danger btn-sm" onclick="deleteThuoctinh({{$i->id_thuoctinh}}) "><a
                                        class="delete_btn"><i class="bi bi-trash3-fill"></i></a></button>
                                <button class="btn btn-info btn-sm" onclick="saveRow(this,{{$i->id_thuoctinh}})">
                                    <div class="edit_btn"><i class="bi bi-pencil-square"></i></div>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="container mt-4">
            <h4 class="fw-bold">Thêm mới thuộc tính</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow-sm p-4 rounded border-0">
                        <form id="addDanhmucForm">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Loại:</label>
                                <input type="text" class="form-control" id="loai" name="loai" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Kích thước:</label>
                                <input type="text" class="form-control" required autocapitalize="off" id="kichthuoc"
                                    name="kichthuoc">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Màu:</label>
                                <input type="text" class="form-control" id="mau" name="mau" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Mã Màu:</label>
                                <input type="text" class="form-control" id="mamau" name="mamau" required>
                            </div>
                            <button type="button" onclick="postthemmoi()" class="btn btn-primary w-100">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection