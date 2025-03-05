function scrollCategories(direction) {
    const categoryList = document.getElementById('categoryList');
    const scrollAmount = 200;

    if (direction === 1) {
        categoryList.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    } else if (direction === -1) {
        categoryList.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    }
}
function updateArrows() {
    const categoryList = document.getElementById('categoryList');
    const arrows = document.querySelectorAll('.arrow');

    if (categoryList.scrollLeft === 0) {
        arrows[0].style.display = 'none';
    } else {
        arrows[0].style.display = 'flex';
    }

    if (categoryList.scrollLeft + categoryList.clientWidth >= categoryList.scrollWidth) {
        arrows[1].style.display = 'none';
    } else {
        arrows[1].style.display = 'flex';
    }
}
document.getElementById('categoryList').addEventListener('scroll', updateArrows);
window.addEventListener('load', updateArrows);