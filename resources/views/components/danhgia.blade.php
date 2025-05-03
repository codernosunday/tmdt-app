@vite(['resources/scss/danhgia.scss'])
<h2>Đánh giá sản phẩm</h2>
<div class="review-container">
    @foreach ($danhgia as $dg)
        <div class="review-header">
            <div class="user-info">
                <span class="user-name">{{ $dg->nguoidung->hovaten ?? 'Ẩn danh' }}</span>
                <span class="review-date">{{$dg->updated_at}}</span>
            </div>
            <div class="rating">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $dg->sosao)
                        <span style="color: gold;">★</span>
                    @else
                        <span style="color: lightgray;">☆</span>
                    @endif
                @endfor
            </div>
        </div>
        <div class="review-content">
            {{$dg->noidungbinhluan}}
        </div>
        <div class="review-actions">
            {{-- <button class="like-btn" onclick="">
                <span>👍</span>
                <span class="like-count">0</span>
            </button> --}}
            <button class="report-btn">Báo cáo vi phạm</button>
        </div>
    @endforeach
</div>
<!-- Form thêm đánh giá mới -->
<div class="add-review">
    <h3>Viết đánh giá của bạn</h3>
    <div class="rating-input">
        <span class="star" data-rating="1">☆</span>
        <span class="star" data-rating="2">☆</span>
        <span class="star" data-rating="3">☆</span>
        <span class="star" data-rating="4">☆</span>
        <span class="star" data-rating="5">☆</span>
        <input type="hidden" id="rating-value" name="rating" value="0">
    </div>
    <textarea id="comment" placeholder="Hãy chia sẻ cảm nhận của bạn về sản phẩm..." required></textarea>
    <button id="submitButton" class="btn btn-primary btn-add-to-cart" onclick="danhgia({{$sp->id_sp}})">Gửi đánh
        giá</button>
</div>