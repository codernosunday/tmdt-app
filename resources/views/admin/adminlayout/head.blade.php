<header class="header">

    <div class="header-left">
        <button class="toggle-sidebar" id="toggle-sidebar">
            <i class="bi bi-three-dots-vertical"></i>
        </button>

        <img src="{{asset('logobannermain.png')}}" alt="Logo" class="logo-img">
    </div>
    <div class="header-right">
        <div class="user-menu">
            @if($quyen == 'staff')
                <div class="user-avatar">NV</div>
                <span class="user-name">Nhân viên</span>
            @else
                <div class="user-avatar">AD</div>
                <span class="user-name">Admin</span>
            @endif
            <div class="user-dropdown">
                {{-- <a href="#"><i class="fas fa-user"></i> Hồ sơ</a>
                <a href="#"><i class="fas fa-cog"></i> Cài đặt</a> --}}
                <a href="/logout"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
            </div>
        </div>
    </div>
</header>