// Lưu các dữ liệu đã chỉnh sửa
let editedData = {};

window.editCell = function (cell) {
    const row = cell.closest("tr");
    const rowId = row.getAttribute("data-id");
    const field = cell.getAttribute("data-field");
    const originalValue = cell.innerText.trim();

    const input = document.createElement("input");
    input.value = originalValue;
    input.style.width = "100%";

    cell.innerHTML = "";
    cell.appendChild(input);

    input.focus();

    input.onblur = function () {
        const newValue = input.value.trim();
        cell.innerText = newValue;

        if (!editedData[rowId]) {
            editedData[rowId] = {};
        }

        editedData[rowId][field] = newValue;
    };
};

window.saveRow = function (button, id_thuoctinh) {
    const row = button.closest("tr");
    const rowId = row.getAttribute("data-id");

    if (!editedData[rowId]) {
        alert("Không có thay đổi nào cần lưu.");
        return;
    }

    const requestData = {
        id_thuoctinh: id_thuoctinh,
        ...editedData[rowId]
    };

    fetch("/administrator/suathuoctinh", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute("content"),
        },
        body: JSON.stringify(requestData),
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert("Cập nhật thành công!");
                delete editedData[rowId];
            } else {
                alert("Cập nhật thất bại: " + (data.message || "Lỗi không xác định"));
            }
        })
        .catch(err => {
            console.error("Lỗi cập nhật:", err);
            alert("Lỗi trong quá trình gửi dữ liệu.");
        });
};

window.postthemmoi = function () {
    const loai = document.getElementById("loai");
    const kichthuoc = document.getElementById("kichthuoc");
    const mau = document.getElementById("mau");
    const mamau = document.getElementById("mamau");
    const thuoctinh = {
        'loai': loai.value.trim(),
        'kichthuoc': kichthuoc.value.trim(),
        'mau': mau.value.trim(),
        'mamau': mamau.value.trim()
    };

    fetch(`/administrator/themphanloaivamausac`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute("content"),
        },
        body: JSON.stringify(thuoctinh),
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Lỗi HTTP: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert("Thêm danh mục thành công!");
                location.reload();
            } else {
                alert("Lỗi: " + (data.message || "Có lỗi xảy ra!"));
            }
        })
        .catch(error => {
            console.error("Lỗi cập nhật:", error.message);
            alert("Có lỗi xảy ra, vui lòng thử lại!");
        });
};
window.deleteThuoctinh = function (id) {
    const isConfirmed = confirm("Bạn có chắc chắn muốn xóa thuộc tính này không?");
    if (!isConfirmed) {
        return;
    }
    fetch(`/administrator/deletethuoctinh/${id}`, {
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