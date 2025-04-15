@extends('layouts.app')

@section('title', $product->tensp)

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $product->anh }}" class="img-fluid" alt="{{ $product->tensp }}">
        </div>
        <div class="col-md-6">
            <h1>{{ $product->tensp }}</h1>
            <p class="h3 text-danger">{{ number_format($product->giaban ?? 0, 0, ',', '.') }} VNĐ</p>
            <div class="mt-4">
                {!! $product->mota !!}
            </div>
        </div>
    </div>
</div>
@endsection
