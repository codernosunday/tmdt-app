@vite('resources/scss/quanlysanpham.scss')
@vite('resources/scss/quanlydanhmuc.scss')
@vite('resources/js/adminscript/mainQLDMC.js')
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
                        <th>Tên danh mục<i class="bi bi-sort-alpha-up"></i></th>
                        <th>Ghi chú</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dmcha as $i)
                        <tr>
                            <td><i class="bi bi-info-circle"></i></td>
                            <td ondblclick="editCell(this)" data-field="ten">{{$i->tendanhmuc}}</td>
                            <td ondblclick="editCell(this)" data-field="ghichu">{{$i->ghichu}}</td>
                            <td>
                                {{-- <button class="btn btn-warning btn-sm me-1">Sửa</button> --}}
                                <button class="btn btn-danger btn-sm" onclick="deleteDanhmuc({{$i->id_dm}}) "><a
                                        class="delete_btn"><i class="bi bi-trash3-fill"></i></a></button>
                                <button class="btn btn-info btn-sm" onclick="saveRow(this)">
                                    <div class="edit_btn"><i class="bi bi-pencil-square"></i> Sửa</div>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="container mt-4">
            <h4 class="fw-bold">Thêm Mới Danh Mục</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow-sm p-4 rounded border-0">
                        <form id="addDanhmucForm">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tên danh mục:</label>
                                <input type="text" class="form-control" id="themtendanhmuc" name="tendanhmuc" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Ghi chú:</label>
                                <textarea class="form-control" id="themghichu" name="ghichu" rows="3"></textarea>
                            </div>
                            <button type="button" onclick="postthemmoi()" class="btn btn-primary w-100">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection