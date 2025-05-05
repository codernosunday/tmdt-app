@vite(['resources/scss/giohang.scss'])
@vite(['resources/js/giohangscript/giohang.js'])
@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container py-5">
        <h1 class="mb-4">Giỏ hàng của bạn</h1>
        @if(count($cartItems) > 0)
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @foreach($cartItems as $item)
                                    <tr>
                                        {{-- <td class="align-middle">
                                            <button class="btn btn-outline-info"><i class="bi bi-info-circle-fill"></i></button>
                                        </td> --}}
                                        <td class="align-middle">
                                            <img src="{{ $item->anhbase64 ? asset('storage/' . $item->anhbase64) : '' }}" alt="{{$item->tensp}}"
                                                class="img-thumbnail" width="80">
                                        </td>
                                        <td class="align-middle">
                                            <p class="mb-1" class="align-middle">{{ $item->tensp }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="mb-1" class="align-middle">{{$item->mau}}</p>
                                        </td>
                                        <td class="align-middle">{{ number_format($item->giaban) }}đ</td>
                                        <td class="align-middle">
                                            <div class="input-group quantity-selector" style="width: 120px;">
                                                {{-- <button class="btn btn-outline-secondary decrease" type="button"
                                                    id="decrease-{{ $item->id_ctgh }}">-</button> --}}
                                                    <input type="text" class="form-control text-center quantity-input"
                                                    value="{{ $item->soluong }}" id="quantity" readonly>
                                                {{-- <button class="btn btn-outline-secondary increase" type="button"
                                                    id="increase-{{ $item->id_ctgh }}">+</button> --}}
                                            </div>
                                        </td>
                                        <td class="align-middle">{{ number_format($item->giaban * $item->soluong) }}đ</td>
                                        <td class="align-middle">
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button class="btn btn-outline-success btn-sm" onclick="muahang({{$item->id_ctgh}})" title="Thanh toán">
                                                    <i class="bi bi-wallet2"></i>
                                                </button>
                                                <button class="btn btn-outline-danger btn-sm remove-item" onclick="xoagiohang({{ $item->id_ctgh }})">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-4x text-muted mb-4"></i>
                <h3 class="mb-3">Giỏ hàng của bạn đang trống</h3>
                <p class="text-muted mb-4">Hãy thêm sản phẩm vào giỏ hàng để tiếp tục mua sắm</p>
                <a href="{{ route('shop') }}" class="btn btn-primary px-4">Tiếp tục mua sắm</a>
            </div>
        @endif
    </div>
@endsection