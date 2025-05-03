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
    let tinh = null;
    let huyen = null;
    let xa = null;
    try {
        tinh = provinceSelect.options[provinceSelect.selectedIndex].text;
        huyen = districtSelect.options[districtSelect.selectedIndex].text;
        xa = wardSelect.options[wardSelect.selectedIndex].text;
    } catch {
    }
    fetch('/nguoidung/capnhat', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
            field: field,
            value: field === 'dob' ? formatDateForServer(value) : value,
            tinh: field === 'address' ? tinh : null,
            huyen: field === 'address' ? huyen : null,
            xa: field === 'address' ? xa : null,
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
//tỉnh thành phố
const provinceSelect = document.getElementById("province");
const districtSelect = document.getElementById("district");
const wardSelect = document.getElementById("ward");
const addressInput = document.getElementById("full_address");

// Lưu tạm tên đã chọn
let selectedProvince = "";
let selectedDistrict = "";
let selectedWard = "";
// Load danh sách tỉnh
fetch("https://provinces.open-api.vn/api/?depth=1")
    .then(res => res.json())
    .then(data => {
        data.forEach(province => {
            const option = document.createElement("option");
            option.value = province.code;
            option.textContent = province.name;
            provinceSelect.appendChild(option);
        });
    });

// Khi chọn tỉnh
provinceSelect.addEventListener("change", function () {
    const provinceCode = this.value;
    selectedProvince = this.options[this.selectedIndex].text;
    districtSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>';
    wardSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
    if (!provinceCode) return;
    fetch(`https://provinces.open-api.vn/api/p/${provinceCode}?depth=2`)
        .then(res => res.json())
        .then(data => {
            data.districts.forEach(district => {
                const option = document.createElement("option");
                option.value = district.code;
                option.textContent = district.name;
                districtSelect.appendChild(option);
            });
        });
});

// Khi chọn quận/huyện
districtSelect.addEventListener("change", function () {
    const districtCode = this.value;
    selectedDistrict = this.options[this.selectedIndex].text;
    wardSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
    if (!districtCode) return;

    fetch(`https://provinces.open-api.vn/api/d/${districtCode}?depth=2`)
        .then(res => res.json())
        .then(data => {
            data.wards.forEach(ward => {
                const option = document.createElement("option");
                option.value = ward.code;
                option.textContent = ward.name;
                wardSelect.appendChild(option);
            });
        });
});

// Khi chọn phường/xã → Gán vào input hidden
wardSelect.addEventListener("change", function () {
    selectedWard = this.options[this.selectedIndex].text;
    addressInput.value = `${selectedWard}, ${selectedDistrict}, ${selectedProvince}`;
});