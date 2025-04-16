@vite(['resources/scss/quanlysanpham.scss', 'resources/js/adminscript/themCTSPmoi.js'])
@include('admin.adminlayout.meta_admin')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="form-container">
    <h2> Thêm chi tiết sản phẩm</h2>
    <form>
        <img src="{{$sp->anh}}" alt="{{$sp->tensp}}" width="100" height="100">
        <div class="form-group">
            <label for="tensp">Tên sản phẩm: {{$sp->tensp}}</label>
        </div>
        <h3>Thêm chi tiết sản phẩm</h3>
        <div class="form-group">
            <label for="anh">Ảnh chi tiết sản phẩm</label>
            <input type="text" id="anh" name="anh">
        </div>
        <div class="form-group">
            <label for="soluong">Số lượng trong kho</label>
            <input type="number" id="soluong" name="soluong" placeholder="Số lượng có trong kho">
        </div>
        <div class="form-group">
            <label for="gianhap">Giá nhập kho (VND)</label>
            <input type="number" id="gianhap" name="gianhap" placeholder="Nhập giá nhập kho">
        </div>
        <div class="form-group">
            <label for="giaban">Giá bán sản phẩm (VND)</label>
            <input type="number" id="giaban" name="giaban" placeholder="Nhập giá bán">
        </div>
        <div class="form-group">
            <label for="giasale">Giá khuyến mãi (VND)</label>
            <input type="number" id="giasale" name="giasale" placeholder="Nhập giá khuyến mãi">
        </div>
        <div class="form-group">
            <label for="productWidth">Thương hiệu</label>
            <input type="text" id="thuonghieu" name="thuonghieu" placeholder="Thiên Long">
        </div>
        <div class="form-group">
            <label for="productWidth">Xuất xứ</label>
            <input type="text" id="xuatsu" name="xuatsu">
        </div>
        <div class="form-group">
            <label for="productWidth">Sản xuất</label>
            <input type="text" id="sanxuat" name="sanxuat">
        </div>
        <div class="form-group">
            <label for="tieuchuan">Tiêu chuẩn</label>
            <input type="text" id="tieuchuan" name="tieuchuan">
        </div>
        <div class="form-group">
            <label for="mausac">Màu sắc</label>
            <select id="mausac" name="mausac">
                @foreach($thuoctinh as $i)
                    <option value="{{$i->id_thuoctinh}}">{{$i->mau}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="dattinh">Đặt tính sản phẩm</label>
            <textarea id="dattinh" name="dattinh" rows="7" placeholder="Nhập mô tả sản phẩm"></textarea>
        </div>
        <div class="form-group">
            <label for="loiich">Lợi ích</label>
            <textarea id="loiich" name="loiich" placeholder="Nhập lợi ích sản phẩm"></textarea>
        </div>
        <div class="form-group">
            <label for="tinhnang">Tính năng nổi bật</label>
            <textarea id="tinhnang" name="tinhnang" placeholder="Nhập tính năng sản phẩm"></textarea>
        </div>
        <div class="form-group">
            <label for="kichthuoc">Kích thước</label>
            <input type="text" id="kichthuoc" name="kichthuoc" placeholder="100mmx200mm">
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
        <button type="button" onclick="themCTmoi({{$sp->id_sp}})" class="btn-submit">Thêm chi tiết mới</button>
    </form>
</div>