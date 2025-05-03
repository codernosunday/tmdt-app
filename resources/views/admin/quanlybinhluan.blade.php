@extends('admin.adminlayout.layout_admin')
@section('content')
@section('title', 'Quản lý bình luận')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-header">
                <tr>
                    <th class="text-center" style="width: 50px;"><i class="bi bi-info-circle-fill"></i></th>
                    <th>Nội dung bình luận</th>
                    <th>Người dùng</th>
                    <th>Sản phẩm</th>
                    <th>Số sao </th>
                    <th class="text-center" style="width: 180px;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($binhluan as $i)
                    <tr>
                        <td class="text-center"><i class="bi bi-info-circle"></i></td>
                        <td data-field="ten">{{$i->noidungbinhluan}}</td>
                        <td data-field="tensp">{{$i->nguoidung->hovaten ? $i->nguoidung->hovaten : 'Ẩn danh'}}</td>
                        <td data-field="tensp">{{$i->sanpham->tensp}}</td>
                        <td data-field="ghichu">{{$i->sosao}}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-danger me-1" onclick="deleteBinhluan({{$i->id_bl}})">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function deleteBinhluan(id) {
            if (!confirm("Bạn có chắc chắn muốn xoá bình luận này không?")) {
                return; // Nếu người dùng bấm "Hủy", dừng xử lý
            }

            fetch(`/administrator/xoabinhluan/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Bình luận đã được xoá thành công', data);
                    // Tải lại trang
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Đã xảy ra lỗi khi xoá bình luận:', error);
                    alert("Đã xảy ra lỗi khi xoá. Vui lòng thử lại.");
                });
        }
    </script>
@endsection