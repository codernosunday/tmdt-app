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
const thuoctinh = document.getElementById('thuoctinh');
//
const thuonghieu = document.getElementById('thuonghieu');
const soluong = document.getElementById('soluong');

const mamau = document.getElementById('mamau');
const dattinh = document.getElementById('dattinh');
const kichthuoc = document.getElementById('kichthuoc');
const doday = document.getElementById('doday');
const trongluong = document.getElementById('trongluong');
const sotrang = document.getElementById('sotrang');
const chieurong = document.getElementById('chieurong');
const chieucao = document.getElementById('chieucao');
// mới
const xuatsu = document.getElementById('xuatsu');
const sanxuat = document.getElementById('sanxuat');
const tieuchuan = document.getElementById('tieuchuan');
const loiich = document.getElementById('loiich');
const tinhnang = document.getElementById('tinhnang');
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
        giasale: giasale.value,
        giaban: giaban.value,
        tomtatsp: tomtatsp.value,
        tinhtrang: tinhtrang.checked,
        gianhap: gianhap.value,
        soluong: soluong.value,
        thuonghieu: thuonghieu.value,
        thuoctinh: thuoctinh.value,
        anh: anh.value,
        mamau: mamau.value,
        dattinh: dattinh.value,
        kichthuoc: kichthuoc.value,
        doday: doday.doday,
        trongluong: trongluong.value,
        sotrang: sotrang.value,
        xuatsu: xuatsu.value,
        sanxuat: sanxuat.value,
        tieuchuan: tieuchuan.value,
        loiich: loiich.value,
        tinhnang: tinhnang.value
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
            alert(data.message);
            console.log(data.message);
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
