@vite('resources/scss/quanlysanpham.scss')
@include('admin.adminlayout.meta_admin')
<div class="form-container">
    <h2>Chỉnh sửa sản phẩm</h2>
    <form>
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
            <label for="productWidth">Số lượng trong kho</label>
            <input type="text" id="soluong" name="soluong" placeholder="Số lượng có trong kho">
        </div>
        <div class="form-group">
            <label for="productColor">Màu sắc</label>
            <select id="productColor" name="productColor">
                <option value="red">Đỏ</option>
                <option value="blue">Xanh dương</option>
                <option value="green">Xanh lá</option>
                <option value="yellow">Vàng</option>
                <option value="black">Đen</option>
                <option value="white">Trắng</option>
                <option value="none">Trong suốt</option>
            </select>
        </div>
        <div class="form-group">
            <label for="productWidth">Mã màu sắc</label>
            <input type="text" id="mamau" name="mamau" placeholder="#FFFFFF,#00000">
        </div>
        <div class="form-group">
            <label for="productDescription">Đặt tính sản phẩm</label>
            <textarea id="productDescription" name="productDescription" rows="7"
                placeholder="Nhập mô tả sản phẩm"></textarea>
        </div>
        <div class="form-group">
            <label for="productWidth">Kích thước</label>
            <input type="text" id="kichthuoc" name="productWidth" placeholder="100mmx200mm">
        </div>
        <div class="form-group">
            <label for="productWidth">Độ dày (mm)</label>
            <input type="number" id="doday" name="productWidth" placeholder="0.03mm">
        </div>
        <div class="form-group">
            <label for="productWidth">Trọng lượng (gram)</label>
            <input type="number" id="trongluong" name="productWidth" placeholder="3 gram">
        </div>
        <div class="form-group">
            <label for="productWidth">Số trang</label>
            <input type="number" id="sotrang" name="productWidth" placeholder="Số trang">
        </div>
        <div class="form-group">
            <label for="productWidth">Chiều rộng (cm)</label>
            <input type="number" id="productWidth" name="productWidth" placeholder="Nhập chiều rộng">
        </div>
        <div class="form-group">
            <label for="productHeight">Chiều cao (cm)</label>
            <input type="number" id="productHeight" name="productHeight" placeholder="Nhập chiều cao">
        </div>
        <div class="form-group">
            <label for="productPrice">Giá bán sản phẩm (VND)</label>
            <input type="number" id="productPrice" name="productPrice" placeholder="Nhập giá bán">
        </div>
        <div class="form-group">
            <label for="productCost">Giá nhập kho (VND)</label>
            <input type="number" id="productCost" name="productCost" placeholder="Nhập giá nhập kho">
        </div>
        <div class="form-group">
            <label for="productDiscount">Giá khuyến mãi (VND)</label>
            <input type="number" id="productDiscount" name="productDiscount" placeholder="Nhập giá khuyến mãi">
        </div>
        <button type="submit" class="btn-submit">Cập nhật</button>
    </form>
</div>