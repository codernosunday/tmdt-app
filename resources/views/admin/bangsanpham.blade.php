<table class="table table-hover table-bordered align-middle">
    <thead class="table-header">
        <tr>
            <th class="text-center" style="width: 50px;"><i class="bi bi-info-circle-fill"></i></th>
            <th>Tên sản phẩm <i class="bi bi-sort-alpha-up"></i></th>
            <th class="text-center" style="width: 100px;">Ảnh</th>
            <th class="text-center" style="width: 220px;">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sp as $i)
            <tr>
                <td class="text-center"><i class="bi bi-eye-fill"></i></td>
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