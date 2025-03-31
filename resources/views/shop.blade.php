@vite(['resources/js/shop.js'])
@vite(['resources/scss/shop.scss'])
@extends('layouts.app')
@section('content')
@section('title', 'Văn Phòng Phẩm')
    <section id="sp">
        <div class="container">
            <div class="section-header d-md-flex justify-content-between align-items-center">
                <div class="mb-4 mb-md-0">
                    <div class="container mt-3 text-center">
                        <div class="d-flex align-items-center gap-2">
                            <select id="danhmuc" name="danhmuc" class="custom-select" aria-label="Default select example">
                                <option selected value="0">Tất cả</option>
                                @foreach ($danhmuccon as $dmc)
                                    <option value="{{ $dmc->id_ctdm }}">{{ $dmc->ten }}</option>
                                @endforeach
                            </select>
                            <!-- Nút lọc -->
                            <div class="container  text-center">
                                <button class="btn btn-outline-primary" id="toggleFilter"> <i class="bi bi-funnel-fill"></i>
                                    Lọc
                                    sản phẩm</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Bộ lọc sản phẩm (Ẩn mặc định) -->
        <div class="container mt-4 filter-box" id="filterBox">
            <div class="card p-3">
                <h4 class="mb-3">Lọc sản phẩm</h4>

                <!-- Lọc theo giá -->
                <div class="mb-3">
                    <h5>Giá</h5>
                    <div class="form-check">
                        <input class="check-input" type="radio" name="locgia" id="priceLowHigh">
                        <label class="form-check-label" for="priceLowHigh">Thấp → Cao</label>
                    </div>
                    <div class="form-check">
                        <input class="check-input" type="radio" name="locgia" id="priceHighLow">
                        <label class="form-check-label" for="priceHighLow">Cao → Thấp</label>
                    </div>
                </div>

                <!-- Lọc theo chữ cái -->
                <div class="mb-3">
                    <h5>Tên sản phẩm</h5>
                    <div class="form-check">
                        <input class="check-input" type="radio" name="Tensanpham" id="nameAZ">
                        <label class="form-check-label" for="nameAZ">A → Z</label>
                    </div>
                    <div class="form-check">
                        <input class="check-input" type="radio" name="Tensanpham" id="nameZA">
                        <label class="form-check-label" for="nameZA">Z → A</label>
                    </div>
                </div>
                <!-- Gía bán sản phẩm -->
                <div class="mb-3">
                    <h5>Phân khúc giá</h5>
                    <div class="form-check">
                        <input class="check-input" type="checkbox" id="duoi50k">
                        <label class="form-check-label" for="duoi50k">Dưới 50.000 VNĐ</label>
                    </div>
                    <div class="form-check">
                        <input class="check-input" type="checkbox" id="50k_200k">
                        <label class="form-check-label" for="50k_200k">Từ 50.000 VNĐ - 200.000 VNĐ</label>
                    </div>
                    <div class="form-check">
                        <input class="check-input" type="checkbox" id="200k_100m">
                        <label class="form-check-label" for="100m">Từ 200.000 VNĐ - 1.000.000 VNĐ</label>
                    </div>
                    <div class="form-check">
                        <input class="check-input" type="checkbox" id="100m">
                        <label class="form-check-label" for="100m">Trên 1.000.000 VNĐ </label>
                    </div>
                </div>
                <!-- Lọc theo thương hiệu -->
                <div class="mb-3">
                    <h5>Thương hiệu</h5>
                    <div class="form-check">
                        <input class="check-input" type="checkbox" id="thienlong">
                        <label class="form-check-label" for="thienlong">Thiên Long</label>
                    </div>
                    <div class="form-check">
                        <input class="check-input" type="checkbox" id="FlexOffice">
                        <label class="form-check-label" for="FlexOffice">Flex Office</label>
                    </div>
                    <div class="form-check">
                        <input class="check-input" type="checkbox" id="ColorKid">
                        <label class="form-check-label" for="ColorKid">Color Kid</label>
                    </div>
                </div>

                <!-- Lọc theo màu sắc -->
                <div class="mb-3">
                    <h5>Màu sắc</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <label class="color-box" style="background: red;">
                            <input type="checkbox" hidden>
                        </label>
                        <label class="color-box" style="background: blue;">
                            <input type="checkbox" hidden>
                        </label>
                        <label class="color-box" style="background: green;">
                            <input type="checkbox" hidden>
                        </label>
                        <label class="color-box" style="background: black;">
                            <input type="checkbox" hidden>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div id="listsanpham"></div>
    </section>


@endsection