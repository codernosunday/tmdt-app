@vite('resources/scss/quanlysanpham.scss')
@include('admin.adminlayout.meta-admin')
<div class="form-container">
    <h2>Chỉnh sửa sản phẩm</h2>
    <form>
        <div class="form-group">
            <label for="productImage">Hình ảnh sản phẩm</label>
            <input type="file" id="productImage" name="productImage">
        </div>
        <div class="form-group">
            <label for="productName">Tên sản phẩm</label>
            <input type="text" id="productName" name="productName" placeholder="Nhập tên sản phẩm">
        </div>
        <div class="form-group">
            <label for="productSummary">Tóm tắt sản phẩm</label>
            <textarea id="productSummary" name="productSummary" rows="3" placeholder="Nhập tóm tắt sản phẩm"></textarea>
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
            </select>
        </div>
        <div class="form-group">
            <label for="productDescription">Mô tả sản phẩm</label>
            <textarea id="productDescription" name="productDescription" rows="5"
                placeholder="Nhập mô tả sản phẩm"></textarea>
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
        <button type="submit" class="btn-submit">Xác nhận</button>
    </form>
</div>