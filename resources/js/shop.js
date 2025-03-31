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
    //--------
    const filterBox = document.getElementById("filterBox");
    const listSanPham = document.getElementById("listsanpham");

    // Bắt sự kiện thay đổi của radio và checkbox
    document.querySelectorAll(".check-input").forEach(input => {
        input.addEventListener("change", applyFilters);
    });

    function applyFilters() {
        let filters = {
            priceOrder: document.querySelector('input[name="locgia"]:checked')?.id || "",
            nameOrder: document.querySelector('input[name="Tensanpham"]:checked')?.id || "",
            priceRange: [],
            brand: [],
            color: []
        };

        // Lọc theo phân khúc giá
        document.querySelectorAll('#filterBox input[type="checkbox"]:checked').forEach(input => {
            if (input.id.startsWith("gia")) {
                filters.priceRange.push(input.id);
            } else if (input.id.startsWith("brand")) {
                filters.brand.push(input.id);
            } else {
                filters.color.push(input.style.background);
            }
        });
        console.log(JSON.stringify(filters))
    }
});
document.getElementById("toggleFilter").addEventListener("click", function () {
    var filterBox = document.getElementById("filterBox");
    if (filterBox.style.display === "none" || filterBox.style.display === "") {
        filterBox.style.display = "block";
    } else {
        filterBox.style.display = "none";
    }
});

function locsanpham() {
    const filterBox = document.getElementById("filterBox");
    const listSanPham = document.getElementById("listsanpham");

    // Bắt sự kiện thay đổi của radio và checkbox
    document.querySelectorAll(".form-check-input").forEach(input => {
        input.addEventListener("change", applyFilters);
    });

    function applyFilters() {
        let filters = {
            priceOrder: document.querySelector('input[name="locgia"]:checked')?.id || "",
            nameOrder: document.querySelector('input[name="Tensanpham"]:checked')?.id || "",
            priceRange: [],
            brand: [],
            color: []
        };

        // Lọc theo phân khúc giá
        document.querySelectorAll('#filterBox input[type="checkbox"]:checked').forEach(input => {
            if (input.id.startsWith("gia")) {
                filters.priceRange.push(input.id);
            } else if (input.id.startsWith("brand")) {
                filters.brand.push(input.id);
            } else {
                filters.color.push(input.style.background);
            }
        });
        console.log(JSON.stringify(filters))
        // Gửi request AJAX
        // fetch("/filter-products", {
        //     method: "POST",
        //     headers: {
        //         "Content-Type": "application/json",
        //         "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute("content")
        //     },
        //     body: JSON.stringify(filters)
        // })
        //     .then(response => response.text())
        //     .then(data => {
        //         listSanPham.innerHTML = data;
        //     })
        //     .catch(error => console.error("Lỗi khi lấy dữ liệu: ", error));
    }
}