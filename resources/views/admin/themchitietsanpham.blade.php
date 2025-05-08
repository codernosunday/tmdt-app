@vite(['resources/scss/themsanphamadmin.scss', 'resources/js/adminscript/themCTSPmoi.js'])
@include('admin.adminlayout.meta_admin')
<meta name="csrf-token" content="{{ csrf_token() }}">
<section>
    <div class="product-edit-container">
        <h2 class="form-title">Thêm mới chi tiết sản phẩm</h2>
        <form id="productForm">
            @csrf
            <div class="form-grid">
                <!-- Cột 1: Thông tin cơ bản -->
                <div class="form-column disabled-section">
                    <div class="form-group">
                        <label>Danh mục sản phẩm</label>
                        <div class="form-control-static">
                            {{ $danhmuccon->firstWhere('id_ctdm', $data["danhmuc"])?->ten ?? 'Không xác định' }}
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label>Trạng thái:</label>
                        <div class="form-control-static">
                            @switch($data["trangthai"])
                                @case("conhang") Còn hàng @break
                                @case("hethang") Hết hàng @break
                                @case("an") Ẩn @break
                                @default Không rõ
                            @endswitch
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <div class="form-control-static">{{ $data["tensp"] }}</div>
                    </div>
                
                    {{-- <div class="form-group">
                        <label>Đường link ảnh</label>
                        <div class="form-control-static">{{ $data["linkanh"] }}</div>
                    </div> --}}
                
                    <div class="form-group">
                        <label>Hình ảnh sản phẩm</label>
                        <div class="image-preview">
                            @if(isset($data['anhsp']))
                                <img src="{{ asset('storage/' . $data['anhsp']) }}" alt="Preview" style="max-height: 150px;">
                            @else
                                <span>Chưa có ảnh</span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label>Tóm tắt sản phẩm</label>
                        <div class="form-control-static" style="white-space: pre-line;">{{ $data["tomtat"] }}</div>
                    </div>
                </div>

                <!-- Cột 2: Thông tin kho và giá -->
                <div class="form-column">
                    <div class="form-group" style="display: none;">
                        <label for="soluong">Số lượng trong kho *</label>
                        <input type="number" id="soluong" name="soluong" value="0" class="form-control" placeholder="0"
                            min="0" required>
                    </div>

                    <div class="form-group" style="display: none;">
                        <label for="gianhap">Giá nhập (VND) *</label>
                        <input type="number" id="gianhap" name="gianhap" class="form-control" value="1" placeholder="0"
                            min="0" required>
                    </div>

                    <div class="form-group">
                        <label for="giaban">Giá bán (VND) *</label>
                        <input type="number" id="giaban" name="giaban" class="form-control" placeholder="0" min="0"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="giasale">Giá khuyến mãi (VND)</label>
                        <input type="number" id="giasale" name="giasale" class="form-control" placeholder="0" min="0">
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" id="tinhtrang" name="tinhtrang" class="form-check-input" value="1">
                        <label class="form-check-label" for="tinhtrang">Còn hàng</label>
                    </div>
                </div>

                <!-- Cột 3: Thông tin chi tiết -->
                <div class="form-column">
                    <div class="form-group">
                        <label for="thuonghieu">Thương hiệu</label>
                        <input type="text" id="thuonghieu" name="thuonghieu" class="form-control"
                            placeholder="Thiên Long">
                    </div>

                    <div class="form-group">
                        <label for="xuatsu">Xuất xứ</label>
                        <input type="text" id="xuatsu" name="xuatsu" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="sanxuat">Nơi sản xuất</label>
                        <input type="text" id="sanxuat" name="sanxuat" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="thuoctinh">Màu sắc</label>
                        <select id="thuoctinh" name="thuoctinh" class="form-control">
                            @foreach ($thuoctinh as $tt)
                                <option value="{{$tt->id_thuoctinh}}">{{$tt->mau}} {{$tt->mamau}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Khu vực textarea lớn -->
            <div class="form-group">
                <label for="dattinh">Khuyến cáo</label>
                <textarea id="dattinh" name="dattinh" class="form-control large-textarea"
                    placeholder="Mô tả chi tiết đặc tính sản phẩm"></textarea>
            </div>

            <div class="form-group">
                <label for="loiich">Lợi ích sản phẩm</label>
                <textarea id="loiich" name="loiich" class="form-control large-textarea"
                    placeholder="Các lợi ích khi sử dụng sản phẩm"></textarea>
            </div>

            <div class="form-group">
                <label for="tinhnang">Tính năng nổi bật</label>
                <textarea id="tinhnang" name="tinhnang" class="form-control large-textarea"
                    placeholder="Các tính năng đặc biệt của sản phẩm"></textarea>
            </div>

            <!-- Thông số kỹ thuật -->
            <h3 class="section-title">Thông số kỹ thuật</h3>
            <div class="specs-grid">
                <div class="form-group">
                    <label for="kichthuoc">Kích thước</label>
                    <input type="text" id="kichthuoc" name="kichthuoc" class="form-control" placeholder="100mm x 200mm">
                </div>

                <div class="form-group">
                    <label for="doday">Độ dày (mm)</label>
                    <input type="text" id="doday" name="doday" class="form-control" placeholder="0.03">
                </div>

                <div class="form-group">
                    <label for="trongluong">Trọng lượng (gram)</label>
                    <input type="text" id="trongluong" name="trongluong" class="form-control" placeholder="3">
                </div>

                <div class="form-group">
                    <label for="sotrang">Số trang</label>
                    <input type="number" id="sotrang" name="sotrang" class="form-control" placeholder="0">
                </div>

                <div class="form-group">
                    <label for="tieuchuan">Tiêu chuẩn chất lượng</label>
                    <input type="text" id="tieuchuan" name="tieuchuan" class="form-control">
                </div>
            </div>

            <div class="form-actions">
                <button type="button" onclick="themCTSP('{{ $data['id_sp'] }}')" class="btn-submit">Cập
                    nhật</button>
                <div id="formStatus" class="status-message"></div>
            </div>
        </form>
    </div>
</section>