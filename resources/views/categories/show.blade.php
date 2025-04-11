@extends('layouts.app')

@section('title', $category->ten ?? 'Danh mục')

@section('content')
<div class="container my-5">
    <h1>{{ $category->ten ?? 'Danh mục' }}</h1>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card">
                <a href="{{ route('sanpham.show', ['tensp' => $product->tensp, 'id_sp' => $product->id_sp]) }}">
                    <img src="{{ $product->anh }}" class="card-img-top" alt="{{ $product->tensp }}">
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{ $product->tensp }}</h5>
                    <p class="card-text text-danger">
                        {{ number_format($product->giaban ?? 0, 0, ',', '.') }} VNĐ
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
