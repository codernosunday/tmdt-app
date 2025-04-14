
//
const thuonghieu = document.getElementById('thuonghieu');
const soluong = document.getElementById('soluong');
const mausac = document.getElementById('mausac');
const dattinh = document.getElementById('dattinh');
const kichthuoc = document.getElementById('kichthuoc');
const doday = document.getElementById('doday');
const trongluong = document.getElementById('trongluong');
const sotrang = document.getElementById('sotrang');
//moi
const xuatsu = document.getElementById('xuatsu');
const sanxuat = document.getElementById('sanxuat');
const tieuchuan = document.getElementById('tieuchuan');
const loiich = document.getElementById('loiich');
const tinhnang = document.getElementById('tinhnang');
// giá
const gianhap = document.getElementById('gianhap');
const giaban = document.getElementById('giaban');
const giasale = document.getElementById('giasale')
window.themCTmoi = function (id) {
    const ctsanpham = {
        id_sp: id,
        gianhap: gianhap.value,
        soluong: soluong.value,
        thuonghieu: thuonghieu.value,
        mausac: mausac.value,
        dattinh: dattinh.value,
        kichthuoc: kichthuoc.value,
        doday: doday.value,
        trongluong: trongluong.value,
        sotrang: sotrang.value,
        giasale: giasale.value,
        giaban: giaban.value,
        xuatsu: xuatsu.value,
        sanxuat: sanxuat.value,
        tieuchuan: tieuchuan.value,
        loiich: loiich.value,
        tinhnang: tinhnang.value
    };
    fetch('/administrator/postthemchitietmoi', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify(ctsanpham),
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
}