const soluong = document.getElementById('soluongmua');
window.themvaogio = function (id_sp) {
    const soluong = document.getElementById('soluongmua')
    if (soluong.value >= 1) {
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
    const soluong = document.getElementById('soluongmua')?.value || 1;
    if (soluong >= 1) {
        const url = `/trangthanhtoan/${id}/${soluong}`;
        fetch(url)
            .then(res => {
                const type = res.headers.get('Content-Type');
                if (type && type.includes('application/json')) {
                    return res.json().then(data => {
                        alert(data.message || "Lỗi không xác định");
                    });
                } else {
                    window.location.href = url;
                }
            })
            .catch(err => {
                alert("Đã xảy ra lỗi hệ thống.");
                console.error(err);
            });
    } else {
        alert("Số lượng không được âm");
    }

}

const stars = document.querySelectorAll('.rating-input .star');
const ratingInput = document.getElementById('rating-value');
const comments = document.getElementById('comment');
stars.forEach(star => {
    star.addEventListener('click', function () {
        const rating = this.getAttribute('data-rating');
        ratingInput.value = rating;

        stars.forEach((s, index) => {
            if (index < rating) {
                s.textContent = '★';
                s.style.color = '#ffc107';
            } else {
                s.textContent = '☆';
                s.style.color = '#ffc107';
            }
        });
    });

    star.addEventListener('mouseover', function () {
        const rating = this.getAttribute('data-rating');

        stars.forEach((s, index) => {
            if (index < rating) {
                s.textContent = '★';
                s.style.color = '#ffc107';
            }
        });
    });

    star.addEventListener('mouseout', function () {
        const currentRating = ratingInput.value;

        stars.forEach((s, index) => {
            if (index >= currentRating) {
                s.textContent = '☆';
            }
        });
    });
});

// Xử lý nút like
document.querySelectorAll('.like-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        const countElement = this.querySelector('.like-count');
        let count = parseInt(countElement.textContent);
        countElement.textContent = count + 1;
        this.style.color = '#e74c3c';
        this.disabled = true;
    });
});

// Xử lý nút báo cáo
document.querySelectorAll('.report-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        if (confirm('Bạn có chắc muốn báo cáo đánh giá này vi phạm?')) {
            alert('Cảm ơn bạn đã báo cáo. Chúng tôi sẽ xem xét đánh giá này.');
        }
    });
});
window.danhgia = function (id) {
    const rating = parseInt(ratingInput.value);
    const comment = comments.value.trim();

    if (!rating || !comment) {
        alert("Vui lòng chọn số sao và viết cảm nhận.");
        return;
    }

    const data = {
        rating: rating,
        comment: comment,
    };

    console.log("Dữ liệu gửi đi:", data);

    fetch(`/danhgiasanpham/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute("content")
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(result => {
            console.log("Kết quả từ server:", result);
            alert("Đánh giá của bạn đã được gửi!");
            // Reset
            ratingInput.value = 0;
            comments.value = "";
            stars.forEach(s => s.textContent = "☆");
        })
        .catch(error => {
            console.error("Lỗi khi gửi đánh giá:", error);
            alert("Có lỗi xảy ra. Vui lòng thử lại sau.");
        });
}