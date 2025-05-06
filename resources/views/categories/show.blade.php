@extends('layouts.app')
@vite(['resources/scss/shop.scss'])

@section('title', $category->ten ?? 'Danh mục')

@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp

    <div class="container my-5">
        <h1>{{ $category->ten ?? 'Danh mục' }}</h1>
        <div class="row">
            @foreach($thongtinsanpham as $product)
                <div class="col-md-3 mb-4">
                    <div class="product-card">
                        <a href="/sanpham/{{ $product['tensp'] }}/{{$product['id_sp']}}">
                            <img src="{{ $product['anhbase64'] ? asset('storage/' . $product['anhbase64']) : '' }}"
                                alt="{{ $product['tensp'] }}">
                        </a>
                        <h5 class="product-name">{{ Str::limit($product['tensp'], 50) }}</h5>
                        <p class="product-price">
                            {{ number_format($product['giaban']['giaban'] ?? 0, 0, ',', '.') }} VNĐ
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection