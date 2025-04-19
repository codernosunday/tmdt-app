// DOM Elements
const formElements = {
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
    formStatus: document.getElementById('formStatus'),
};

// Form Validation on Blur
['soluong', 'gianhap', 'giaban', 'giasale'].forEach(id => {
    document.getElementById(id).addEventListener('blur', validateField);
});

// Main Update Function
window.themCTSP = function (idsp) {
    if (!validateForm()) return;

    const formData = buildFormData(idsp);

    formElements.formStatus.textContent = 'Đang cập nhật sản phẩm...';
    formElements.formStatus.className = 'status-message processing';

    submitFormData(formData)
        .then(handleResponse)
        .catch(handleError);
};

// Validation Functions
function validateField(e) {
    const field = e.target;
    const value = field.value.trim();
    const numericValue = parseInt(value);
    const isNumericField = ['soluong', 'gianhap', 'giaban', 'giasale'].includes(field.id);

    if (isNumericField) {
        if (!value || isNaN(numericValue) || numericValue < 0) {
            field.classList.add('is-invalid');
            return false;
        }

        if (field.id === 'giasale' && numericValue >= parseInt(formElements.giaban.value)) {
            field.classList.add('is-invalid');
            return false;
        }

        field.classList.remove('is-invalid');
        return true;
    }

    return true;
}

function validateForm() {
    let isValid = true;
    const { formStatus, soluong, gianhap, giaban, giasale } = formElements;

    formStatus.textContent = '';
    formStatus.className = 'status-message';

    ['soluong', 'gianhap', 'giaban'].forEach(id => {
        const field = formElements[id];
        const value = field.value.trim();

        if (!value || isNaN(value) || parseInt(value) < 0) {
            field.classList.add('is-invalid');
            formStatus.textContent = `Vui lòng kiểm tra lại thông tin ${field.labels[0].textContent.toLowerCase()}`;
            formStatus.classList.add('error');
            isValid = false;
        }
    });

    if (giasale.value.trim()) {
        const saleValue = parseInt(giasale.value);
        const sellValue = parseInt(giaban.value);

        if (isNaN(saleValue)) {
            giasale.classList.add('is-invalid');
            formStatus.textContent = 'Giá khuyến mãi không hợp lệ.';
            formStatus.classList.add('error');
            isValid = false;
        } else if (saleValue >= sellValue) {
            giasale.classList.add('is-invalid');
            formStatus.textContent = 'Giá khuyến mãi phải nhỏ hơn giá bán.';
            formStatus.classList.add('error');
            isValid = false;
        }
    }

    return isValid;
}

// Form Data Construction
function buildFormData(idsp) {
    const formData = new FormData();

    formData.append('id_sp', idsp);
    formData.append('thuoctinh', formElements.thuoctinh.value);
    formData.append('thuonghieu', formElements.thuonghieu.value.trim());
    formData.append('soluong', formElements.soluong.value);
    formData.append('gianhap', formElements.gianhap.value);
    formData.append('giaban', formElements.giaban.value);
    formData.append('giasale', formElements.giasale.value || '0');
    formData.append('dattinh', formElements.dattinh.value.trim());
    formData.append('kichthuoc', formElements.kichthuoc.value.trim());
    formData.append('doday', formElements.doday.value.trim());
    formData.append('trongluong', formElements.trongluong.value.trim());
    formData.append('sotrang', formElements.sotrang.value.trim());
    formData.append('xuatsu', formElements.xuatsu.value.trim());
    formData.append('sanxuat', formElements.sanxuat.value.trim());
    formData.append('tieuchuan', formElements.tieuchuan.value.trim());
    formData.append('loiich', formElements.loiich.value.trim());
    formData.append('tinhnang', formElements.tinhnang.value.trim());

    return formData;
}

// Submit Form
async function submitFormData(formData) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const response = await fetch('/administrator/postthemchitietmoi', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: formData
    });

    if (!response.ok) throw new Error('Network response was not ok');
    return response.json();
}

// Handle Server Response
function handleResponse(data) {
    if (data.success) {
        formElements.formStatus.textContent = 'Cập nhật sản phẩm thành công!';
        formElements.formStatus.className = 'status-message success';
    } else {
        formElements.formStatus.textContent = data.message || 'Có lỗi xảy ra khi cập nhật sản phẩm.';
        formElements.formStatus.className = 'status-message error';
    }
}

// Handle Errors
function handleError(error) {
    console.error('Error:', error);
    formElements.formStatus.textContent = 'Lỗi kết nối hoặc hệ thống. Vui lòng thử lại.';
    formElements.formStatus.className = 'status-message error';
}
