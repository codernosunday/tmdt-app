<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="table_color">
            <tr>
                <th>Họ tên <i class="bi bi-sort-alpha-up"></i></th>
                <th>Số điện thoại</th>
                <th>Ngày đặt hàng</th>
                <th>Địa chỉ</th>
                <th>Khu vực</th>
                <th>Trạng thái đơn hàng</th>
                <th>Hình thức thanh toán</th>
                <th>Ghi chú</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($danhsachdonhang as $donhang)
                <tr id="{{$donhang['id_hoadon']}}">
                    <td>{{$donhang["hoten"]}}</td>
                    <td>{{$donhang["sodt"]}}</td>
                    <td>{{$donhang["created_at"]}}</td>
                    <td>{{$donhang["diachigiaohang"]}}</td>
                    <td>{{$donhang["vanchuyen"]["khuvuc"]}}</td>
                    <td ondblclick="editCell(this)" key="trangthaidonhang">{{$donhang["trangthaidonhang"]}}</td>
                    <td>{{$donhang["hinhthucthanhtoan"]}}</td>
                    <td>{{$donhang["ghichu"] ? $donhang["ghichu"] : "Không có"}}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <!-- Nút Xóa -->
                            {{-- <button class="btn btn-outline-danger btn-sm delete_btn" title="Xóa đơn hàng">
                                <i class="bi bi-trash3-fill"></i>
                            </button> --}}

                            <!-- Nút Sửa trạng thái -->
                            <button class="btn btn-outline-primary btn-sm" title="Sửa trạng thái"
                                onclick="suatrangthaidonhang({{ $donhang['id_hoadon'] }})">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <!-- Nút Chi tiết đơn hàng -->
                            <a href=" /administrator/quanlychitietdonhang/{{ $donhang['id_hoadon'] }}"
                                class="btn btn-outline-secondary btn-sm" title="Chi tiết đơn hàng"> <i
                                    class="bi bi-list-task"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>