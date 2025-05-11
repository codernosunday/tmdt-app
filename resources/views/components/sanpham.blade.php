@vite(['resources/scss/listsp.scss'])
@vite(['resources/css/app.css'])
@php
    use Carbon\Carbon;
@endphp
<div class="container mt-4">
    <div class="row">
        @foreach($sp as $i)
            <div class="col-md-2 col-6 mb-4">

                <div class="product-card">
                    @if ($i->created_at && $i->created_at->isSameMonth(Carbon::now()))
                        <div class="premium-badge">Mới</div>
                    @endif
                    <a class="link" href="/sanpham/{{$i->tensp}}/{{$i->id_sp}}">
                        <img src="{{ $i->anhbase64 ? asset('storage/' . $i->anhbase64) : '' }}" alt="{{ $i->tensp }}">

                        <p class="product-name">{{ $i->tensp }}</p>
                        <div class="product-details text-center d-flex flex-column align-items-center">
                            @php
                                $gia = 0;
                                if (!empty($sale)) {
                                    foreach ($sale as $s) {
                                        if ($s->id_ctdm == $i->id_ctdm) {
                                            $gia = $i->giaban->giaban - $s->giasale;
                                        }
                                    }
                                }
                            @endphp
                            <p class="product-price">
                                @if($gia > 0)
                                    <span>{{ number_format($gia, 0, ',', '.') }} đ <br></span>
                                    <del class="text-muted small">{{ number_format($i->giaban->giaban, 0, ',', '.') }} đ</del>
                                @else
                                    <span>{{ isset($i->giaban) ? number_format($i->giaban->giaban, 0, ',', '.') . ' đ' : 'Liên hệ' }}</span>
                                @endif
                            </p>
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