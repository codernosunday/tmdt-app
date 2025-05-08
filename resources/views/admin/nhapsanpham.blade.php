@vite('resources/scss/qlphivanchuyen.scss')
@vite('resources/js/adminscript/QLgianhap.js')
@extends('admin.adminlayout.layout_admin')
@section('content')
@section('title', 'Giá nhập')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách giá nhập của {{$sp->tensp}} </h6>
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
                                <th>Giá nhập</th>
                                <th>Số lượng nhập</th>
                                <th>Nhà cung cấp</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gianhap as $i)
                                <tr>
                                    <td>{{ number_format($i->gianhap, 0, ',', '.') }} đ</td>
                                    <td>{{$i->soluong}}</td>
                                    <td>{{ $i->nhacungcap ? $i->nhacungcap->ten : 'Đang cập nhật' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary edit-btn"
                                            data-id="{{ $i->id_gianhap }}"><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-sm btn-danger delete-btn"
                                            data-id="{{ $i->id_gianhap }}"><i class="bi bi-trash3-fill"></i></button>
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
                    <h5 class="modal-title" id="addGiasaleModalLabel">Thêm giá nhập</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addGiasaleForm">
                    <div class="modal-body">
                        <input type="hidden" id="id_sanpham" name="id_sanpham" value="{{$sp->id_sp}}">
                        <select class="form-control" id="chitietsanpham" name="chitietsanpham" required>
                            <option value="">-- Chọn chi tiết sản phẩm --</option>
                            @foreach ($ctsp as $ct )
                            <option value="{{$ct->id_ctsp}}">{{$sp->tensp}} loại {{$ct->id_ctsp}}</option>
                            @endforeach
                        </select>
                        <div class="mb-3">
                            <label for="gianhap" class="form-label">Giá nhập</label>
                            <input type="text" class="form-control" id="gianhap" name="gianhap" required>
                        </div>
                        <div class="mb-3">
                            <label for="soluong" class="form-label">Số lượng</label>
                            <input type="text" class="form-control" id="soluong" name="soluong" required>
                        </div>
                        <div class="mb-3">
                            <label for="nhacungcap" class="form-label">Nhà cung cấp</label>
                            <select class="form-control" id="nhacungcap" name="nhacungcap" required>
                                <option value="">-- Chọn nhà cung cấp --</option>
                                @foreach ($nhacungcap as $ncc )
                                <option value="{{$ncc->id_nhacungcap}}">{{$ncc->ten}}</option>
                                @endforeach
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

    <!-- Modal Sửa -->
    <div class="modal fade" id="editGiasaleModal" tabindex="-1" aria-labelledby="editGiasaleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGiasaleModalLabel">Sửa giá nhập sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editGiasaleForm">
                    <div class="modal-body">
                        <input type="hidden" id="edit_id_gianhap" name="id_gianhap">
                        <input type="hidden" id="edit_id_sanpham" name="id_sanpham">
                        <div class="mb-3">
                            <label for="edit_chitietsanpham" class="form-label">Chi tiết sản phẩm</label>
                            <select class="form-control" id="edit_chitietsanpham" name="chitietsanpham" required>
                                <option value="">-- Chọn chi tiết sản phẩm --</option>
                                @foreach ($ctsp as $ct)
                                    <option value="{{ $ct->id_ctsp }}">{{ $sp->tensp }} loại {{ $ct->id_ctsp }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="mb-3">
                            <label for="edit_nhacungcap" class="form-label">Nhà cung cấp</label>
                            <select class="form-control" id="edit_nhacungcap" name="nhacungcap" required>
                                <option value="">-- Chọn nhà cung cấp --</option>
                                @foreach ($nhacungcap as $ncc)
                                    <option value="{{ $ncc->id_nhacungcap }}">{{ $ncc->ten }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="mb-3">
                            <label for="edit_gianhap" class="form-label">Giá nhập</label>
                            <input type="number" class="form-control" id="edit_gianhap" name="gianhap" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="edit_soluong" class="form-label">Số lượng</label>
                            <input type="number" class="form-control" id="edit_soluong" name="soluong" required>
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