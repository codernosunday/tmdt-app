window.postThemDMC = function () {
    const tendmc = document.getElementById("themtendmc").value;
    const dmcha = document.getElementById("themdmcha").value;
    const ghichu = document.getElementById("themghichu").value;

    if (!tendmc || !dmcha) {
        alert("Vui lòng nhập đầy đủ Tên danh mục con và chọn Danh mục cha.");
        return;
    }

    fetch(`/administrator/postthemdmcon`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute("content"),
        },
        body: JSON.stringify({
            tendanhmuc: tendmc,
            id_dmcha: dmcha,
            ghichu: ghichu
        }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Thêm danh mục con thành công!");
                location.reload();
            } else {
                alert("Lỗi: " + (data.message || "Không xác định"));
            }
        })
        .catch(error => {
            console.error("Lỗi gửi dữ liệu:", error);
            alert("Đã xảy ra lỗi khi gửi dữ liệu.");
        });
}
window.initPaginationClick = function () {
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        window.loadDanhMucCon(page);
    });
};

window.loadDanhMucCon = function (page) {
    $.ajax({
        url: "/admin/danhmuccon?page=" + page,
        type: "GET",
        success: function (data) {
            $("#dmcon-container").html(data);
        },
        error: function () {
            alert("Lỗi khi tải dữ liệu.");
        }
    });
}
window.deleteDMCon = function (id) {
    const isConfirmed = confirm("Bạn có chắc chắn muốn xóa danh mục này không?");
    if (!isConfirmed) {
        return;
    }
    fetch(`/administrator/deletedmcon/${id}`, {
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
            alert(`Lỗi khi xóa: ${error.message}`);
        });
}