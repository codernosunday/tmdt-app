@vite(['resources/scss/themsanphamadmin.scss', 'resources/js/adminscript/updateSanpham.js'])
@include('admin.adminlayout.meta_admin')
<meta name="csrf-token" content="{{ csrf_token() }}">
<section>
    <div class="product-edit-container">
        <h2 class="form-title">Chỉnh sửa sản phẩm</h2>
        <form id="productForm">
            @csrf
            <div class="form-grid">
                <!-- Cột 1: Thông tin cơ bản -->
                <div class="form-column">
                    <div class="form-group">
                        <label for="danhmuc">Danh mục sản phẩm</label>
                        <select id="danhmuc" class="form-control">
                            @foreach ($danhmuccon as $dmc)
                                <option value="{{$dmc->id_ctdm}}" {{$dmc->id_ctdm == $data["danhmuc"] ? 'selected' : ''}}>
                                    {{$dmc->ten}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label d-block">Trạng thái:</label>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="trangthai" id="trangthai_con"
                                value="conhang" {{ $data["trangthai"] == "conhang" ? 'checked' : ''}}>
                            <label class="form-check-label" for="trangthai_con">Còn hàng</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="trangthai" id="trangthai_het"
                                value="hethang" {{ $data["trangthai"] == "hethang" ? 'checked' : ''}}>
                            <label class="form-check-label" for="trangthai_het">Hết hàng</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="trangthai" id="trangthai_an" value="an"
                                {{ $data["trangthai"] == "an" ? 'checked' : ''}}>
                            <label class="form-check-label" for="trangthai_an">Ẩn</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tensp">Tên sản phẩm *</label>
                        <input type="text" id="tensp" name="tensp" class="form-control" value="{{$data["tensp"]}}"
                            placeholder="Nhập tên sản phẩm" required>
                    </div>
                    <div class="form-group">
                        <label for="anh">Đường link ảnh</label>
                        <input class="form-control" type="text" id="anh" name="anh" value="{{$data["linkanh"]}}">
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh sản phẩm *</label>
                        <div class="image-upload-container">
                            <div class="image-preview" id="imagePreview">
                                <img id="previewImage"
                                    src="{{ isset($data['anhsp']) ? asset('storage/' . $data['anhsp']) : '' }}"
                                    alt="Preview" style="{{ isset($data['anhsp']) ? '' : 'display: none;' }}">
                                <span id="noImageText" style="{{ isset($data['anhsp']) ? 'display: none;' : '' }}">
                                    Chưa có ảnh
                                </span>
                            </div>
                            <div class="upload-actions">
                                <input type="file" id="anhupload" name="anhupload" accept="image/*"
                                    style="display: none;">
                                <button type="button" class="btn-upload"
                                    onclick="document.getElementById('anhupload').click()">Chọn ảnh</button>
                                <small class="file-info" id="fileInfo">Chấp nhận JPG, PNG (tối đa 2MB)</small>
                            </div>
                            <div class="invalid-feedback" id="imageError"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tomtatsp">Tóm tắt sản phẩm</label>
                        <textarea id="tomtatsp" name="tomtatsp" class="form-control" rows="3"
                            placeholder="Mô tả ngắn về sản phẩm">{{$data["tomtat"]}}</textarea>
                    </div>
                </div>

                <!-- Cột 2: Thông tin kho và giá -->
                <div class="form-column">
                    <div class="form-group">
                        <label for="thuoctinh">Chọn chi tiết sản phẩm:</label>
                        @if (count($ctsp) >= 1)
                            <select id="ctsp" name="ctsp" class="form-control">
                                @foreach ($ctsp as $i)
                                    <option value="{{$i->id_ctsp}}">Sản phẩm số {{$i->id_ctsp}}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="soluong">Số lượng trong kho *</label>
                        <input type="number" id="soluong" name="soluong" value="{{$data["soluong"]}}"
                            class="form-control" placeholder="0" min="0" required disabled>
                    </div>


                    <div class="form-group">

                        @if($data['gianhap'])
                            <label for="gianhap">Giá nhập (VND) *:
                                <a href="/administrator/gianhap/{{$data["id_sp"]}}">
                                    Nhập sản phẩm
                                </a>
                            </label>
                            <input type="number" id="gianhap" name="gianhap"
                                value="{{ number_format($data['gianhap'], 0, '', '') }}" class="form-control"
                                placeholder="0" min="0" required disabled>
                        @else
                            <label for="gianhap">
                                Chưa có giá nhập
                                <a href="/administrator/gianhap/{{$data["id_sp"]}}">
                                    Thêm mới tại đây
                                </a>
                            </label>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="giaban">Giá bán (VND) *</label>
                        <input type="number" id="giaban" name="giaban"
                            value="{{ number_format($data['giaban'], 0, '', '') }}" class="form-control" placeholder="0"
                            min="0" step="1000" required>
                    </div>

                    <div class="form-group" style="display: none;">
                        <label for="giasale">Giá khuyến mãi (VND)</label>
                        <input type="number" id="giasale" name="giasale" class="form-control" placeholder="0" min="0">
                    </div>

                    <div class="form-group form-check">

                        <input type="checkbox" id="tinhtrang" name="tinhtrang" class="form-check-input" value="1" {{ $data["tinhtrang"] ? 'checked' : '' }}>
                        <label class="form-check-label" for="tinhtrang">Còn hàng</label>
                    </div>
                </div>

                <!-- Cột 3: Thông tin chi tiết -->
                <div class="form-column">
                    <div class="form-group">
                        <label for="thuonghieu">Thương hiệu</label>
                        <input type="text" id="thuonghieu" name="thuonghieu" value="{{$data["thuonghieu"]}}"
                            class="form-control" placeholder="Thiên Long">
                    </div>

                    <div class="form-group">
                        <label for="xuatsu">Xuất xứ</label>
                        <input type="text" id="xuatsu" name="xuatsu" value="{{$data["xuatxu"]}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="sanxuat">Nơi sản xuất</label>
                        <input type="text" id="sanxuat" name="sanxuat" value="{{$data["sanxuat"]}}"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="thuoctinh">Màu sắc</label>
                        <select id="thuoctinh" name="thuoctinh" class="form-control">
                            @foreach ($thuoctinh as $tt)
                                <option value="{{ $tt->id_thuoctinh }}" {{ $data["ttinh"] == $tt->id_thuoctinh ? 'selected' : '' }}>
                                    {{ $tt->mau }} {{ $tt->mamau }}
                                </option>

                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Khu vực textarea lớn -->
            <div class="form-group">
                <label for="dattinh">Khuyến cáo</label>
                <textarea id="dattinh" name="dattinh" class="form-control large-textarea"
                    placeholder="Mô tả chi tiết đặc tính sản phẩm">{{$data["khuyencao"]}}</textarea>
            </div>

            <div class="form-group">
                <label for="loiich">Lợi ích sản phẩm</label>
                <textarea id="loiich" name="loiich" class="form-control large-textarea"
                    placeholder="Các lợi ích khi sử dụng sản phẩm">{{$data["loiich"]}}</textarea>
            </div>

            <div class="form-group">
                <label for="tinhnang">Tính năng nổi bật</label>
                <textarea id="tinhnang" name="tinhnang" class="form-control large-textarea"
                    placeholder="Các tính năng đặc biệt của sản phẩm">{{$data["tinhnangnoibat"]}}</textarea>
            </div>

            <!-- Thông số kỹ thuật -->
            <h3 class="section-title">Thông số kỹ thuật</h3>
            <div class="specs-grid">
                <div class="form-group">
                    <label for="kichthuoc">Kích thước</label>
                    <input type="text" id="kichthuoc" name="kichthuoc" value="{{$data["kichthuoc"]}}"
                        class="form-control" placeholder="100mm x 200mm">
                </div>

                <div class="form-group">
                    <label for="doday">Độ dày (mm)</label>
                    <input type="text" id="doday" name="doday" value="{{$data["doday"]}}" class="form-control"
                        placeholder="0.03">
                </div>

                <div class="form-group">
                    <label for="trongluong">Trọng lượng (gram)</label>
                    <input type="text" id="trongluong" name="trongluong" value="{{$data["trongluong"]}}"
                        class="form-control" placeholder="3">
                </div>

                <div class="form-group">
                    <label for="sotrang">Số trang (nếu có)</label>
                    <input type="number" id="sotrang" name="sotrang" value="{{$data["sotrang"]}}" class="form-control"
                        placeholder="0">
                </div>

                <div class="form-group">
                    <label for="tieuchuan">Tiêu chuẩn chất lượng</label>
                    <input type="text" id="tieuchuan" name="tieuchuan" value="{{$data["tieuchuan"]}}"
                        class="form-control">
                </div>
            </div>

            <div class="form-actions">
                <button type="button" onclick="updateData('{{ $data['id_sp'] }}')" class="btn-submit">Cập
                    nhật</button>
                <div id="formStatus" class="status-message"></div>
            </div>
        </form>
    </div>
</section>