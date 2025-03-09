@vite(['resources/scss/listsp.scss'])
<div class="isotope-container row">
    @foreach ($sp as $s)
        <div class="col-md-4 col-lg-3 my-4">
            <!-- <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
                                                                                                                                        New
                                                                                                                                      </div> -->
            <div class="card position-relative">
                <a href="/sanpham/{{$s->tensp}}/{{$s->id_sp}}"><img src="{{$s->anh}}" class="img-fluid rounded-4 w-50 h-50"
                        alt="image"></a>
                <div class="card-body p-0">
                    <a href="/sanpham/{{$s->tensp}}/{{$s->id_sp}}">
                        <h5 class="card-title pt-4 m-0">{{$s->tensp}}</h5>
                    </a>
                    <div class="card-text">
                        <h3 class="secondary-font text-primary">{{$s->tomtatsp}} VNĐ</h3>

                        <div class="d-flex flex-wrap mt-3">
                            <a href="/sanpham/{{$s->tensp}}/{{$s->id_sp}}" class="btn-cart me-3 px-4 pt-3 pb-3">
                                <h5 class="text-uppercase m-0">Xem sản phẩm</h5>
                            </a>
                            <a href="/sanpham/{{$s->tensp}}/{{$s->id_sp}}" class="btn-wishlist px-4 pt-3 ">
                                <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @if ($sp instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="d-flex justify-content-center">
            {{ $sp->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>