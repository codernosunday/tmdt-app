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
