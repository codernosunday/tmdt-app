@vite(['resources/js/listspscript/listsp.js'])
@vite(['resources/scss/listsp.scss'])

<style>
    .category-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 20px;
        padding: 20px;
        background: #fff;
        border-radius: 10px;
    }

    .category-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        transition: transform 0.3s;
        background: #fff;
    }

    .category-item:hover {
        transform: scale(1.05);
    }

    .category-item img {
        max-width: 100%;
        height: auto;
        border-radius: 50%;
        margin-bottom: 10px;
    }

    .category-item span {
        display: block;
        font-size: 1rem;
        font-weight: bold;
        color: #333;
    }
</style>

<section id="categories" class="my-5">
    <div class="container my-5 py-5">
        <h2 class="display-3 fw-normal text-center mb-5">DANH MỤC</h2>
        <div class="category-grid">
            @foreach ($danhmuccon as $dmc)
                <a href="{{ $dmc->slug ? route('danhmuc', ['slug' => $dmc->slug]) : '#' }}"
                    class="category-item d-flex flex-column align-items-center justify-content-center"
                    onclick="{{ $dmc->slug ? "event.preventDefault(); changeCategory('$dmc->slug');" : 'return false;' }}">
                    <img src="{{ $dmc->image_url ?? 'default-image.jpg' }}" alt="{{ $dmc->ten ?? 'No Name' }}"
                        loading="lazy">
                    <span>{{ $dmc->ten ?? 'Unnamed Category' }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<script>
    function changeCategory(slug) {
        fetch(`/api/categories/${slug}`)
            .then(response => response.json())
            .then(data => {
                // Update the page with the new category data
                // For example, update the product list
                console.log(data);
                // Implement the logic to update the page with the new category data
            })
            .catch(error => console.error('Error:', error));
    }
</script>