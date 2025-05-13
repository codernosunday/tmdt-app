@vite('resources/scss/quanlysanpham.scss')
@vite('resources/js/adminscript/quanlynguoidung/capnhatnguoidung.js')
@extends('admin.adminlayout.layout_admin')
@section('content')
@section('title', 'Quản lý người dùng')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table_color">
                    <tr>
                        <th><i class="bi bi-info-circle-fill"></i></th>
                        <th>Họ và tên <i class="bi bi-sort-alpha-up"></i></th>
                        <th>Ngày sinh</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Ngày đăng kí</th>
                        <th>Tình trạng tài khoản</th>
                        <th>Quyền truy cập</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($danhsachnguoidung as $nguoidung)
                        <tr>
                            <td><i class="bi bi-info-circle"></i></td>
                            <td>{{ $nguoidung->hovaten ?? '-----' }}</td>
                            <td>{{ $nguoidung->ngaysinh ?? '------' }}</td>
                            <td>{{ $nguoidung->soDT ?? '------' }}</td>
                            <td>{{ $nguoidung->mail ?? '------' }}</td>
                            <td>{{ $nguoidung->created_at ?? '------' }}</td>
                            <td>{{ $nguoidung->tinhtrantk ?? '------' }}</td>
                            <td>{{ $nguoidung->quyentruycap ?? '------' }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <form action="xoanguoidung" method="post" class="m-0">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $nguoidung->id_nd }}">
                                        {{-- <button class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip"
                                            title="Xóa người dùng">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button> --}}
                                    </form>
                                    <button class="btn btn-outline-primary btn-sm"
                                        onclick="openEditModal({{ $nguoidung->id_nd }})" data-bs-toggle="modal"
                                        data-bs-target="#editUserModal" data-bs-toggle="tooltip" title="Chỉnh sửa">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal Sửa người dùng -->
        <div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="editUserForm">
                        <div class="modal-header">
                            <h5 class="modal-title">Chỉnh sửa thông tin người dùng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="edit_id">
                            <div class="mb-3">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="edit_hovaten">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ngày sinh</label>
                                <input type="date" class="form-control" id="edit_ngaysinh">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" id="edit_sodt">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="edit_mail">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tình trạng tài khoản</label>
                                <select class="form-select" id="edit_tinhtrantk">
                                    <option value="Đã kích hoạt">Đã kích hoạt</option>
                                    <option value="Đã khóa">Đã khóa</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Quyền truy cập</label>
                                <select class="form-select" id="edit_quyentruycap">
                                    <option value="admin">Quản trị</option>
                                    <option value="user">Người dùng</option>
                                    <option value="staff">Nhân viên</option>
                                </select>
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
    </div>

    @if (session('DeleteSuccess'))
        <script>alert("{{ session('DeleteSuccess') }}");</script>
    @endif

    @if (session('DeleteFail'))
        <script>alert("{{ session('DeleteFail') }}");</script>
    @endif

    <script>
        window.allUsers = @json($danhsachnguoidung);
    </script>
@endsection