document.addEventListener('DOMContentLoaded', function () {
    // Thêm mới chương trình khuyến mãi
    const addForm = document.getElementById('addGiasaleForm');
    addForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(addForm);
        fetch('/administrator/themgiasale', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.success);
                    location.reload();
                }
            })
            .catch(error => alert('Có lỗi xảy ra!'));
    });

    // Sửa chương trình khuyến mãi
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            fetch(`/administrator/xemgiasale/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('edit_id_giasale').value = data.id_giasale;
                    document.getElementById('edit_ten').value = data.ten;
                    document.getElementById('edit_magiamgia').value = data.magiamgia;
                    document.getElementById('edit_giasale').value = data.giasale;
                    document.getElementById('edit_ketthuc').value = data.ketthuc;

                    const myModal = new bootstrap.Modal(document.getElementById('editGiasaleModal'));
                    myModal.show();
                });
        });
    });

    // Cập nhật chương trình khuyến mãi
    const editForm = document.getElementById('editGiasaleForm');
    editForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const id = document.getElementById('edit_id_giasale').value;
        const formData = new FormData(editForm);
        fetch(`/administrator/capnhatgiasale/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.success);
                    location.reload();
                }
            })
            .catch(error => alert('Có lỗi xảy ra!'));
    });

    // Xóa chương trình khuyến mãi
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            if (confirm('Bạn có chắc chắn muốn xóa chương trình khuyến mãi này?')) {
                fetch(`/administrator/xoagiasale/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.success);
                            location.reload();
                        } else {
                            alert(data.error);
                        }
                    })
                    .catch(error => alert('Có lỗi xảy ra!'));
            }
        });
    });
});
