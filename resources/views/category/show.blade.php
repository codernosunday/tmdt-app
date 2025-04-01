{{-- filepath: resources/views/category/show.blade.php --}}
@extends('layouts.app')

@section('title', $category->ten)

@section('content')
<div class="container my-5">
    <h1 class="display-4">{{ $category->ten }}</h1>
    <p>{{ $category->description }}</p>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <a href="{{ route('sanpham.show', ['id_sp' => $product->id_sp]) }}">
                        <img src="{{ $product->anh }}" class="card-img-top" alt="{{ $product->tensp }}">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->tensp }}</h5>
                        <p class="card-text">
                            {{-- Replace this with approp   riate logic if giaban is stored elsewhere --}}
                            Giá: Liên hệ
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection