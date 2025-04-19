window.kiemtradh = function () {
    const mahd = document.getElementById("mahoandon").value
    fetch(`/theodoidonhang/${mahd}`)
        .then(response => response.json())
        .then(json => {
            if (json.status === 'success') {
                document.getElementById('thongtindonhang').innerHTML = json.data;
            } else {
                alert(json.message);
            }
        })
        .catch(error => {
            console.error('Lỗi:', error);
            alert('Lỗi khi lấy thông tin đơn hàng!');
        });

}