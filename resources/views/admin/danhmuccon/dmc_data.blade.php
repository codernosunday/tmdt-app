<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="table_color">
            <tr>
                <th><i class="bi bi-info-circle-fill"></i></th>
                <th>Tên danh mục con<i class="bi bi-sort-alpha-up"></i></th>
                <th>Danh mục cha<i class="bi bi-sort-alpha-up"></i></th>
                <th>Ghi chú</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dmcon as $i)
                <tr>
                    <td><i class="bi bi-info-circle"></i></td>
                    <td>{{$i->ten}}</td>
                    <td>{{ $i->danhmuccha->tendanhmuc ?? 'Không thuộc danh mục nào' }}</td>
                    <td>{{$i->ghichu}}</td>
                    <td>
                        {{-- <button class="btn btn-warning btn-sm me-1">Sửa</button> --}}
                        <button class="btn btn-danger btn-sm" onclick="deleteSP({{$i->id_ctdm}}) "><a class="delete_btn"><i
                                    class="bi bi-trash3-fill"></i></a></button>
                        <button class="btn btn-info btn-sm"><a class="edit_btn" href="quanlysanpham/1"><i
                                    class="bi bi-pencil-square"></i> Sửa</a></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {!! $dmcon->links('pagination::bootstrap-4') !!}
</div>