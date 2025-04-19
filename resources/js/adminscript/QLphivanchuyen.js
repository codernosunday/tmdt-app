document.addEventListener('DOMContentLoaded', function () {
    if (window.jQuery && $.fn.DataTable) {
        $('#shippingTable').DataTable();
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    function closeModal(modalId) {
        const modal = bootstrap.Modal.getInstance(document.getElementById(modalId));
        if (modal) modal.hide();
    }

    function showError(error) {
        if (typeof error.json === 'function') {
            error.json().then(err => alert(err.message || 'Đã xảy ra lỗi!'));
        } else {
            alert('Đã xảy ra lỗi không xác định!');
        }
    }

    // Thêm mới
    document.getElementById('addShippingForm')?.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch('/administrator/themphivanchuyen', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            body: formData
        })
            .then(res => res.ok ? res.json() : Promise.reject(res))
            .then(() => {
                closeModal('addShippingModal');
                location.reload();
            })
            .catch(showError);
    });

    // Sửa
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            fetch(`/administrator/xempvc/${id}`)
                .then(res => res.ok ? res.json() : Promise.reject(res))
                .then(data => {
                    document.getElementById('edit_id_phi').value = data.id_phi;
                    document.getElementById('edit_khuvuc').value = data.khuvuc;
                    document.getElementById('edit_phuongthuc').value = data.phuongthuc;
                    document.getElementById('edit_giaphi').value = data.giaphi;
                    document.getElementById('edit_ghichu').value = data.ghichu;
                    new bootstrap.Modal(document.getElementById('editShippingModal')).show();
                })
                .catch(showError);
        });
    });

    document.getElementById('editShippingForm')?.addEventListener('submit', function (e) {
        e.preventDefault();
        const id = document.getElementById('edit_id_phi').value;
        const formData = new FormData(this);
        fetch(`/administrator/chinhsuavanchuyen/${id}`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            body: formData
        })
            .then(res => res.ok ? res.json() : Promise.reject(res))
            .then(() => {
                closeModal('editShippingModal');
                location.reload();
            })
            .catch(showError);
    });

    // Xóa
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('delete_id_phi').value = this.dataset.id;
            new bootstrap.Modal(document.getElementById('deleteShippingModal')).show();
        });
    });

    document.getElementById('confirmDelete')?.addEventListener('click', function () {
        const id = document.getElementById('delete_id_phi').value;
        fetch(`/administrator/xoaphivanchuyen/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        })
            .then(res => res.ok ? res.json() : Promise.reject(res))
            .then(() => {
                closeModal('deleteShippingModal');
                location.reload();
            })
            .catch(showError);
    });
});
