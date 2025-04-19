// DOM Elements
const formElements = {
    danhmuc: document.getElementById('danhmuc'),
    anh: document.getElementById('anh'),
    tensp: document.getElementById('tensp'),
    tomtatsp: document.getElementById('tomtatsp'),
    tinhtrang: document.getElementById('tinhtrang'),
    thuoctinh: document.getElementById('thuoctinh'),
    thuonghieu: document.getElementById('thuonghieu'),
    soluong: document.getElementById('soluong'),
    dattinh: document.getElementById('dattinh'),
    kichthuoc: document.getElementById('kichthuoc'),
    doday: document.getElementById('doday'),
    trongluong: document.getElementById('trongluong'),
    sotrang: document.getElementById('sotrang'),
    xuatsu: document.getElementById('xuatsu'),
    sanxuat: document.getElementById('sanxuat'),
    tieuchuan: document.getElementById('tieuchuan'),
    loiich: document.getElementById('loiich'),
    tinhnang: document.getElementById('tinhnang'),
    gianhap: document.getElementById('gianhap'),
    giaban: document.getElementById('giaban'),
    giasale: document.getElementById('giasale'),
    anhupload: document.getElementById('anhupload'),
    previewImage: document.getElementById('previewImage'),
    noImageText: document.getElementById('noImageText'),
    fileInfo: document.getElementById('fileInfo'),
    imageError: document.getElementById('imageError'),
    formStatus: document.getElementById('formStatus')
};

// State variables
let currentDanhMuc = formElements.danhmuc.value;
let fileAnh = null;

// Event Listeners
formElements.danhmuc.addEventListener('change', function () {
    currentDanhMuc = this.value;
});

formElements.anhupload.addEventListener('change', handleImageUpload);

// Thêm validation real-time cho các trường quan trọng
['tensp', 'soluong', 'gianhap', 'giaban', 'giasale'].forEach(id => {
    document.getElementById(id).addEventListener('blur', validateField);
});

// Main Submit Function
window.sendData = function () {
    if (!validateForm()) return;

    const formData = buildFormData();

    formElements.formStatus.textContent = 'Đang thêm sản phẩm mới...';
    formElements.formStatus.className = 'status-message processing';

    submitFormData(formData)
        .then(handleResponse)
        .catch(handleError);
};

// Helper Functions
function handleImageUpload(e) {
    const file = e.target.files[0];
    const { previewImage, noImageText, fileInfo, imageError } = formElements;

    // Reset states
    imageError.textContent = '';
    fileAnh = null;

    if (!file) {
        previewImage.style.display = 'none';
        noImageText.style.display = 'block';
        return;
    }

    // Validate file type
    if (!file.type.match('image.*')) {
        imageError.textContent = 'Chỉ chấp nhận file ảnh (JPEG, PNG)';
        return;
    }

    // Validate file size
    if (file.size > 2 * 1024 * 1024) {
        imageError.textContent = 'File quá lớn (tối đa 2MB)';
        return;
    }

    // Update UI and store file
    fileInfo.textContent = `${file.name} (${(file.size / 1024).toFixed(1)}KB)`;
    fileAnh = file;

    const reader = new FileReader();
    reader.onload = function (e) {
        previewImage.src = e.target.result;
        previewImage.style.display = 'block';
        noImageText.style.display = 'none';
    }
    reader.readAsDataURL(file);
}

function validateField(e) {
    const field = e.target;
    const value = field.value.trim();
    const numericValue = parseInt(value);
    const isNumericField = ['soluong', 'gianhap', 'giaban', 'giasale'].includes(field.id);

    if (field.id === 'tensp') {
        if (!value) {
            field.classList.add('is-invalid');
            return false;
        }
        field.classList.remove('is-invalid');
        return true;
    }

    if (isNumericField) {
        if (!value || isNaN(numericValue) || numericValue < 0) {
            field.classList.add('is-invalid');
            return false;
        }

        // Kiểm tra giá nhập phải nhỏ hơn giá bán
        if (field.id === 'gianhap') {
            const giabanValue = parseInt(formElements.giaban.value);
            if (giabanValue && numericValue >= giabanValue) {
                field.classList.add('is-invalid');
                formElements.formStatus.textContent = 'Giá nhập phải nhỏ hơn giá bán';
                formElements.formStatus.classList.add('error');
                return false;
            }
        }

        // Kiểm tra giá khuyến mãi phải nhỏ hơn giá bán
        if (field.id === 'giasale' && formElements.giaban.value &&
            numericValue >= parseInt(formElements.giaban.value)) {
            field.classList.add('is-invalid');
            formElements.formStatus.textContent = 'Giá khuyến mãi phải nhỏ hơn giá bán';
            formElements.formStatus.classList.add('error');
            return false;
        }

        field.classList.remove('is-invalid');
        return true;
    }

    return true;
}

function validateForm() {
    let isValid = true;
    const { formStatus, tensp, anh, anhupload, previewImage,
        soluong, gianhap, giaban, giasale } = formElements;

    // Reset status
    formStatus.textContent = '';
    formStatus.className = 'status-message';

    // Validate required fields
    if (!tensp.value.trim()) {
        tensp.classList.add('is-invalid');
        formStatus.textContent = 'Vui lòng nhập tên sản phẩm.';
        formStatus.classList.add('error');
        isValid = false;
    }

    // Validate image (URL, upload, or existing)
    if (!anh.value.trim() && !anhupload.files[0] && previewImage.style.display === 'none') {
        formElements.imageError.textContent = 'Vui lòng chọn ảnh hoặc nhập đường dẫn ảnh.';
        formStatus.textContent = 'Vui lòng cung cấp ảnh sản phẩm.';
        formStatus.classList.add('error');
        isValid = false;
    }

    // Validate số lượng không được âm
    const soluongValue = parseInt(soluong.value);
    if (!soluong.value.trim() || isNaN(soluongValue) || soluongValue < 0) {
        soluong.classList.add('is-invalid');
        formStatus.textContent = 'Số lượng không được âm';
        formStatus.classList.add('error');
        isValid = false;
    }

    // Validate giá nhập và giá bán
    const gianhapValue = parseInt(gianhap.value);
    const giabanValue = parseInt(giaban.value);

    if (!gianhap.value.trim() || isNaN(gianhapValue) || gianhapValue < 0) {
        gianhap.classList.add('is-invalid');
        formStatus.textContent = 'Giá nhập không hợp lệ';
        formStatus.classList.add('error');
        isValid = false;
    }

    if (!giaban.value.trim() || isNaN(giabanValue) || giabanValue < 0) {
        giaban.classList.add('is-invalid');
        formStatus.textContent = 'Giá bán không hợp lệ';
        formStatus.classList.add('error');
        isValid = false;
    }

    // Kiểm tra giá nhập phải nhỏ hơn giá bán
    if (gianhapValue >= giabanValue) {
        gianhap.classList.add('is-invalid');
        giaban.classList.add('is-invalid');
        formStatus.textContent = 'Giá nhập phải nhỏ hơn giá bán';
        formStatus.classList.add('error');
        isValid = false;
    }

    // Validate sale price if provided
    if (giasale.value.trim()) {
        const saleValue = parseInt(giasale.value);

        if (isNaN(saleValue) || saleValue < 0) {
            giasale.classList.add('is-invalid');
            formStatus.textContent = 'Giá khuyến mãi không hợp lệ.';
            formStatus.classList.add('error');
            isValid = false;
        } else if (saleValue >= giabanValue) {
            giasale.classList.add('is-invalid');
            formStatus.textContent = 'Giá khuyến mãi phải nhỏ hơn giá bán.';
            formStatus.classList.add('error');
            isValid = false;
        }
    }

    return isValid;
}

function buildFormData() {
    const formData = new FormData();
    const trangthai = document.querySelector('input[name="trangthai"]:checked')?.value || 'conhang';

    // Basic information
    formData.append('danhmuc', currentDanhMuc);
    formData.append('tensp', formElements.tensp.value.trim());
    formData.append('trangthai', trangthai);

    // Product details
    formData.append('tomtatsp', formElements.tomtatsp.value.trim());
    formData.append('anh', formElements.anh.value.trim());
    if (fileAnh) formData.append('fileanh', fileAnh);

    // Pricing and inventory
    formData.append('soluong', formElements.soluong.value);
    formData.append('gianhap', formElements.gianhap.value);
    formData.append('giaban', formElements.giaban.value);
    formData.append('giasale', formElements.giasale.value || '0');
    formData.append('tinhtrang', formElements.tinhtrang.checked ? '1' : '0');

    // Attributes
    formData.append('thuonghieu', formElements.thuonghieu.value.trim());
    formData.append('thuoctinh', formElements.thuoctinh.value);
    formData.append('xuatsu', formElements.xuatsu.value.trim());
    formData.append('sanxuat', formElements.sanxuat.value.trim());
    formData.append('tieuchuan', formElements.tieuchuan.value.trim());

    // Descriptions
    formData.append('dattinh', formElements.dattinh.value.trim());
    formData.append('loiich', formElements.loiich.value.trim());
    formData.append('tinhnang', formElements.tinhnang.value.trim());

    // Specifications
    formData.append('kichthuoc', formElements.kichthuoc.value.trim());
    formData.append('doday', formElements.doday.value.trim());
    formData.append('trongluong', formElements.trongluong.value.trim());
    formData.append('sotrang', formElements.sotrang.value.trim());

    return formData;
}

async function submitFormData(formData) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const response = await fetch('/administrator/themspmoi', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: formData
    });

    if (!response.ok) {
        throw new Error('Network response was not ok');
    }

    return response.json();
}

function handleResponse(data) {
    if (data.success) {
        formElements.formStatus.textContent = 'Thêm sản phẩm mới thành công!';
        formElements.formStatus.className = 'status-message success';

        // Reset form sau khi thêm thành công
        document.getElementById('productForm').reset();
        formElements.previewImage.style.display = 'none';
        formElements.noImageText.style.display = 'block';
        fileAnh = null;

        // Redirect sau 1.5 giây
        setTimeout(() => {
            window.location.reload();
        }, 1500);
    } else {
        formElements.formStatus.textContent = data.message || 'Có lỗi xảy ra khi thêm sản phẩm.';
        formElements.formStatus.className = 'status-message error';
    }
}

function handleError(error) {
    console.error('Error:', error);
    formElements.formStatus.textContent = 'Lỗi kết nối hoặc hệ thống. Vui lòng thử lại.';
    formElements.formStatus.className = 'status-message error';
}