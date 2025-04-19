@vite('resources/scss/qlphivanchuyen.scss')
@vite('resources/js/adminscript/QLphivanchuyen.js')
@extends('admin.adminlayout.layout_admin')
@section('content')
@section('title', 'Quản lý phí vận chuyển')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách Phí Vận Chuyển</h6>
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
                                <th>Khu vực</th>
                                <th>Phương thức</th>
                                <th>Giá phí</th>
                                <th>Ghi chú</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shippingFees as $key => $fee)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $fee->khuvuc }}</td>
                                    <td>{{ $fee->phuongthuc }}</td>
                                    <td>{{ number_format($fee->giaphi) }} đ</td>
                                    <td>{{ $fee->ghichu }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary edit-btn" data-id="{{ $fee->id_phi }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $fee->id_phi }}">
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
                    <h5 class="modal-title">Thêm Phí Vận Chuyển</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addShippingForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Khu vực</label>
                            <input type="text" name="khuvuc" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Phương thức</label>
                            <select name="phuongthuc" class="form-control" required>
                                <option value="">Chọn phương thức</option>
                                <option value="Giao hàng nhanh">Giao hàng nhanh</option>
                                <option value="Giao hàng tiêu chuẩn">Giao hàng tiêu chuẩn</option>
                                <option value="Giao hàng tiết kiệm">Giao hàng tiết kiệm</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Giá phí (VND)</label>
                            <input type="number" name="giaphi" class="form-control" min="0" required>
                        </div>
                        <div class="form-group">
                            <label>Ghi chú</label>
                            <textarea name="ghichu" class="form-control" rows="3"></textarea>
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
                    <h5 class="modal-title">Sửa Phí Vận Chuyển</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editShippingForm">
                    {{-- @csrf
                    @method('PUT') --}}
                    <input type="hidden" name="id_phi" id="edit_id_phi">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Khu vực</label>
                            <input type="text" name="khuvuc" id="edit_khuvuc" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Phương thức</label>
                            <select name="phuongthuc" id="edit_phuongthuc" class="form-control" required>
                                <option value="">Chọn phương thức</option>
                                <option value="Giao hàng nhanh">Giao hàng nhanh</option>
                                <option value="Giao hàng tiêu chuẩn">Giao hàng tiêu chuẩn</option>
                                <option value="Giao hàng tiết kiệm">Giao hàng tiết kiệm</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Giá phí (VND)</label>
                            <input type="number" name="giaphi" id="edit_giaphi" class="form-control" min="0" required>
                        </div>
                        <div class="form-group">
                            <label>Ghi chú</label>
                            <textarea name="ghichu" id="edit_ghichu" class="form-control" rows="3"></textarea>
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
                    <p>Bạn có chắc chắn muốn xóa phí vận chuyển này?</p>
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