document.addEventListener("DOMContentLoaded", function () {
    let position = 0;
    const categoryList = document.getElementById('categoryList');
    const items = document.querySelectorAll('.category-item');
    const itemWidth = items[0].offsetWidth;
    const visibleItems = 5;
    const maxPosition = (items.length - visibleItems) * itemWidth;

    window.scrollCategories = function (direction) {
        position += direction * itemWidth;
        if (position < 0) position = 0;
        if (position > maxPosition) position = maxPosition;
        categoryList.style.transform = `translateX(-${position}px)`;
    };
});
