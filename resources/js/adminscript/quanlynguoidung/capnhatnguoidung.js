let editedData = {};
let data = [];

window.editCell = function (cell) {
    console.log(cell);
    let currentText = cell.innerText;
    let field = cell.getAttribute("data-field");
    let rowId = cell.parentElement.getAttribute("data-id");
    let key = cell.getAttribute("key");

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
            const id = cell.getAttribute("id");
            const isExitsRow = data.find(item => item.id === id);

            if (isExitsRow) {
                data = data.map(item => {
                    if (item.id === id) {
                        return {
                            ...item,
                            [key]: input.value
                        }
                    }else {
                        return item;
                    }
                });
            }else {
                data.push({
                    id: id,
                    [key]: input.value
                });
            }  
            console.log(data);
            input.blur();
        }
    };

    cell.innerHTML = "";
    cell.appendChild(input);
    input.focus();
}

window.suanguoidung = function (id) {
    const userInfo = data.find(item => item.id == id);
    console.log(userInfo);
    fetch(`/administrator/suaNguoiDung`, {
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