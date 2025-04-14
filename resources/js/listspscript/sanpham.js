window.themvaogio = function (id_sp) {
    const soluong = document.getElementById('soluong')
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
            console.log(data.message);
        })
        .catch(error => {
            console.error('Error:', error);
        });
}