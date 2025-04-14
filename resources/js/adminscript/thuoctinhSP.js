// Lưu các dữ liệu đã chỉnh sửa
let editedData = {};

window.editCell = function (cell) {
    let currentText = cell.innerText;
    let field = cell.getAttribute("data-field");
    let rowId = cell.parentElement.getAttribute("data-id");

    let input = document.createElement("input");
    input.type = "text";
    input.value = currentText;
    input.classList.add("form-control");

    input.onblur = function () {
        cell.innerText = input.value;
        if (!editedData[rowId]) editedData[rowId] = {};
        editedData[rowId][field] = input.value;
    };

    input.onkeydown = function (event) {
        if (event.key === "Enter") {
            input.blur();
        }
    };

    cell.innerHTML = "";
    cell.appendChild(input);
    input.focus();
}

// window.saveRow = function (button, id) {
//     let row = button.closest("tr");
//     let rowId = row.getAttribute("data-id");

//     if (!editedData[rowId]) {
//         alert("Không có thay đổi nào cần lưu.");
//         return;
//     }

//     let requestData = editedData[rowId];
//     requestData.id_dm = id
//     console.log(JSON.stringify(requestData));

//     fetch(`/administrator/updatedmcha`, {
//         method: "POST",
//         headers: {
//             "Content-Type": "application/json",
//             "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute("content"),
//         },
//         body: JSON.stringify(requestData),
//     })
//         .then(response => response.json())
//         .then(data => {
//             console.log("Cập nhật thành công:", data);
//             alert("Cập nhật thành công!");
//             delete editedData[rowId];
//         })
//         .catch(error => console.error("Lỗi cập nhật:", error));
// }
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
// window.deleteDanhmuc = function (id) {
//     const isConfirmed = confirm("Bạn có chắc chắn muốn xóa danh mục này không?");
//     if (!isConfirmed) {
//         return;
//     }
//     fetch(`/administrator/deletedmcha/${id}`, {
//         method: "DELETE",
//         headers: {
//             "Content-Type": "application/json",
//             "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']")?.getAttribute("content") || ""
//         }
//     })
//         .then(async response => {
//             let data;
//             const contentType = response.headers.get("content-type");

//             if (contentType && contentType.includes("application/json")) {
//                 data = await response.json();
//             } else {
//                 data = await response.text();
//             }
//             if (!response.ok) {
//                 throw new Error(`Lỗi HTTP ${response.status}: ${data?.message || data}`);
//             }
//             return data;
//         })
//         .then(data => {
//             console.log("Phản hồi từ server:", data);
//             if (data.message) {
//                 alert(data.message);
//                 location.reload();
//             }
//         })
//         .catch(error => {
//             console.error("Chi tiết lỗi:", error);
//             alert(`Lỗi khi xóa: ${error.message}`);
//         });
// }