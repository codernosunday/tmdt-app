@vite(['resources/scss/thongke/thongkenguoidung.scss', 'resources/js/adminscript/thongke/thongkekhachhang.js'])
@extends('admin.adminlayout.layout_admin')
@section('content')
@section('title', 'Thống kê người dùng')
    <div class="dashboard">
        <div class="stats-summary">
            <div class="stat-card">
                <h3>Tổng số người dùng</h3>
                <p id="total-users">{{$data["tong"]}}</p>
            </div>
            <div class="stat-card">
                <h3>Người dùng mới</h3>
                <p id="new-users">{{$data["ndmoi"]}}</p>
            </div>
        </div>
        <div class="chart-row">
            <div class="chart-container">
                <canvas id="userGrowthChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="userLocationChart"></canvas>
            </div>
        </div>

        <div class="chart-row">
            {{-- <div class="chart-container">
                <canvas id="activityChart"></canvas>
            </div> --}}
            <div class="chart-container">
                <canvas id="ageDistributionChart"></canvas>
            </div>
        </div>
    </div>
@endsection