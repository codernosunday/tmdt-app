@php
    $products = $products ?? []; // Ensure $products is defined and defaults to an empty array if undefined
@endphp
@vite(['resources/scss/listsp.scss'])
<div class="isotope-container row">
    @foreach ($products as $product)
        <div class="item col-md-4 col-lg-3 my-4">
            <div class="card position-relative">
                @if ($product->is_new)
                    <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle bg-danger text-white">
                        New
                    </div>
                @endif
                <a href="{{ route('product.details', $product->id) }}">
                    <img src="{{ $product->image_url }}" class="img-fluid rounded-4" alt="{{ $product->name }}">
                </a>
                <div class="card-body p-0">
                    <a href="{{ route('product.details', $product->id) }}">
                        <h3 class="card-title pt-4 m-0">{{ $product->name }}</h3>
                    </a>
                    <div class="card-text">
                        <h3 class="secondary-font text-primary">
                            {{ number_format($product->discounted_price, 0, ',', '.') }}₫
                        </h3>
                        @if ($product->original_price > $product->discounted_price)
                            <span class="text-decoration-line-through text-muted">
                                {{ number_format($product->original_price, 0, ',', '.') }}₫
                            </span>
                            <span class="text-danger">-{{ $product->discount_percentage }}%</span>
                        @endif
                        <div class="d-flex flex-wrap mt-3">
                            <a href="{{ route('cart.add', $product->id) }}" class="btn-cart me-3 px-4 pt-3 pb-3">
                                <h5 class="text-uppercase m-0">Add to Cart</h5>
                            </a>
                            <a href="{{ route('wishlist.add', $product->id) }}" class="btn-wishlist px-4 pt-3">
                                <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="d-flex justify-content-center">
        {{ $product->links('pagination::bootstrap-4') }}
    </div>
@endif