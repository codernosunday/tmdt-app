let allUsers = window.allUsers || [];

// Mở popup chỉnh sửa
window.openEditModal = function (id) {
    const user = allUsers.find(u => u.id_nd == id);
    if (!user) return alert("Không tìm thấy người dùng!");

    document.getElementById('edit_id').value = user.id_nd;
    document.getElementById('edit_hovaten').value = user.hovaten || '';
    document.getElementById('edit_ngaysinh').value = user.ngaysinh || '';
    document.getElementById('edit_sodt').value = user.soDT || '';
    document.getElementById('edit_mail').value = user.mail || '';
    document.getElementById('edit_tinhtrantk').value = user.tinhtrantk || 'Đang hoạt động';
    document.getElementById('edit_quyentruycap').value = user.quyentruycap || 'User';
};

// Gửi dữ liệu cập nhật
document.getElementById('editUserForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const data = {
        id: document.getElementById('edit_id').value,
        hovaten: document.getElementById('edit_hovaten').value,
        ngaysinh: document.getElementById('edit_ngaysinh').value,
        sodt: document.getElementById('edit_sodt').value,
        mail: document.getElementById('edit_mail').value,
        tinhtrantk: document.getElementById('edit_tinhtrantk').value,
        quyentruycap: document.getElementById('edit_quyentruycap').value
    };

    fetch('/administrator/suaNguoiDung', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
        .then(res => {
            if (!res.ok) throw new Error('Lỗi HTTP: ' + res.status);
            return res.json();
        })
        .then(res => {
            if (res.success) {
                alert('Cập nhật thành công!');
                location.reload();
            } else {
                alert('Lỗi: ' + (res.message || 'Cập nhật thất bại!'));
            }
        })
        .catch(err => {
            console.error('Lỗi khi cập nhật:', err);
            alert('Có lỗi xảy ra. Vui lòng thử lại!');
        });
});
