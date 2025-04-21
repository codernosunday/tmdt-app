{{-- <div class="container py-4">
    <h1>{{ $sp->name }}</h1>
    <img src="{{ $sp->image_url }}" alt="{{ $sp->name }}" class="img-fluid mb-4">
    <p>Giá: {{ number_format($sp->discounted_price, 0, ',', '.') }}₫</p>

    <!-- Phần đánh giá tổng quan -->
    <div class="rating-overview mb-5">
        <h3>Đánh giá sản phẩm</h3>
        <div class="d-flex align-items-center mb-3">
            <h2 class="me-2">{{ number_format($diemTrungBinh, 1) }}</h2>
            <div class="stars">
                @for ($i = 1; $i <= 5; $i++) <span class="text-warning">{{ $i <= round($diemTrungBinh) ? '★' : '☆'
                        }}</span>
                        @endfor
            </div>
            <span class="ms-3">{{ $tongDanhGia }} đánh giá</span>
        </div>

        <!-- Thanh tiến trình cho từng mức sao -->
        <div class="rating-distribution mb-3">
            @foreach ($sp->ratingDistribution() as $star => $count)
            <div class="d-flex align-items-center mb-2">
                <span class="me-2">{{ $star }} sao</span>
                <div class="progress flex-grow-1" style="height: 8px;">
                    <div class="progress-bar bg-warning" role="progressbar"
                        style="width: {{ $tongDanhGia > 0 ? ($count / $tongDanhGia * 100) : 0 }}%"
                        aria-valuenow="{{ $count }}" aria-valuemin="0" aria-valuemax="{{ $tongDanhGia }}"></div>
                </div>
                <span class="ms-2">{{ $count }}</span>
            </div>
            @endforeach
        </div>

        <!-- Lọc đánh giá -->
        <div class="rating-filter mb-4">
            <div class="btn-group" role="group">
                <button class="btn btn-outline-primary active" data-filter="*">Tất cả</button>
                @for ($i = 5; $i >= 1; $i--)
                <button class="btn btn-outline-primary" data-filter=".rating-{{ $i }}">{{ $i }} sao</button>
                @endfor
            </div>
        </div>
    </div>

    <!-- Form gửi bình luận -->
    <div class="comment-form mb-5">
        <h3>Viết đánh giá</h3>
        @auth
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('danhgia.store', ['sp' => $sp->id_sp]) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="diem" class="form-label">Đánh giá (1-5 sao):</label>
                <select name="diem" id="diem" class="form-select" required>
                    <option value="">Chọn số sao</option>
                    @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}">{{ $i }} sao</option>
                        @endfor
                </select>
            </div>
            <div class="mb-3">
                <label for="noidung" class="form-label">Nội dung đánh giá:</label>
                <textarea name="noidung" id="noidung" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
        </form>
        @else
        <div class="alert alert-info">
            Vui lòng <a href="/login" class="alert-link">đăng nhập</a> để viết đánh giá.
        </div>
        @endauth
    </div>

    <!-- Danh sách đánh giá -->
    <div class="comments-section">
        <h3>Danh sách đánh giá</h3>
        <div class="comments-list">
            @forelse ($danhgia as $dg)
            <div class="comment mb-3 p-3 border rounded rating-{{ $dg->diem }}">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $dg->user->name }}</strong>
                        <div class="stars">
                            @for ($i = 1; $i <= 5; $i++) <span class="text-warning">{{ $i <= $dg->diem ? '★' : '☆'
                                    }}</span>
                                    @endfor
                        </div>
                    </div>
                    <small>{{ $dg->created_at->format('d/m/Y') }}</small>
                </div>
                <p class="mt-2">{{ $dg->noidung }}</p>
            </div>
            @empty
            <p>Chưa có đánh giá nào cho sản phẩm này.</p>
            @endforelse
        </div>
    </div>
</div>

<style>
    .rating-overview .stars span {
        font-size: 1.25rem;
        color: #ffc107;
    }

    .rating-distribution .progress {
        background-color: #f0f0f0;
        border-radius: 10px;
    }

    .rating-filter .btn-group {
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .rating-filter .btn {
        border-radius: 20px !important;
        padding: 0.375rem 1rem;
    }

    .comment {
        background-color: #fff;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .comment:hover {
        transform: translateY(-2px);
    }

    .comment .stars span {
        font-size: 0.9rem;
        color: #ffc107;
    }

    @media (max-width: 768px) {
        .rating-filter .btn {
            font-size: 0.8rem;
            padding: 0.25rem 0.75rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterButtons = document.querySelectorAll('.rating-filter button');
        filterButtons.forEach(button => {
            button.addEventListener('click', function () {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const filter = this.getAttribute('data-filter');
                const comments = document.querySelectorAll('.comments-list .comment');

                comments.forEach(comment => {
                    comment.style.display = filter === '*' || comment.classList.contains(filter.slice(1))
                        ? 'block'
                        : 'none';
                });
            });
        });
    });
</script>
</div> --}}