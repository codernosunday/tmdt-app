document.addEventListener('DOMContentLoaded', function () {
    var swiper = new Swiper('.main-swiper', {
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 5000,
        },
        loop: true,
    });
});