<table class="table table-hover table-bordered align-middle">
    <thead class="table-header">
        <tr>
            <th class="text-center" style="width: 50px;"></th>
            <th>Tên sản phẩm <i class="bi bi-sort-alpha-up"></i></th>
            <th class="text-center" style="width: 100px;">Ảnh</th>
            <th class="text-center" style="width: 220px;">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sp as $i)
            <tr>
                <td class="text-center">
                    <a href="/administrator/gianhap/{{ $i->id_sp }}"><i class="bi bi-plus-circle"></i></a>
                </td>
                <td>{{$i->tensp}}</td>
                <td class="text-center summary">
                    <div class="image-container">
                        <img src="{{ $i->anhbase64 ? asset('storage/' . $i->anhbase64) : '' }}" alt="{{$i->tensp}}"
                            class="img-thumbnail product-thumb">
                    </div>
                </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-danger me-1" onclick="deleteSP({{$i->id_sp}})">
                        <i class="bi bi-trash3-fill"></i>
                    </button>
                    <a href="quanlysanpham/{{$i->id_sp}}" class="btn btn-sm btn-primary me-1">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <a href="/administrator/themchitietmoi/{{$i->id_sp}}" class="btn btn-sm btn-success">
                        <i class="bi bi-clipboard-plus-fill"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@if ($sp instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="d-flex justify-content-center">
        {{ $sp->links('pagination::bootstrap-4') }}
    </div>
@endif
<!-- Modal nhập hàng -->
{{-- <div class="modal fade" id="nhapHangModal" tabindex="-1" aria-labelledby="nhapHangModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nhapHangModalLabel">Nhập hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body">
                <form id="formNhapHang">
                    <input type="hidden" id="idSanPham" name="idSanPham">

                    <div class="mb-3">
                        <label for="giaNhap" class="form-label">Giá nhập</label>
                        <input type="number" class="form-control" id="giaNhap" name="giaNhap" required>
                    </div>

                    <div class="mb-3">
                        <label for="soLuong" class="form-label">Số lượng nhập</label>
                        <input type="number" class="form-control" id="soLuong" name="soLuong" required>
                    </div>

                    <div class="mb-3">
                        <label for="nhaCungCap" class="form-label">Nhà cung cấp</label>
                        <select class="form-select" id="nhaCungCap" name="nhaCungCap" required>
                            <option value="">Chọn nhà cung cấp</option>
                            @foreach($ncc as $n)
                            <option value="{{ $n->id_nhacungcap}}">{{ $n->ten }}</option>
                            @endforeach
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="submit" form="formNhapHang" class="btn btn-primary">Lưu</button>
            </div>
        </div>
    </div>
</div> --}}