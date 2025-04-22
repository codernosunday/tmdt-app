@vite(['resources/js/shop.js'])
@vite(['resources/scss/shop.scss'])
@extends('layouts.app')
@section('content')
@section('title', 'Văn Phòng Phẩm')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <section id="sp">
        <div class="container-fluid">
            <div class="row">
                <!-- Bộ lọc nằm sát trái -->
                <div class="col-md-3 px-3" style="border-right: 1px solid #ddd;">
                    <div class="card p-3 border-0">
                        <h4 class="mb-3">Lọc sản phẩm</h4>

                        <!-- Danh mục -->
                        <div class="mb-4">
                            <select id="danhmuc" name="danhmuc" class="form-select">
                                <option selected value="0">Tất cả</option>
                                @foreach ($danhmuccon as $dmc)
                                    <option value="{{ $dmc->id_ctdm }}">{{ $dmc->ten }}</option>
                                @endforeach
                            </select>
                        </div>

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

                        <!-- Lọc theo tên -->
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

                        <!-- Phân khúc giá -->
                        <div class="mb-3">
                            <h5>Phân khúc giá</h5>
                            <div class="form-check">
                                <input class="check-input" type="checkbox" id="giaduoi50k">
                                <label class="form-check-label" for="giaduoi50k">Dưới 50.000 VNĐ</label>
                            </div>
                            <div class="form-check">
                                <input class="check-input" type="checkbox" id="gia50k_200k">
                                <label class="form-check-label" for="gia50k_200k">50.000 - 200.000 VNĐ</label>
                            </div>
                            <div class="form-check">
                                <input class="check-input" type="checkbox" id="gia200k_100m">
                                <label class="form-check-label" for="gia200k_100m">200.000 - 1.000.000 VNĐ</label>
                            </div>
                            <div class="form-check">
                                <input class="check-input" type="checkbox" id="gia100m">
                                <label class="form-check-label" for="gia100m">Trên 1.000.000 VNĐ</label>
                            </div>
                        </div>

                        <!-- Thương hiệu -->
                        <div class="mb-3">
                            <h5>Thương hiệu</h5>
                            <div class="form-check">
                                <input class="check-input" type="checkbox" id="brandthienlong">
                                <label class="form-check-label" for="brandthienlong">Thiên Long</label>
                            </div>
                            <div class="form-check">
                                <input class="check-input" type="checkbox" id="brandFlexOffice">
                                <label class="form-check-label" for="brandFlexOffice">Flex Office</label>
                            </div>
                            <div class="form-check">
                                <input class="check-input" type="checkbox" id="brandColorKid">
                                <label class="form-check-label" for="brandColorKid">Color Kid</label>
                            </div>
                        </div>

                        <!-- Màu sắc -->
                        <div class="mb-3">
                            <h5>Màu sắc</h5>
                            <div class="d-flex flex-wrap gap-2">
                                <label class="color-box" style="background: red;"><input type="checkbox" hidden></label>
                                <label class="color-box" style="background: blue;"><input type="checkbox" hidden></label>
                                <label class="color-box" style="background: green;"><input type="checkbox" hidden></label>
                                <label class="color-box" style="background: black;"><input type="checkbox" hidden></label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Danh sách sản phẩm nằm bên phải -->
                <div class="col-md-9">
                    <div id="listsanpham">
                        <!-- Sản phẩm sẽ được render tại đây -->
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection