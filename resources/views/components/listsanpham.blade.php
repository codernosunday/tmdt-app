@vite(['resources/js/listspscript/listsp.js'])
@vite(['resources/scss/listsp.scss'])
<section id="foodies" class="my-5">
    <div class="container my-5 py-5">
        <div class="section-header d-md-flex justify-content-between align-items-center">
            <h2 class="display-3 fw-normal">Văn phòng phẩm</h2>
            <div class="mb-4 mb-md-0">
                <div class="container mt-3 text-center">
                    <div class="container mt-3 text-center">
                        <select id="Danhmuc" class="form-select" aria-label="Default select example">
                            <option selected value={{0}}>All</option>
                            @foreach ($danhmuccon as $dmc)
                                <option value="{{$dmc->id_ctdm}}">{{$dmc->ten}}</option>
                            @endforeach
                        </select>
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
        <div id="sanpham">
            {{-- @include('components.sanpham') --}}
        </div>
    </div>
</section>