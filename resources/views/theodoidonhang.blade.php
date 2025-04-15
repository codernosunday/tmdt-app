{{-- @vite(['resources/js/shop.js'])
@vite(['resources/scss/shop.scss']) --}}
@extends('layouts.app')
@section('content')
@section('title', 'Xem đơn hàng')
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection