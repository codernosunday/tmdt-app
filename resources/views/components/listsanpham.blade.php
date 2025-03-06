@vite(['resources/js/listspscript/listsp.js'])
@vite(['resources/scss/listsp.scss'])
<section id="foodies" class="my-5">
    <div class="container my-5 py-5">
        <div class="section-header d-md-flex justify-content-between align-items-center">
            <h2 class="display-3 fw-normal">Văn phòng phẩm</h2>
            <div class="mb-4 mb-md-0">
                {{-- <p class="m-0">
                    <button class="filter-button me-4  active" data-filter="*">ALL</button>
                    <button class="filter-button me-4 " data-filter=".cat">CAT</button>
                    <button class="filter-button me-4 " data-filter=".dog">DOG</button>
                    <button class="filter-button me-4 " data-filter=".bird">BIRD</button>
                </p> --}}
                <div class="container mt-3 text-center">
                    <div class="container mt-3 text-center">
                        <div class="category-container">
                            <span class="arrow me-3" onclick="scrollCategories(-1)">&#9665;</span>
                            <div class="category-wrapper">
                                <ul class="category-list" id="categoryList">
                                    <li class="category-item"><a href="/danhmuc/all">ALL</a></li>
                                    @foreach ($danhmuccon as $i)
                                        <li class="category-item"><a href="/danhmuc/{{$i->id_ctdm}}">{{$i->ten}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <span class="arrow ms-3" onclick="scrollCategories(1)">&#9655;</span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                    shop now
                    <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                        <use xlink:href="#arrow-right"></use>
                    </svg></a>
            </div>
        </div>
        <div class="isotope-container row">
            @foreach ($sp as $s)
                <div class="col-md-4 col-lg-3 my-4">
                    <!-- <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
                                    New
                                  </div> -->
                    <div class="card position-relative">
                        <a href="single-product.html"><img src="{{$s->anh}}" class="img-fluid rounded-4 w-50 h-50"
                                alt="image"></a>
                        <div class="card-body p-0">
                            <a href="single-product.html">
                                <h5 class="card-title pt-4 m-0">{{$s->tensp}}</h5>
                            </a>
                            <div class="card-text">
                                <h3 class="secondary-font text-primary">{{$s->tomtatsp}}</h3>

                                <div class="d-flex flex-wrap mt-3">
                                    <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                                        <h5 class="text-uppercase m-0">Add to Cart</h5>
                                    </a>
                                    <a href="#" class="btn-wishlist px-4 pt-3 ">
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
    </div>
</section>