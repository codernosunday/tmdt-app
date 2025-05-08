document.addEventListener('DOMContentLoaded', function () {
    const addForm = document.getElementById('addGiasaleForm');
    addForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(addForm);
        fetch('/administrator/themgianhap', {
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

            fetch(`/administrator/xemgianhap/${id}`)
                .then(res => res.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    document.getElementById('edit_id_gianhap').value = data.id_gianhap;
                    document.getElementById('edit_id_sanpham').value = data.id_sp;
                    document.getElementById('edit_gianhap').value = data.gianhap;
                    document.getElementById('edit_soluong').value = data.soluong;

                    // Chọn đúng chi tiết sản phẩm
                    const chitietSelect = document.getElementById('edit_chitietsanpham');
                    chitietSelect.value = data.id_ctsp;

                    // Chọn đúng nhà cung cấp
                    const nccSelect = document.getElementById('edit_nhacungcap');
                    nccSelect.value = data.id_nhacungcap;

                    const myModal = new bootstrap.Modal(document.getElementById('editGiasaleModal'));
                    myModal.show();
                })
                .catch(error => {
                    console.error(error);
                    alert('Có lỗi xảy ra khi tải dữ liệu!');
                });
        });
    });

    document.getElementById('editGiasaleForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch('/administrator/suagianhap', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert(data.success);
                    location.reload();
                } else if (data.error) {
                    alert(data.error);
                }
            })
            .catch(error => {
                console.error(error);
                alert('Có lỗi xảy ra khi cập nhật!');
            });
    });


    // Xóa chương trình khuyến mãi
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            if (confirm('Bạn có chắc chắn muốn phiếu nhập này?')) {
                fetch(`/administrator/xoagianhap/${id}`, {
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
