
const provinceSelect = document.getElementById("province");
const districtSelect = document.getElementById("district");
const wardSelect = document.getElementById("ward");
const addressInput = document.getElementById("full_address");
window.magiamgia = function () {
    const magiamgia = document.getElementById("magiamgia").value;
    // Dọn sạch thông báo cũ và badge cũ
    document.getElementById('dsgiamgia').innerHTML = '';
    document.getElementById('mggnote').textContent = '';
    document.getElementById('giaSale').textContent = '';

    fetch('/dathang/magiamgia', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ magiamgia }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.dieukien) {
                const container = document.getElementById('dsgiamgia');
                const badge = document.createElement('div');
                badge.className = 'badge';
                badge.textContent = `${data.ten}`;
                container.appendChild(badge);
                const tdh = parseInt(window.appData.tonghienthi) - parseInt(data.giasale);
                const tong = new Intl.NumberFormat('vi-VN').format(tdh) + ' đ';
                const gia = new Intl.NumberFormat('vi-VN').format(data.giasale) + ' đ';
                window.appData.id_giasale = data.id_magiamgia;
                document.getElementById('giaSale').textContent = gia;
                document.getElementById('tongdh').textContent = tong;
            } else {
                document.getElementById('giaSale').textContent = 'Nhập mã giảm giá';
                document.getElementById('mggnote').textContent = 'Mã giảm giá không đúng';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

window.dathang = function () {
    const sodt = document.getElementById('phone').value.trim();
    const ten = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    let diachi = document.getElementById('address').value.trim();
    const ghichu = document.getElementById('note').value.trim();
    const tructiep = document.getElementById('cod');
    const banking = document.getElementById('banking');
    const vnpay = document.getElementById('vnpay');
    const districtSelect = document.getElementById('district');
    const districtText = districtSelect.options[districtSelect.selectedIndex].text;
    const provinceSelect = document.getElementById('province');
    const provinceText = provinceSelect.options[provinceSelect.selectedIndex].text;
    const wardSelect = document.getElementById('ward');
    const wardText = wardSelect.options[wardSelect.selectedIndex].text;
    diachi = provinceText + ", " + districtText + ", " + wardText + " " + diachi;
    let hinhthuctt;
    if (tructiep.checked) {
        hinhthuctt = 'Thanh toán khi nhận hàng'
    }
    if (vnpay.checked) {
        hinhthuctt = 'Thanh toán bằng ví vnpay'
    }
    const dathang = {
        'id_ctgh': window.appData.id_ctgh,
        'tong': window.appData.tongTienGoc,
        'id_giasale': window.appData.id_giasale,
        'id_ctsp': window.appData.id_ctsp,
        'id_phi': window.appData.id_phi,
        'id_vanchuyen': window.appData.id_vanchuyen,
        'soluong': window.appData.soluong,
        'sodt': sodt,
        'ten': ten,
        'email': email,
        'diachi': diachi,
        'ghichu': ghichu,
        'hinhthuctt': hinhthuctt
    }
    // console.log(JSON.stringify(dathang));
    if (!confirm("Bạn có chắc chắn muốn đặt hàng?")) return;
    if (validateOrderForm()) {
        fetch('/donhang/dathang', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify(dathang),
        })
            .then(response => response.json())
            .then(data => {
                if (data.dieukien) {
                    alert(data.message);
                    if (data.vnpayLink) window.location.href = data.vnpayLink;
                    else window.location.href = "/theodoidonhang";
                }
            })
            .catch(err => {
                console.error("Lỗi:", err);
                alert(err.message || "Đặt hàng thất bại!");
            });
    }

}

function validateOrderForm() {
    // Lấy giá trị từ form
    const phone = document.getElementById('phone').value.trim();
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const address = document.getElementById('address').value.trim();
    const note = document.getElementById('note').value.trim();

    // Reset thông báo lỗi và class invalid
    document.getElementById('phoneError').textContent = '';
    document.getElementById('phone').classList.remove('is-invalid');
    document.getElementById('nameError').textContent = '';
    document.getElementById('name').classList.remove('is-invalid');
    document.getElementById('emailError').textContent = '';
    document.getElementById('email').classList.remove('is-invalid');
    document.getElementById('addressError').textContent = '';
    document.getElementById('address').classList.remove('is-invalid');

    // Biến kiểm tra hợp lệ
    let isValid = true;

    // Validate số điện thoại
    if (!phone) {
        document.getElementById('phoneError').textContent = 'Vui lòng nhập số điện thoại';
        document.getElementById('phone').classList.add('is-invalid');
        isValid = false;
    } else if (!/^(0|\+84)(\d{9,10})$/.test(phone)) {
        document.getElementById('phoneError').textContent = 'Số điện thoại không hợp lệ';
        document.getElementById('phone').classList.add('is-invalid');
        isValid = false;
    }

    // Validate họ tên
    if (!name) {
        document.getElementById('nameError').textContent = 'Vui lòng nhập họ tên';
        document.getElementById('name').classList.add('is-invalid');
        isValid = false;
    } else if (name.length < 3) {
        document.getElementById('nameError').textContent = 'Họ tên quá ngắn';
        document.getElementById('name').classList.add('is-invalid');
        isValid = false;
    } else if (!/^[a-zA-ZÀ-ỹ\s]+$/.test(name)) {
        document.getElementById('nameError').textContent = 'Họ tên chỉ được chứa chữ cái và khoảng trắng';
        document.getElementById('name').classList.add('is-invalid');
        isValid = false;
    }

    // Validate email
    if (!email) {
        document.getElementById('emailError').textContent = 'Vui lòng nhập email';
        document.getElementById('email').classList.add('is-invalid');
        isValid = false;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        document.getElementById('emailError').textContent = 'Email không hợp lệ';
        document.getElementById('email').classList.add('is-invalid');
        isValid = false;
    }

    // Validate địa chỉ
    if (!address) {
        document.getElementById('addressError').textContent = 'Vui lòng nhập địa chỉ';
        document.getElementById('address').classList.add('is-invalid');
        isValid = false;
    } else if (address.length < 10) {
        document.getElementById('addressError').textContent = 'Địa chỉ quá ngắn, vui lòng nhập chi tiết hơn';
        document.getElementById('address').classList.add('is-invalid');
        isValid = false;
    }
    //Kiểm tra địa chỉ
    const province = document.getElementById('province').value.trim();
    const district = document.getElementById('district').value.trim();
    const ward = document.getElementById('ward').value.trim();
    if (!province) {
        isValid = false;
        alert("Vui lòng chọn Tỉnh/Thành phố");
    } else if (!district) {
        isValid = false;
        alert("Vui lòng chọn Quận/Huyện");
    } else if (!ward) {
        isValid = false;
        alert("Vui lòng chọn Phường/Xã");
    } else if (!address) {
        isValid = false;
        document.getElementById('addressError').textContent = "Vui lòng nhập địa chỉ nhận hàng.";
        document.getElementById('address').classList.add('is-invalid');
    } else {
        document.getElementById('addressError').textContent = "";
        document.getElementById('address').classList.remove('is-invalid');
    }
    // Trả về kết quả kiểm tra
    return isValid;
}

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
