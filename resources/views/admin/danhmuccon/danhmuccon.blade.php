@vite('resources/scss/quanlydanhmuc.scss')
@vite('resources/js/adminscript/mainQLDMcon.js')
@extends('admin.adminlayout.layout_admin')

@section('title', 'Quản lý danh mục con')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container my-4" id="dmcon-container">
        {{-- Danh sách danh mục con --}}
        <div class="card shadow-sm border-0 mb-4 rounded-4">
            <div class="card-header bg-primary text-white fw-bold rounded-top-4">
                Danh sách Danh mục con
            </div>
            <div class="card-body p-4">
                @include('admin.danhmuccon.dmc_data')
            </div>
        </div>

        {{-- Form thêm danh mục con --}}
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-success text-white fw-bold rounded-top-4">
                Thêm Mới Danh Mục Con
            </div>
            <div class="card-body p-4">
                <form id="addDanhmucConForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tên danh mục con</label>
                            <input type="text" class="form-control" id="themtendmc" name="tendmc" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Danh mục cha</label>
                            <select class="form-select" id="themdmcha" name="dmcha" required>
                                <option value="">-- Chọn danh mục cha --</option>
                                @foreach ($dmcha as $cha)
                                    <option value="{{ $cha->id_dm }}">{{ $cha->tendanhmuc }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Ghi chú</label>
                            <textarea class="form-control" id="themghichu" name="ghichu" rows="3"></textarea>
                        </div>

                        <div class="col-12 text-end">
                            <button type="button" onclick="postThemDMC()" class="btn btn-success btn-lg rounded-3">
                                <i class="fas fa-plus"></i> Thêm mới
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection