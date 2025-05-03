@vite(['resources/scss/thongke.scss', 'resources/js/adminscript/thongke/thongkedoanhthu.js'])
@extends('admin.adminlayout.layout_admin')
@section('content')
@section('title', 'Thống kê doanh thu')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <div class="headertt">
            <h1>Thống kê doanh thu</h1>
            <div class="time-filter">
                {{-- <button class="time-btn active" data-period="day">Theo ngày</button> --}}
                {{-- <button class="time-btn" data-period="week">Theo tuần</button> --}}
                <button class="time-btn" data-period="month">Theo tháng</button>
                <button class="time-btn" data-period="quarter">Theo quý</button>
                <button class="time-btn" data-period="year">Theo năm</button>
            </div>
        </div>

        {{-- <div class="date-picker">
            <input type="date" class="date-input" id="start-date">
            <span>đến</span>
            <input type="date" class="date-input" id="end-date">
            <button class="search-btn">
                <i class="fas fa-search"></i> Xem
            </button>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <h3>Tổng doanh thu</h3>
                <div class="value">125,450,000 ₫</div>
                <div class="change up">
                    <i class="fas fa-arrow-up"></i> 12.5% so với kỳ trước
                </div>
            </div>
            <div class="stat-card">
                <h3>Số đơn hàng</h3>
                <div class="value">1,245</div>
                <div class="change up">
                    <i class="fas fa-arrow-up"></i> 8.3% so với kỳ trước
                </div>
            </div>
            <div class="stat-card">
                <h3>Giá trị trung bình</h3>
                <div class="value">100,763 ₫</div>
                <div class="change down">
                    <i class="fas fa-arrow-down"></i> 3.2% so với kỳ trước
                </div>
            </div>
            <div class="stat-card">
                <h3>Khách hàng mới</h3>
                <div class="value">342</div>
                <div class="change up">
                    <i class="fas fa-arrow-up"></i> 15.7% so với kỳ trước
                </div>
            </div>
        </div> --}}

        <div class="chart-container">
            <h2 class="chart-title">Biểu đồ doanh thu</h2>
            <canvas id="revenue-chart"></canvas>
        </div>

        <div class="chart-container">
            <h2 class="chart-title">Biểu đồ so sánh năm trước và năm nay</h2>
            <canvas id="comparison-chart"></canvas>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Thời gian</th>
                    <th>Doanh thu</th>
                    <th>Số đơn hàng</th>
                    <th>Giá trị trung bình</th>
                    {{-- <th>Tăng trưởng</th> --}}
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01/2023</td>
                    <td>125,450,000 ₫</td>
                    <td>1,245</td>
                    <td>100,763 ₫</td>
                    {{-- <td class="change up">+12.5%</td> --}}
                </tr>
                <tr>
                    <td>12/2022</td>
                    <td>111,520,000 ₫</td>
                    <td>1,150</td>
                    <td>97,017 ₫</td>
                    {{-- <td class="change up">+5.3%</td> --}}
                </tr>
                <tr>
                    <td>11/2022</td>
                    <td>105,890,000 ₫</td>
                    <td>1,092</td>
                    <td>96,969 ₫</td>
                    {{-- <td class="change down">-2.1%</td> --}}
                </tr>
                <tr>
                    <td>10/2022</td>
                    <td>108,150,000 ₫</td>
                    <td>1,115</td>
                    <td>97,000 ₫</td>
                    {{-- <td class="change up">+7.8%</td> --}}
                </tr>
            </tbody>
        </table>

        <button class="export-btn">
            <i class="fas fa-file-export"></i> Xuất báo cáo
        </button>
    </div>
@endsection