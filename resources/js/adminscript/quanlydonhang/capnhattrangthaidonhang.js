const options = ['chờ xác nhận', 'đã xác nhận', 'đang giao hàng', 'đã giao hàng', 'đã hủy'];

let status = "";

window.editCell = function (cell) {
    console.log(cell);
    status = cell.innerText;
    let field = cell.getAttribute("data-field");
    let rowId = cell.parentElement.getAttribute("data-id");

    // Tạo select
    let select = document.createElement("select");
    select.classList.add("form-control");

    // Thêm option vào select
    options.forEach(optionValue => {
        let option = document.createElement("option");
        option.value = optionValue;
        option.text = optionValue;
        if (optionValue === status) {
            option.selected = true;
        }
        select.appendChild(option);
    });

    // Khi mất focus
    select.onblur = function () {
        cell.innerText = select.value;
        
    };

    // Khi nhấn Enter
    select.onkeydown = function (event) {
        if (event.key === "Enter") {
            const id = rowId;
            const isExitsRow = data.find(item => item.id === id);

            if (isExitsRow) {
                data = data.map(item => {
                    if (item.id === id) {
                        return {
                            ...item,
                            [field]: select.value
                        }
                    } else {
                        return item;
                    }
                });
            } else {
                data.push({
                    id: id,
                    [field]: select.value
                });
            }
            console.log(data);
            select.blur();
        }
    };

    // Gắn select vào cell
    cell.innerHTML = "";
    cell.appendChild(select);
    select.focus();
}

window.suatrangthaidonhang = function (id) {
    const userInfo = data.find(item => item.id == id);
    console.log(userInfo);
    fetch(`/administrator/suaTTDH`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute("content"),
        },
        body: JSON.stringify(userInfo),
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Lỗi HTTP: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert("Cập nhật thông tin người dùng thành công!");
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