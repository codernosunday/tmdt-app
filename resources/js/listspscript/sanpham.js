const soluong = document.getElementById('soluongmua');
window.themvaogio = function (id_sp) {
    const soluong = document.getElementById('soluongmua')
    const ctsp = document.getElementById('chonchitiet')
    const ctgh = {
        'id_ctsp': ctsp.value,
        'id_sp': id_sp,
        'soluong': soluong.value
    }
    fetch('/themvaogio', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify(ctgh),
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            window.location.href = '/cart'
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
var selectElement = document.getElementById('chonchitiet');
selectElement.addEventListener('change', function () {

    var chonchitiet = selectElement.value;
    fetch(`/xemsanpham/${chonchitiet}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Có lỗi xảy ra khi gọi API');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                console.log('Giá bán:', data.giaban);
                console.log('Giá nhập:', data.soluong);
                var giaban = parseFloat(data.giaban);
                giaban = giaban.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
                document.getElementById("giaban").textContent = giaban;
                document.getElementById("soluong").textContent = "Còn hàng: " + data.soluong;
            } else {
                alert('Không tìm thấy thông tin chi tiết sản phẩm');
            }
        })
        .catch(error => {
            console.error('Lỗi:', error);
        });

});
window.muangay = function (id) {
    window.location.href = `/trangthanhtoan/${id}/${soluong.value}`;
}