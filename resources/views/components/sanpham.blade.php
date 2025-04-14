@vite(['resources/scss/listsp.scss'])
@vite(['resources/css/app.css'])
<div class="container mt-4">
    <div class="row">
        @foreach($sp as $i)
            <div class="col-md-2 col-6 mb-4">

                <div class="product-card">
                    {{-- @if(isset($i->premium) && $i->premium)
                    <div class="premium-badge">Premium</div>
                    @endif --}}
                    <a class="link" href="/sanpham/{{$i->tensp}}/{{$i->id_sp}}">
                        <img src="{{ $i->anh }}" alt="{{ $i->tensp }}">

                        <p class="product-name">{{ $i->tensp }}</p>
                        <div class="product-details">
                            <p class="product-price">
                                {{ isset($i->giaban) ? number_format($i->giaban->giaban, 0, ',', '.') . ' đ' : 'Liên hệ' }}
                            </p>
                            <form action="addToCart" method="POST">
                                @csrf
                                <input type="hidden" name="id_sp" value="{{ $i->id_sp }}">
                                <button class="btn-cart">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </button>
                            </form>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@if ($sp instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="d-flex justify-content-center">
        {{ $sp->links('pagination::bootstrap-4') }}
    </div>
@endif