@vite('resources/scss/quanlysanpham.scss')
@vite('resources/js/adminscript/mainQLDMcon.js')
@extends('admin.adminlayout.layout_admin')
@section('content')
@section('title', 'Quản lý danh mục con')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container" id="dmcon-container">
        @include('admin.danhmuccon.dmc_data')
    </div>
@endsection