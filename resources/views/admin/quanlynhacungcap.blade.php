@vite('resources/scss/qlphivanchuyen.scss')
@vite('resources/js/adminscript/QLnhacungcap.js')
@extends('admin.adminlayout.layout_admin')
@section('content')
@section('title', 'Quản lý phí vận chuyển')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách nhà cung cấp</h6>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addShippingModal">
                    <i class="bi bi-clipboard-plus-fill"></i> Thêm mới
                </button>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="shippingTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên nhà cung cấp</th>
                                <th>Liên hệ</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nhacc as $key => $fee)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $fee->ten }}</td>
                                    <td>{{ $fee->lienhe }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary edit-btn" data-id="{{ $fee->id_nhacungcap }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $fee->id_nhacungcap }}">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Shipping Modal -->
    <div class="modal fade" id="addShippingModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm nhà cung cấp</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addShippingForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tên nhà cung cấp</label>
                            <input type="text" name="ten" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Liên hệ</label>
                            <input type="text" name="lienhe" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Shipping Modal -->
    <div class="modal fade" id="editShippingModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sửa nhà cung cấp</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editShippingForm">
                    <input type="hidden" name="id_phi" id="edit_id_phi">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tên nhà cung cấp</label>
                            <input type="text" name="ten" id="edit_ten" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Liên hệ</label>
                            <input type="text" name="lienhe" id="edit_lienhe" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteShippingModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận xóa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa nhà cung cấp này?</p>
                    <input type="hidden" id="delete_id_phi">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Xóa</button>
                </div>
            </div>
        </div>
    </div>
@endsection