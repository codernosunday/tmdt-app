document.addEventListener("DOMContentLoaded", function () {
    fetch(`/danhmuc/0`)
        .then(response => response.text()) // Nhận nội dung HTML
        .then(html => {
            // Hiển thị nội dung trong một phần tử trên trang
            document.getElementById('sanpham').innerHTML = html;
        })
        .catch(error => {
            console.error('Lỗi:', error);
        });
    const selectBox = document.getElementById('Danhmuc');
    selectBox.addEventListener('change', function () {
        const selectedValue = selectBox.value;
        fetch(`/danhmuc/${selectedValue}`)
            .then(response => response.text()) // Nhận nội dung HTML
            .then(html => {
                // Hiển thị nội dung trong một phần tử trên trang
                document.getElementById('sanpham').innerHTML = html;
            })
            .catch(error => {
                console.error('Lỗi:', error);
            });
    });
});
