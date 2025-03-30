@vite(['resources/scss/listsp.scss'])
<div class="container mt-4">
    <div class="row">
        @foreach($sp as $i)
            <div class="col-md-2 col-6 mb-4">

                <div class="product-card">
                    {{-- @if(isset($i->premium) && $i->premium)
                    <div class="premium-badge">Premium</div>
                    @endif --}}
                    <a href="/sanpham/{{$i->tensp}}/{{$i->id_sp}}">
                        <img src="{{ $i->anh }}" alt="{{ $i->tensp }}">
                    </a>
                    <p class="product-name">{{ $i->tensp }}</p>
                    <p class="product-price">
                        {{ isset($i->giaban) ? number_format($i->giaban->giaban, 0, ',', '.') . ' đ' : 'Liên hệ' }}
                    </p>
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