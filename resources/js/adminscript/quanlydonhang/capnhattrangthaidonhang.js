
document.getElementById('filterStatus').addEventListener('change', function () {
    const trangThai = this.value;

    fetch(`/administrator/donhang/locdonhang?trangthai=${encodeURIComponent(trangThai)}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('bangdonhang').innerHTML = html;
        })
        .catch(error => {
            console.error('Lỗi khi tải bảng đơn hàng:', error);
        });
});

const options = ['chờ xác nhận', 'đã xác nhận', 'đang giao hàng', 'đã giao hàng', 'đã hủy'];

let editedData = {};
let data = [];

window.editCell = function (cell) {
    let currentText = cell.innerText;
    let field = cell.getAttribute("data-field");
    let rowId = cell.parentElement.getAttribute("id");
    let key = cell.getAttribute("key");

    console.log("Row ID:", rowId);

    let select = document.createElement("select");
    select.classList.add("form-control");

    options.forEach(optionValue => {
        let option = document.createElement("option");
        option.value = optionValue;
        option.text = optionValue;
        if (optionValue === currentText) option.selected = true;
        select.appendChild(option);
    });

    select.onblur = function () {
        cell.innerText = select.value;

        if (!editedData[rowId]) editedData[rowId] = {};
        editedData[rowId][field] = select.value;
    };

    select.onchange = function () {
        const isExitsRow = data.find(item => item.id === rowId);

        if (isExitsRow) {
            data = data.map(item => {
                if (item.id === rowId) {
                    return {
                        ...item,
                        [key]: select.value
                    }
                } else {
                    return item;
                }
            });
        } else {
            data.push({
                id: rowId,
                [key]: select.value
            });
        }
        console.log(data);
    };

    cell.innerHTML = "";
    cell.appendChild(select);
    select.focus();
}

window.suatrangthaidonhang = function (id) {
    const dataItem = data.find(item => item.id == id);
    if (!dataItem) {
        console.log(dataItem);
        console.error("Không tìm thấy đơn hàng với id: " + id);
        alert("Không tìm thấy đơn hàng!");
        return;
    }

    console.log("Dữ liệu gửi đi:", dataItem);

    fetch(`/administrator/suaTTDH`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute("content"),
        },
        body: JSON.stringify(dataItem),
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Lỗi HTTP: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log("Dữ liệu phản hồi từ server:", data);

            if (data.success) {
                alert("Cập nhật trạng thái đơn hàng thành công!");
                location.reload();
            } else {
                alert("Lỗi: " + (data.message || "Có lỗi xảy ra!"));
            }
        })
        .catch(error => {
            console.error("Lỗi cập nhật:", error);
            alert("Có lỗi xảy ra, vui lòng thử lại!");
        });
};