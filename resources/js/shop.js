document.addEventListener("DOMContentLoaded", function () {
    // Load mặc định
    fetch(`/loc/0`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('listsanpham').innerHTML = html;
        })
        .catch(error => console.error('Lỗi:', error));

    const selectBox = document.getElementById('danhmuc');

    // Lọc theo danh mục
    selectBox.addEventListener('change', function () {
        const selectedValue = selectBox.value;
        fetch(`/loc/${selectedValue}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('listsanpham').innerHTML = html;
            })
            .catch(error => console.error('Lỗi:', error));
    });

    // Gắn sự kiện thay đổi cho các input lọc
    document.querySelectorAll("input[type='checkbox'], input[type='radio']").forEach(input => {
        input.addEventListener("change", applyFilters);
    });

    // Hàm xử lý lọc nâng cao
    function applyFilters() {
        const filters = {
            id_ctdm: selectBox.value,
            priceOrder: document.querySelector('input[name="locgia"]:checked')?.id || "",
            nameOrder: document.querySelector('input[name="Tensanpham"]:checked')?.id || "",
            priceRange: [],
            brand: [],
            color: []
        };

        // Lọc checkbox theo name
        document.querySelectorAll('input[name="priceRange[]"]:checked').forEach(input => {
            filters.priceRange.push(input.value);
        });
        document.querySelectorAll('input[name="brand[]"]:checked').forEach(input => {
            filters.brand.push(input.value);
        });
        document.querySelectorAll('input[name="color[]"]:checked').forEach(input => {
            filters.color.push(input.value);
        });

        // Hiện dữ liệu lọc ra console để kiểm tra
        console.log("Dữ liệu gửi đi:", filters);

        // Gửi AJAX
        fetch("/shop/locnangcao", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute("content")
            },
            body: JSON.stringify(filters)
        })
            .then(async response => {
                const contentType = response.headers.get("content-type");
                if (!contentType || !contentType.includes("application/json")) {
                    throw new Error("Phản hồi từ server không phải JSON");
                }

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || "Lỗi không xác định từ server");
                }

                document.getElementById("listsanpham").innerHTML = data.data;
            })
            .catch(error => {
                console.error("Lỗi từ server:", error.message);
            });
    }
});