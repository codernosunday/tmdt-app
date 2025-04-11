@vite(['resources/js/listspscript/listsp.js'])
@vite(['resources/scss/listsp.scss'])
@vite(['resources/css/listsp.css'])

<section id="categories" class="my-5">
    <div class="container my-5 py-5">
        <h2 class="display-3 fw-normal text-center mb-5">DANH MỤC</h2>
        <div class="category-grid">
            @foreach ($danhmuccon as $dmc)
            <a href="{{ route('categories.show', ['id_ctdm' => $dmc->id_ctdm]) }}" 
                class="category-item d-flex flex-column align-items-center justify-content-center"
                data-id="{{ $dmc->id_ctdm }}">
                <img src="{{ $dmc->image_url ?? 'default-image.jpg' }}" alt="{{ $dmc->ten ?? 'No Name' }}" loading="lazy">
                <span>{{ $dmc->ten ?? 'Unnamed Category' }}</span>
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