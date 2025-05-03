@vite('resources/scss/quanlydanhmuc.scss')
@vite('resources/js/adminscript/mainQLDMC.js')
@extends('admin.adminlayout.layout_admin')
@section('content')
@section('title', 'Quản lý danh mục cha')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container my-4">
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-header">
                    <tr>
                        <th class="text-center" style="width: 50px;"><i class="bi bi-info-circle-fill"></i></th>
                        <th>Tên danh mục <i class="bi bi-sort-alpha-up"></i></th>
                        <th>Ghi chú</th>
                        <th class="text-center" style="width: 180px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dmcha as $i)
                        <tr>
                            <td class="text-center"><i class="bi bi-info-circle"></i></td>
                            <td ondblclick="editCell(this)" data-field="ten">{{$i->tendanhmuc}}</td>
                            <td ondblclick="editCell(this)" data-field="ghichu">{{$i->ghichu}}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-danger me-1" onclick="deleteDanhmuc({{$i->id_dm}})">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                                <button class="btn btn-sm btn-primary" onclick="saveRow(this,{{$i->id_dm}})">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row mt-5">
            <div class="col-md-6 mx-auto">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white text-center fw-bold">
                        Thêm Mới Danh Mục
                    </div>
                    <div class="card-body">
                        <form id="addDanhmucForm">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tên danh mục:</label>
                                <input type="text" class="form-control" id="themtendanhmuc" name="tendanhmuc" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Ghi chú:</label>
                                <textarea class="form-control" id="themghichu" name="ghichu" rows="3"></textarea>
                            </div>
                            <button type="button" onclick="postthemmoi()" class="btn btn-success w-100 fw-bold">
                                Thêm mới
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection