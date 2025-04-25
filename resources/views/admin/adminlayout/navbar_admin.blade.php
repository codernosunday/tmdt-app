<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        @if($quyen == 'staff')
            <h3>Trang nhân viên</h3>
        @else
            <h3>Trang quản lý</h3>
        @endif
    </div>

    <div class="sidebar-menu">
        <div class="menu-item">
            <a href="#">
                <i class="bi bi-house-door"></i>
                <span>Trang chủ</span>
            </a>
        </div>
        @if($quyen == 'staff')
            <div class="menu-item">
                <a href="#">
                    <i class="bi bi-cart"></i>
                    <span>Sản phẩm</span>
                    <i class="bi bi-chevron-compact-down dropdown-icon" style="margin-left: auto;"></i>
                </a>
                <div class="submenu">
                    <a href="/administrator/quanlysanpham"><i class="bi bi-menu-up"></i><span>Danh sách sản phẩm</span></a>
                    <a href="/administrator/themsanpham"><i class="bi bi-file-plus"></i><span>Thêm sản phẩm</span></a>
                    <a href="/administrator/quanlydanhmucccon"><i class="bi bi-bookmarks"></i><span>Danh mục sản
                            phẩm</span></a>
                    <a href="/administrator/quanlydanhmuccha"><i class="bi bi-bookmark"></i><span>Danh mục cha</span></a>
                    <a href="/administrator/qlgiasale"><i class="bi bi-wallet"></i><span>Khuyến
                            mãi</span></a>

                </div>
            </div>

            <div class="menu-item">
                <a href="#">
                    <i class="bi bi-box-seam"></i>
                    <span>Đơn hàng</span>
                    <i class="bi bi-chevron-compact-down dropdown-icon" style="margin-left: auto;"></i>
                </a>
                <div class="submenu">
                    <a href="/administrator/quanlydonhang/all"><i class="bi bi-inboxes"></i><span>Danh sách đơn
                            hàng</span></a>
                    <a href="/administrator/phivanchuyen"><i class="bi bi-truck"></i><span>Quản lý phí vận chuyển</span></a>
                    {{-- <a href="/administrator/quanlydanhmucccon"><span>Danh mục sản phẩm</span></a>
                    <a href="/administrator/quanlydanhmuccha"><span>Danh mục cha</span></a> --}}
                </div>
            </div>

            <div class="menu-item">
                <a href="#">
                    <i class="bi bi-bar-chart"></i>
                    <span>Thống kê & báo cáo</span>
                    <i class="bi bi-chevron-compact-down dropdown-icon" style="margin-left: auto;"></i>
                </a>
                <div class="submenu">
                    <a href="#"><i class="bi bi-graph-up"></i><span>Doanh thu</span></a>
                    <a href="#"><span>Tài khoản khách hàng</span></a>
                    <a href="#"><span>Các mặt hàng</span></a>
                </div>
            </div>
        @else
            <div class="menu-item">
                <a href="#">
                    <i class="bi bi-people"></i>
                    <span>Quản lý người dùng</span>
                    <i class="bi bi-chevron-compact-down dropdown-icon" style="margin-left: auto;"></i>
                </a>
                <div class="submenu">
                    <a href="/administrator/quanlynguoidung"><i class="bi bi-person-badge"></i><span>Danh sách người
                            dùng</span></a>
                    <a href="#"><i class="bi bi-person-add"></i><span>Thêm người dùng</span></a>
                    <a href="#"><i class="bi bi-chat-left-dots"></i><span>Quản lý bình luận</span></a>
                </div>
            </div>
        @endif
        {{-- <div class="menu-item">
            <a href="#">
                <i class="fas fa-cog"></i>
                <span>Cài đặt</span>
            </a>
        </div> --}}
    </div>

    <div class="sidebar-footer">
        <span>Phiên bản 1.0.1</span>
    </div>
</div>