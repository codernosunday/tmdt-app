//
const danhmuc = document.getElementById('danhmuc');
let chondm = danhmuc.value;
danhmuc.addEventListener('change', function () {
    chondm = danhmuc.value;
});
const anh = document.getElementById('anh');
const tensp = document.getElementById('tensp');
const tomtatsp = document.getElementById('tomtatsp');
const tinhtrang = document.getElementById('tinhtrang'); //còn hàng hoặc không còn hàng
//
const thuonghieu = document.getElementById('thuonghieu');
const soluong = document.getElementById('soluong');
const mausac = document.getElementById('mausac');
const mamau = document.getElementById('mamau');
const dattinh = document.getElementById('dattinh');
const kichthuoc = document.getElementById('kichthuoc');
const doday = document.getElementById('doday');
const trongluong = document.getElementById('trongluong');
const sotrang = document.getElementById('sotrang');
const chieurong = document.getElementById('chieurong');
const chieucao = document.getElementById('chieucao');
// giá
const gianhap = document.getElementById('gianhap');
const giaban = document.getElementById('giaban');
const giasale = document.getElementById('giasale')

window.updateData = function () {
    // Lấy id từ URL
    const path = window.location.pathname;
    const parts = path.split('/');
    const id = parts[parts.length - 1];

    // Kiểm tra xem id có hợp lệ không
    if (!id || isNaN(id)) {
        console.error('ID không hợp lệ');
        alert('ID không hợp lệ');
        return;
    }
    const sanpham = {
        danhmuc: chondm,
        id_sp: id,
        tensp: tensp.value,
        tomtatsp: tomtatsp.value,
        tinhtrang: tinhtrang.checked,
        gianhap: gianhap.value,
        soluong: soluong.value,
        thuonghieu: thuonghieu.value,
        mausac: mausac.value,
        anh: anh.value,
        mamau: mamau.value,
        dattinh: dattinh.value,
        kichthuoc: kichthuoc.value,
        doday: doday.value,
        trongluong: trongluong.value,
        sotrang: sotrang.value,
        chieurong: chieurong.value,
        chieucao: chieucao.value,
        giasale: giasale.value,
        giaban: giaban.value,
    };
    console.log(JSON.stringify(sanpham))
    // Gửi yêu cầu POST
    fetch('/administrator/capnhatsp/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify(sanpham),
    })
        .then(response => response.json().then(data => ({ status: response.status, body: data })))
        .then(({ status, body }) => {
            if (status !== 200) {
                console.error("Lỗi từ server:", body);
                let errorMessage = body.message || "Có lỗi xảy ra!";
                if (body.errors) {
                    errorMessage += "\n" + Object.values(body.errors).flat().join("\n");
                }
                alert(errorMessage);
                throw new Error(errorMessage);
            }

            alert(body.message);
        })
        .catch(error => {
            console.error("Lỗi:", error);
            alert(error.message || "Đã xảy ra lỗi không xác định!");
        });
};