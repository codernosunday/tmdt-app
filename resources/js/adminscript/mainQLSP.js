window.deleteSP = function (id) {
    // Hiển thị hộp thoại xác nhận
    const isConfirmed = confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?");
    if (!isConfirmed) {
        return; // Nếu người dùng chọn "Cancel", dừng việc xóa
    }

    // Tiến hành xóa nếu người dùng chọn "OK"
    fetch(`/administrator/xoasp/${id}`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']")?.getAttribute("content") || ""
        }
    })
        .then(async response => {
            let data;
            const contentType = response.headers.get("content-type");

            if (contentType && contentType.includes("application/json")) {
                data = await response.json();
            } else {
                data = await response.text();
            }

            if (!response.ok) {
                throw new Error(`Lỗi HTTP ${response.status}: ${data?.message || data}`);
            }

            return data;
        })
        .then(data => {
            console.log("Phản hồi từ server:", data);
            if (data.message) {
                alert(data.message);
                location.reload();
            }
        })
        .catch(error => {
            console.error("Chi tiết lỗi:", error);
            alert(`Lỗi khi xóa sản phẩm: ${error.message}`);
        });
};
// bộ lọc danh mục
const selectBox = document.getElementById('danhmuc');
// Lọc theo danh mục
selectBox.addEventListener('change', function () {
    const selectedValue = selectBox.value;
    fetch(`/administrator/locsapham/${selectedValue}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('listsanpham').innerHTML = html;
        })
        .catch(error => console.error('Lỗi:', error));
});
// bộ lọc tình trạng
const trangthai = document.getElementById('trangthai');
trangthai.addEventListener('change', function () {
    const tt = trangthai.value;
    const danhmuc = selectBox.value;
    const data = {
        'trangthai': tt,
        'danhmuc': danhmuc
    }
    fetch("/administrator/loctrangthai", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute("content")
        },
        body: JSON.stringify(data)
    })
        .then(response => response.text())
        .then(html => {
            document.getElementById('listsanpham').innerHTML = html;
        })
        .catch(error => console.error('Lỗi:', error));
})

window.searchProduct = function () {
    const keyword = document.getElementById("search").value;
    const tt = trangthai.value;
    const danhmuc = selectBox.value;
    const data = {
        'trangthai': tt,
        'danhmuc': danhmuc,
        'timkiem': keyword
    }
    fetch("/administrator/loctheoten", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute("content")
        },
        body: JSON.stringify(data)
    })
        .then(response => response.text())
        .then(html => {
            document.getElementById('listsanpham').innerHTML = html;
        })
        .catch(error => console.error('Lỗi:', error));

}