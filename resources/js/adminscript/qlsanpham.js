const danhmuc = document.getElementById('danhmuc');
let chondm = 1;
danhmuc.addEventListener('change', function () {
    chondm = danhmuc.value;
});
//
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
console.log(tensp.value)
//object san pham
window.sendData = function () {
    const sanpham = {
        danhmuc: chondm,
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
        doday: doday.doday,
        trongluong: trongluong.value,
        sotrang: sotrang.value,
        chieurong: chieurong.value,
        chieucao: chieucao.value,
        giasale: giasale.value,
        giaban: giaban.value,
    };
    fetch('/administrator/themspmoi', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify(sanpham),
    })
        .then(response => response.json())
        .then(data => {
            console.error(data.message)
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
