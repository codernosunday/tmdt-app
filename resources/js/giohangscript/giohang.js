document.querySelectorAll('[id^="increase-"]').forEach(button => {
    button.addEventListener('click', function () {
        const itemId = this.id.split('-')[1];
        const quantityInput = document.getElementById('quantity-' + itemId);
        let value = parseInt(quantityInput.value) + 1;
        quantityInput.value = value;
        updateCartItem(itemId, value);
    });
});

// Xử lý giảm số lượng
document.querySelectorAll('[id^="decrease-"]').forEach(button => {
    button.addEventListener('click', function () {
        const itemId = this.id.split('-')[1];
        const quantityInput = document.getElementById('quantity-' + itemId);
        let value = parseInt(quantityInput.value) - 1;

        if (value >= 1) {
            quantityInput.value = value;
            updateCartItem(itemId, value);
        }
    });
});

// Xử lý thay đổi số lượng khi nhập trực tiếp
document.querySelectorAll('[id^="quantity-"]').forEach(input => {
    input.addEventListener('change', function () {
        const itemId = this.id.split('-')[1];
        let value = parseInt(this.value);

        if (isNaN(value) || value < 1) {
            this.value = 1;
            value = 1;
        }

        updateCartItem(itemId, value);
    });
});