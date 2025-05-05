const inputs = [
    { input: document.getElementById('idsearchs'), results: document.getElementById('search-results') },
    { input: document.getElementById('idsearch'), results: document.getElementById('search-results-mobile') }
];

inputs.forEach(({ input, results }) => {
    let timeout;

    input.addEventListener('input', function () {
        clearTimeout(timeout);
        const keyword = input.value.trim();
        if (keyword.length < 1) {
            results.style.display = 'none';
            results.innerHTML = '';
            return;
        }

        timeout = setTimeout(() => {
            fetch(`/search?keyword=${encodeURIComponent(keyword)}`)
                .then(response => response.json())
                .then(products => {
                    renderResults(products, results);
                })
                .catch(err => {
                    console.error('Search error:', err);
                });
        }, 300);
    });
});

function renderResults(products, container) {
    if (!products.length) {
        container.innerHTML = `
            <li class="list-group-item text-center text-muted">Không tìm thấy kết quả</li>
        `;
    } else {
        container.innerHTML = products.map(p =>
            `<li class="list-group-item">
                <a href="/${p.slug}" class="text-decoration-none text-dark">${p.name}</a>
            </li>`
        ).join('');
    }
    container.style.display = 'block';
}
