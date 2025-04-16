@vite(['resources/scss/quanlysanpham.scss', 'resources/js/adminscript/updateSanpham.js'])
@include('admin.adminlayout.meta_admin')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="form-container">
    <h2>Chỉnh sửa sản phẩm</h2>
    <form>
        <img src="{{$sp->anh}}" alt="{{$sp->tensp}}" width="100" height="100">
        <div class="form-group">
            <label for="danhmuc">Danh mục</label>
            <select id="danhmuc" name="danhmuc">
                @foreach ($danhmuc as $dmc)
                    <option value="{{$dmc->id_ctdm}}" {{$sp->id_ctdm == $dmc->id_ctdm ? 'selected' : '' }}>{{$dmc->ten}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="anh">Hình ảnh sản phẩm</label>
            <input type="text" id="anh" name="anh" value="{{$sp->anh}}">
        </div>
        <div class="form-group">
            <label for="tensp">Tên sản phẩm</label>
            <input type="text" id="tensp" name="tensp" value="{{$sp->tensp}}" placeholder="Nhập tên sản phẩm">
        </div>
        <div class="form-group">
            <label for="tomtatsp">Tóm tắt sản phẩm</label>
            <textarea id="tomtatsp" name="tomtatsp" rows="3"
                placeholder="Nhập tóm tắt sản phẩm">{{$sp->tomtatsp}}</textarea>
        </div>
        <div class="">
            <label for="productInStock"><b>Còn hàng</b></label>
            @if($sp->tinhtrang == 1)
                <input type="checkbox" id="tinhtrang" name="tinhtrang" value="1" checked>
            @else
                <input type="checkbox" id="tinhtrang" name="tinhtrang" value="0">
            @endif
        </div>
        <div class="form-group">
            <label for="soluong">Số lượng trong kho</label>
            <input type="number" id="soluong" name="soluong" value="{{$nhap->soluong}}"
                placeholder="Số lượng có trong kho">
        </div>
        <div class="form-group">
            <label for="gianhap">Giá nhập kho (VND)</label>
            <input type="number" id="gianhap" name="gianhap" value="{{$nhap->gianhap}}" placeholder="Nhập giá nhập kho">
        </div>
        <div class="form-group">
            <label for="giaban">Giá bán sản phẩm (VND)</label>
            <input type="number" id="giaban" name="giaban" value="{{$ban->giaban}}" placeholder="Nhập giá bán">
        </div>
        <div class="form-group">
            <label for="giasale">Giá khuyến mãi (VND)</label>
            <input type="number" id="giasale" name="giasale" placeholder="Nhập giá khuyến mãi">
        </div>
        <h2>Chỉnh sửa Chi tiết sản phẩm</h2>
        <div class="form-group">
            <label for="productWidth">Thương hiệu</label>
            <input type="text" id="thuonghieu" name="thuonghieu" value="{{$ctsp->thuonghieu}}" placeholder="Thiên Long">
        </div>
        <div class="form-group">
            <label for="productWidth">Xuất xứ</label>
            <input type="text" id="xuatsu" name="xuatsu" value="{{$ctsp->xuatsu}}">
        </div>
        <div class="form-group">
            <label for="productWidth">Sản xuất</label>
            <input type="text" id="sanxuat" name="sanxuat" value="{{$ctsp->sanxuat}}">
        </div>
        <div class="form-group">
            <label for="tieuchuan">Tiêu chuẩn</label>
            <input type="text" id="tieuchuan" name="tieuchuan" value="{{$ctsp->tieuchuan}}">
        </div>
        <div class="form-group">
            <label for="mausac">Màu sắc</label>
            @php
                $colors = [
                    'red' => 'Đỏ',
                    'blue' => 'Xanh dương',
                    'green' => 'Xanh lá',
                    'yellow' => 'Vàng',
                    'black' => 'Đen',
                    'white' => 'Trắng',
                    'transparent' => 'Trong suốt',
                ];
                $selectedColor = $ctsp->mausac; // Giá trị được chọn
            @endphp
            <select id="mausac" name="mausac">
                @foreach($colors as $value => $label)
                    <option value="{{ $value }}" {{ $selectedColor == $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="mamau">Mã màu sắc</label>
            <input type="text" id="mamau" name="mamau" placeholder="#FFFFFF,#00000">
        </div>
        <div class="form-group">
            <label for="dattinh">Đặt tính sản phẩm</label>
            <textarea id="dattinh" name="dattinh" rows="7"
                placeholder="Nhập mô tả sản phẩm">{{$ctsp->dattinh}}</textarea>
        </div>
        <div class="form-group">
            <label for="loiich">Lợi ích</label>
            <textarea id="loiich" name="loiich" placeholder="Nhập lợi ích sản phẩm">{{$ctsp->loiich}}</textarea>
        </div>
        <div class="form-group">
            <label for="tinhnang">Tính năng nổi bật</label>
            <textarea id="tinhnang" name="tinhnang"
                placeholder="Nhập tính năng sản phẩm">{{$ctsp->tinhnangnoibat}}</textarea>
        </div>
        <div class="form-group">
            <label for="kichthuoc">Kích thước</label>
            <input type="text" id="kichthuoc" name="kichthuoc" value="{{$ctsp->kichthuoc}}" placeholder="100mmx200mm">
        </div>
        <div class="form-group">
            <label for="doday">Độ dày (mm)</label>
            <input type="number" id="doday" name="doday" placeholder="0.03mm">
        </div>
        <div class="form-group">
            <label for="trongluong">Trọng lượng (gram)</label>
            <input type="number" id="trongluong" name="trongluong" placeholder="3 gram">
        </div>
        <div class="form-group">
            <label for="sotrang">Số trang</label>
            <input type="number" id="sotrang" name="sotrang" placeholder="Số trang">
        </div>
        <button type="button" onclick="updateData()" class="btn-submit">Cập nhật</button>
    </form>
</div>