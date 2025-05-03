@vite('resources/scss/qlphivanchuyen.scss')
@vite('resources/js/adminscript/QLgiasale.js')
@extends('admin.adminlayout.layout_admin')
@section('content')
@section('title', 'Quản lý phí khuyến mãi')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách các chương trình khuyến mãi</h6>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGiasaleModal">
                    <i class="bi bi-clipboard-plus-fill"></i> Thêm mới
                </button>
            </div>
            <!-- Danh sách chương trình khuyến mãi -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="giasaleTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Mã giảm giá</th>
                                <th>Giá sale</th>
                                <th>Trạng thái</th>
                                <th>Ngày kết thúc</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($giasales as $giasale)
                                <tr>
                                    <td>{{ $giasale->ten }}</td>
                                    <td>{{ $giasale->magiamgia }}</td>
                                    <td>{{ number_format($giasale->giasale, 0, ',', '.') }} đ</td>
                                    <td>{{$giasale->trangthai?'Đang diễn ra':'Đã kết thúc'}}</td>
                                    <td>{{ $giasale->ketthuc }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary edit-btn"
                                            data-id="{{ $giasale->id_giasale }}"><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-sm btn-danger delete-btn"
                                            data-id="{{ $giasale->id_giasale }}"><i class="bi bi-trash3-fill"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Thêm -->
    <div class="modal fade" id="addGiasaleModal" tabindex="-1" aria-labelledby="addGiasaleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGiasaleModalLabel">Thêm chương trình khuyến mãi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addGiasaleForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="ten" class="form-label">Tên chương trình</label>
                            <input type="text" class="form-control" id="ten" name="ten" required>
                        </div>
                        <div class="mb-3">
                            <label for="magiamgia" class="form-label">Mã giảm giá</label>
                            <input type="text" class="form-control" id="magiamgia" name="magiamgia" required>
                        </div>
                        <div class="mb-3">
                            <label for="giasale" class="form-label">Giá sale</label>
                            <input type="number" class="form-control" id="giasale" name="giasale" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-check-input" type="checkbox" id="trangthai" name="trangthai" value="1">
                            <label class="form-check-label" for="trangthai">
                                Áp dụng ngay
                            </label>
                        </div>
                        <div class="mb-3">
                            <label for="ketthuc" class="form-label">Ngày kết thúc</label>
                            <input type="date" class="form-control" id="ketthuc" name="ketthuc" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Sửa -->
    <div class="modal fade" id="editGiasaleModal" tabindex="-1" aria-labelledby="editGiasaleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGiasaleModalLabel">Sửa chương trình khuyến mãi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editGiasaleForm">
                    <div class="modal-body">
                        <input type="hidden" id="edit_id_giasale">
                        <div class="mb-3">
                            <label for="edit_ten" class="form-label">Tên chương trình</label>
                            <input type="text" class="form-control" id="edit_ten" name="ten" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_magiamgia" class="form-label">Mã giảm giá</label>
                            <input type="text" class="form-control" id="edit_magiamgia" name="magiamgia" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_giasale" class="form-label">Giá sale</label>
                            <input type="number" class="form-control" id="edit_giasale" name="giasale" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-check-input" type="checkbox" id="hoatdong" name="hoatdong" value="1">
                            <label class="form-check-label" for="hoatdong">
                                Hoạt động
                            </label>
                        </div>
                        <div class="mb-3">
                            <label for="edit_ketthuc" class="form-label">Ngày kết thúc</label>
                            <input type="date" class="form-control" id="edit_ketthuc" name="ketthuc" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection