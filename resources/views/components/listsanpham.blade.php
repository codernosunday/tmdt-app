@vite(['resources/js/listspscript/listsp.js'])
@vite(['resources/css/listsp.css'])

<section id="categories" class="my-5">
    <div class="container my-5 py-5">
        <h2 class="display-3 fw-normal text-center mb-5">Danh mục sản phẩm</h2>
        <div class="category-grid">
            @foreach ($danhmuccon as $dmc)
                <a href="{{ route('categories.show', ['id_ctdm' => $dmc->id_ctdm]) }}" class="category-item"
                    data-id="{{ $dmc->id_ctdm }}">
                    <div class="category-content">
                        {{-- <img src="{{ $dmc->image_url ?? 'default.jpg' }}" alt="{{ $dmc->ten }}" loading="lazy"> --}}
                        <span>{{ $dmc->ten ?? 'Unnamed Category' }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const categoryItems = document.querySelectorAll('.category-item');
        categoryItems.forEach(item => {
            item.addEventListener('click', (event) => {
                event.preventDefault();
                const id = item.getAttribute('data-id');
                if (id) {
                    window.location.href = `/categories/${id}`;
                }
            });
        });
    });
</script>