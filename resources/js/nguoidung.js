document.addEventListener('DOMContentLoaded', function () {
    // Format ngày sinh nếu có dữ liệu
    const dobValue = document.getElementById('dob-value').textContent;
    if (dobValue) {
        const parts = dobValue.split('/');
        if (parts.length === 3) {
            const formattedDate = `${parts[2]}-${parts[1].padStart(2, '0')}-${parts[0].padStart(2, '0')}`;
            document.getElementById('dob-input').value = formattedDate;
        }
    }
});

window.toggleEditForm = function (field) {
    const form = document.getElementById(`${field}-form`);
    const allForms = document.querySelectorAll('.edit-form');

    // Ẩn tất cả các form khác
    allForms.forEach(f => {
        if (f !== form) f.style.display = 'none';
    });

    // Hiển thị/ẩn form được chọn
    if (form.style.display === 'block') {
        form.style.display = 'none';
    } else {
        form.style.display = 'block';
    }
}

window.saveChanges = function (field) {
    const inputElement = document.getElementById(`${field}-input`);
    const valueElement = document.getElementById(`${field}-value`);

    if (field === 'dob') {
        // Xử lý định dạng ngày tháng
        const date = new Date(inputElement.value);
        const day = date.getDate().toString().padStart(2, '0');
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const year = date.getFullYear();
        valueElement.textContent = `${day}/${month}/${year}`;
    } else {
        valueElement.textContent = inputElement.value;
    }

    if (field === 'name') {
        document.getElementById('display-name').textContent = inputElement.value;
    }

    // Ẩn form sau khi lưu
    document.getElementById(`${field}-form`).style.display = 'none';

    // Gửi dữ liệu lên server qua AJAX
    updateUserProfile(field, inputElement.value);
}
window.updateUserProfile = function (field, value) {
    fetch('/nguoidung/capnhat', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
            field: field,
            value: field === 'dob' ? formatDateForServer(value) : value
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Cập nhật thành công!');
            } else {
                alert(data.message || 'Có lỗi xảy ra khi cập nhật.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Lỗi kết nối đến server.');
        });
}

function formatDateForServer(dateString) {
    const date = new Date(dateString);
    return date.toISOString().split('T')[0];
}