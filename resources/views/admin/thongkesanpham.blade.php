@vite(['resources/scss/thongke/thongkesanpham.scss', 'resources/js/adminscript/thongke/thongkesanpham.js'])
@extends('admin.adminlayout.layout_admin')
@section('content')
@section('title', 'Thống kê sản phẩm')
    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1><i class="fas fa-chart-line"></i> Thống kê Sản phẩm</h1>
            {{-- <div class="date-filter">
                <select id="time-period">
                    <option value="7days">7 ngày qua</option>
                    <option value="30days">30 ngày qua</option>
                    <option value="month">Tháng này</option>
                    <option value="quarter">Quý này</option>
                    <option value="year" selected>Năm nay</option>
                </select>
            </div> --}}
        </header>

        <div class="stats-summary">
            <div class="stat-card">
                <div class="stat-icon" style="background-color: #4e79a7;">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="stat-info">
                    <h3>Tổng sản phẩm</h3>
                    <p>{{$data['tongsp']}}</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background-color: #f28e2b;">
                    <i class="fas fa-fire"></i>
                </div>
                <div class="stat-info">
                    <h3>Sản phẩm bán chạy</h3>
                    <p>{{$data['sanphambanchay']}}</p>
                    <span class="stat-change up"><i class="fas fa-arrow-up"></i>{{$data['soluongban']}} đã bán</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background-color: #e15759;">
                    <i class="fas fa-tags"></i>
                </div>
                <div class="stat-info">
                    <h3>Danh mục phổ biến</h3>
                    <p>{{$data['danhmuc']}}</p>
                </div>
            </div>
        </div>

        <div class="chart-row">
            <div class="main-chart">
                <div class="chart-header">
                    <h3>Phân bố danh mục</h3>
                    <div class="chart-container">
                        <canvas id="categoryDistributionChart"></canvas>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="salesTrendChart"></canvas>
                </div>
            </div>
            <div class="side-chart">
                <div class="small-chart">
                    <h3>Tỷ lệ tồn kho</h3>
                    <div class="chart-container">
                        <canvas id="inventoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-section">
            <div class="top-products">
                <div class="section-header">
                    <h3><i class="fas fa-trophy"></i> Top 5 sản phẩm bán chạy</h3>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên sản phẩm</th>
                            <th>Đã bán</th>
                        </tr>
                    </thead>
                    <tbody id="topSellingProductsTableBody">
                        <!-- JS sẽ render ở đây -->
                    </tbody>
                </table>
            </div>

            <div class="category-performance">
                <div class="section-header">
                    <h3><i class="fas fa-list-alt"></i> Hiệu suất danh mục</h3>
                </div>
                <div class="chart-container">
                    <canvas id="categoryPerformanceChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection