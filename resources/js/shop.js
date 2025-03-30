document.addEventListener("DOMContentLoaded", function () {
    fetch(`/loc/0`)
        .then(response => response.text()) // Nhận nội dung HTML
        .then(html => {
            // Hiển thị nội dung trong một phần tử trên trang
            document.getElementById('listsanpham').innerHTML = html;
        })
        .catch(error => {
            console.error('Lỗi:', error);
        });
    const selectBox = document.getElementById('danhmuc');
    selectBox.addEventListener('change', function () {
        const selectedValue = selectBox.value;
        fetch(`/loc/${selectedValue}`)
            .then(response => response.text()) // Nhận nội dung HTML
            .then(html => {
                // Hiển thị nội dung trong một phần tử trên trang
                document.getElementById('listsanpham').innerHTML = html;
            })
            .catch(error => {
                console.error('Lỗi:', error);
            });
    });
});
document.getElementById("toggleFilter").addEventListener("click", function () {
    var filterBox = document.getElementById("filterBox");
    if (filterBox.style.display === "none" || filterBox.style.display === "") {
        filterBox.style.display = "block";
    } else {
        filterBox.style.display = "none";
    }
});