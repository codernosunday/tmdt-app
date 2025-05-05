// document.querySelectorAll('[id^="increase-"]').forEach(button => {
//     button.addEventListener('click', function () {
//         const itemId = this.id.split('-')[1];
//         const quantityInput = document.getElementById('quantity-' + itemId);
//         let value = parseInt(quantityInput.value) + 1;
//         quantityInput.value = value;
//         updateCartItem(itemId, value);
//     });
// });

// // Xử lý giảm số lượng
// document.querySelectorAll('[id^="decrease-"]').forEach(button => {
//     button.addEventListener('click', function () {
//         const itemId = this.id.split('-')[1];
//         const quantityInput = document.getElementById('quantity-' + itemId);
//         let value = parseInt(quantityInput.value) - 1;

//         if (value >= 1) {
//             quantityInput.value = value;
//             updateCartItem(itemId, value);
//         }
//     });
// });
// // Xử lý thay đổi số lượng khi nhập trực tiếp
// document.querySelectorAll('[id^="quantity-"]').forEach(input => {
//     input.addEventListener('change', function () {
//         const itemId = this.id.split('-')[1];
//         let value = parseInt(this.value);

//         if (isNaN(value) || value < 1) {
//             this.value = 1;
//             value = 1;
//         }

//         updateCartItem(itemId, value);
//     });
// });
window.muahang = function (id) {
    const soluong = document.getElementById('quantity')?.value || 1;
    if (soluong >= 1) {
        const url = `/trangthanhtoan/${id}`;
        fetch(url)
            .then(res => {
                const type = res.headers.get('Content-Type');
                if (type && type.includes('application/json')) {
                    return res.json().then(data => {
                        alert(data.message || "Lỗi không xác định");
                    });
                } else {
                    window.location.href = url;
                }
            })
            .catch(err => {
                alert("Đã xảy ra lỗi hệ thống.");
                console.error(err);
            });
    } else {
        alert("Số lượng không được âm");
    }
}
window.xoagiohang = function (id) {
    if (!confirm("Bạn có chắc chắn muốn xoá sản phẩm khỏi giỏ hàng?")) return;

    fetch(`/xoagiohang/${id}`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute("content")
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert("Xoá thất bại!");
            }
        })
        .catch(error => {
            console.error("Lỗi khi xoá:", error);
            alert("Đã xảy ra lỗi khi xoá sản phẩm.");
        });
}