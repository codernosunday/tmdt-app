@vite('resources/scss/quanlysanpham.scss')
@vite('resources/js/adminscript/mainQLDMcon.js')
@extends('admin.adminlayout.layout_admin')

@section('title', 'Quản lý danh mục con')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container" id="dmcon-container">
        {{-- Phần hiển thị danh sách danh mục con --}}
        @include('admin.danhmuccon.dmc_data')

        {{-- Form thêm danh mục con --}}
        <div class="container mt-4">
            <h4 class="fw-bold">Thêm Mới Danh Mục Con</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow-sm p-4 rounded border-0">
                        <form id="addDanhmucConForm">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tên danh mục con:</label>
                                <input type="text" class="form-control" id="themtendmc" name="tendmc" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Danh mục cha:</label>
                                <select class="form-select" id="themdmcha" name="dmcha" required>
                                    <option value="">-- Chọn danh mục cha --</option>
                                    @foreach ($dmcha as $cha)
                                        <option value="{{ $cha->id_dm }}">{{ $cha->tendanhmuc }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Ghi chú:</label>
                                <textarea class="form-control" id="themghichu" name="ghichu" rows="3"></textarea>
                            </div>

                            <button type="button" onclick="postThemDMC()" class="btn btn-primary w-100">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

    </script>
@endsection