@vite(['resources/js/listspscript/listsp.js'])
@vite(['resources/scss/listsp.scss'])

<style>
    .category-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 20px;
        padding: 20px;
        background: #fff;
        border-radius: 10px;
    }
    .category-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        transition: transform 0.3s;
        background: #fff;
    }
    .category-item:hover {
        transform: scale(1.05);
    }
    .category-item img {
        max-width: 100%;
        height: auto;
        border-radius: 50%;
        margin-bottom: 10px;
    }
    .category-item span {
        display: block;
        font-size: 1rem;
        font-weight: bold;
        color: #333;
    }
</style>

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

<section id="categories" class="my-5">
    <div class="container my-5 py-5">
        <h2 class="display-3 fw-normal text-center mb-5">DANH MỤC</h2>
        <div class="category-grid">
            <div class="category-item">
                <img src="https://down-vn.img.susercontent.com/file/ec14dd4fc238e676e43be2a911414d4d@resize_w640_nl.webp" alt="Máy Ảnh & Máy Quay Phim">
                <span>Máy Ảnh & Máy Quay Phim</span>
            </div>
            <div class="category-item">
                <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w640_nl.webp" alt="Đồng Hồ">
                <span>Đồng Hồ</span>
            </div>
            <div class="category-item">
                <img src="" alt="Giày Dép Nam">
                <span>Giày Dép Nam</span>
            </div>
            <div class="category-item">
                <img src="img/home-appliances.jpg" alt="Thiết Bị Điện Gia Dụng">
                <span>Thiết Bị Điện Gia Dụng</span>
            </div>
            <div class="category-item">
                <img src="img/sports.jpg" alt="Thể Thao & Du Lịch">
                <span>Thể Thao & Du Lịch</span>
            </div>
            <div class="category-item">
                <img src="img/vehicles.jpg" alt="Ô Tô & Xe Máy & Xe Đạp">
                <span>Ô Tô & Xe Máy & Xe Đạp</span>
            </div>
            <div class="category-item">
                <img src="img/backpack.jpg" alt="Balo & Túi Nam">
                <span>Balo & Túi Nam</span>
            </div>
            <div class="category-item">
                <img src="img/toys.jpg" alt="Đồ Chơi">
                <span>Đồ Chơi</span>
            </div>
            <div class="category-item">
                <img src="img/pet-care.jpg" alt="Chăm Sóc Thú Cưng">
                <span>Chăm Sóc Thú Cưng</span>
            </div>
            <div class="category-item">
                <img src="img/tools.jpg" alt="Dụng cụ và thiết bị tiện ích">
                <span>Dụng cụ và thiết bị tiện ích</span>
            </div>
            <div class="category-item">
                <img src="img/health.jpg" alt="Sức Khỏe">
                <span>Sức Khỏe</span>
            </div>
            <div class="category-item">
                <img src="img/womens-shoes.jpg" alt="Giày Dép Nữ">
                <span>Giày Dép Nữ</span>
            </div>
            <div class="category-item">
                <img src="img/bags.jpg" alt="Túi Ví Nữ">
                <span>Túi Ví Nữ</span>
            </div>
            <div class="category-item">
                <img src="img/accessories.jpg" alt="Phụ Kiện & Trang Sức Nữ">
                <span>Phụ Kiện & Trang Sức Nữ</span>
            </div>
            <div class="category-item">
                <img src="img/groceries.jpg" alt="Bách Hóa Online">
                <span>Bách Hóa Online</span>
            </div>
            <div class="category-item">
                <img src="img/books.jpg" alt="Nhà Sách Online">
                <span>Nhà Sách Online</span>
            </div>
            <div class="category-item">
                <img src="img/kids-fashion.jpg" alt="Thời Trang Trẻ Em">
                <span>Thời Trang Trẻ Em</span>
            </div>
            <div class="category-item">
                <img src="img/cleaning.jpg" alt="Giặt Giũ & Chăm Sóc Nhà Cửa">
                <span>Giặt Giũ & Chăm Sóc Nhà Cửa</span>
            </div>
            <div class="category-item">
                <img src="img/voucher.jpg" alt="Voucher & Dịch Vụ">
                <span>Voucher & Dịch Vụ</span>
            </div>
            <!-- Add more categories as needed -->
        </div>
    </div>
</section>