@vite(['resources/scss/listsp.scss'])

@php
    $showPagination = isset($products) && 
                      $products instanceof \Illuminate\Pagination\LengthAwarePaginator && 
                      $products->hasPages();
    $hasProducts = isset($products) && $products->isNotEmpty();
@endphp

<div class="isotope-container row">
    @forelse($products ?? [] as $product)
        @if($product && $product->id_sp && $product->tensp)
            @php
                $productUrl = route('sanpham.show', [
                    'id_sp' => $product->id_sp,
                    'tensp' => Str::slug($product->tensp)
                ]);
                
                $price = $product->giaban ? number_format($product->giaban->giaban, 0, ',', '.') . ' đ' : 'Liên hệ';
            @endphp
            
            <div class="item col-md-4 col-lg-3 my-4">
                <div class="card position-relative h-100">
                    <a href="{{ $productUrl }}" class="product-image-link">
                        <img src="{{ $product->anh ?? asset('images/default-product.jpg') }}" 
                             class="img-fluid rounded-4" 
                             alt="Sản phẩm: {{ $product->tensp ?? 'Chưa có tên' }}"
                             loading="lazy"
                             onerror="this.src='{{ asset('images/default-product.jpg') }}'">
                    </a>
                    
                    <div class="card-body p-3">
                        <a href="{{ $productUrl }}" class="text-decoration-none">
                            <h3 class="card-title h5 text-dark">
                                {{ Str::limit($product->tensp, 50) }}
                            </h3>
                        </a>
                        
                        <div class="card-text mt-2">
                            <div class="product-price h5 text-primary mb-3">
                                {{ $price }}
                            </div>
                            
                            <div class="d-flex flex-wrap">
                                @if($product->tinhtrang)
                                    <button type="button" 
                                            class="btn btn-primary add-to-cart-btn" 
                                            data-product-id="{{ $product->id_sp }}"
                                            onclick="addToCart({{ $product->id_sp }})">
                                        <i class="fas fa-shopping-cart me-2"></i>
                                        Thêm vào giỏ
                                    </button>
                                @else
                                    <span class="badge bg-danger p-2">Hết hàng</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @empty
        <div class="col-12 text-center py-5">
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                Không có sản phẩm nào.
            </div>
        </div>
    @endforelse
</div>

@if($showPagination)
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
@endif

@push('scripts')
<script>
function addToCart(productId) {
    fetch(`/cart/add/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Đã thêm sản phẩm vào giỏ hàng');
        } else {
            alert(data.message || 'Có lỗi xảy ra');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra khi thêm vào giỏ hàng');
    });
}
</script>
@endpush

@push('styles')
<style>
.product-image-link {
    overflow: hidden;
    display: block;
}

.product-image-link img {
    transition: transform 0.3s ease;
}

.product-image-link:hover img {
    transform: scale(1.05);
}

.add-to-cart-btn {
    width: 100%;
    padding: 0.5rem 1rem;
    transition: all 0.3s ease;
}

.add-to-cart-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>
@endpush