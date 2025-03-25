@vite(['resources/scss/quanlysanpham.scss', 'resources/js/adminscript/qlsanpham.js'])
@include('admin.adminlayout.meta_admin')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="form-container">
    <h2>Chỉnh sửa sản phẩm</h2>
    <form>
        <div class="form-group">
            <label for="danhmuc">Chọn danh mục</label>
            <select id="danhmuc" aria-label="Default select example">
                @foreach ($danhmuccon as $dmc)
                    <option value="{{$dmc->id_ctdm}}">{{$dmc->ten}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="anh">Hình ảnh sản phẩm</label>
            <input type="text" id="anh" name="anh">
        </div>
        <div class="form-group">
            <label for="tensp">Tên sản phẩm</label>
            <input type="text" id="tensp" name="tensp" placeholder="Nhập tên sản phẩm">
        </div>
        <div class="form-group">
            <label for="tomtatsp">Tóm tắt sản phẩm</label>
            <textarea id="tomtatsp" name="tomtatsp" rows="3" placeholder="Nhập tóm tắt sản phẩm"></textarea>
        </div>
        <div class="">
            <label for="productInStock"><b>Còn hàng</b></label>
            <input type="checkbox" id="tinhtrang" name="tinhtrang" value="1">
        </div>
        <h2>Chỉnh sửa Chi tiết sản phẩm</h2>
        <div class="form-group">
            <label for="productWidth">Thương hiệu</label>
            <input type="text" id="thuonghieu" name="thuonghieu" placeholder="Thiên Long">
        </div>
        <div class="form-group">
            <label for="soluong">Số lượng trong kho</label>
            <input type="number" id="soluong" name="soluong" placeholder="Số lượng có trong kho">
        </div>
        <div class="form-group">
            <label for="mausac">Màu sắc</label>
            <select id="mausac" name="mausac">
                <option value="red">Đỏ</option>
                <option value="blue">Xanh dương</option>
                <option value="green">Xanh lá</option>
                <option value="yellow">Vàng</option>
                <option value="black">Đen</option>
                <option value="white">Trắng</option>
                <option value="transparent">Trong suốt</option>
            </select>
        </div>
        <div class="form-group">
            <label for="mamau">Mã màu sắc</label>
            <input type="text" id="mamau" name="mamau" placeholder="#FFFFFF,#00000">
        </div>
        <div class="form-group">
            <label for="dattinh">Đặt tính sản phẩm</label>
            <textarea id="dattinh" name="dattinh" rows="7" placeholder="Nhập mô tả sản phẩm"></textarea>
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
        <div class="form-group">
            <label for="chieurong">Chiều rộng (cm)</label>
            <input type="number" id="chieurong" name="chieurong" placeholder="Nhập chiều rộng">
        </div>
        <div class="form-group">
            <label for="chieucao">Chiều cao (cm)</label>
            <input type="number" id="chieucao" name="chieucao" placeholder="Nhập chiều cao">
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
        <button type="button" onclick="sendData()" class="btn-submit">Thêm sản phẩm</button>
    </form>
</div>