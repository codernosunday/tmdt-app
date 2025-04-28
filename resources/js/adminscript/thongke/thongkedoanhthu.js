document.addEventListener('DOMContentLoaded', function () {
    loadData('month'); // hoặc 'year', 'quarter' tùy mặc định bạn muốn
});
// Xử lý chuyển đổi giữa các tab thời gian
const timeBtns = document.querySelectorAll('.time-btn');
timeBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        timeBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        // Gọi hàm load dữ liệu tương ứng
        loadData(btn.dataset.period);
    });
});

// Khởi tạo biểu đồ doanh thu
const revenueCtx = document.getElementById('revenue-chart').getContext('2d');
const revenueChart = new Chart(revenueCtx, {
    type: 'line',
    data: {
        labels: [],
        datasets: [{
            label: 'Doanh thu (VNĐ)',
            data: [],
            borderColor: '#3498db',
            backgroundColor: 'rgba(52, 152, 219, 0.1)',
            borderWidth: 2,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label: function (context) {
                        return context.dataset.label + ': ' + context.parsed.y.toLocaleString() + ' VNĐ';
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function (value) {
                        return value + ' VNĐ';
                    }
                }
            }
        }
    }
});

// Khởi tạo biểu đồ so sánh
const comparisonCtx = document.getElementById('comparison-chart').getContext('2d');
const comparisonChart = new Chart(comparisonCtx, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [
            {
                label: 'Năm 2024',
                data: [],
                backgroundColor: 'rgba(52, 152, 219, 0.7)',
                borderColor: 'rgba(52, 152, 219, 1)',
                borderWidth: 1
            },
            {
                label: 'Năm 2025',
                data: [125, 118, 132, null, null, null, null, null, null, null, null, null],
                backgroundColor: 'rgba(46, 204, 113, 0.7)',
                borderColor: 'rgba(46, 204, 113, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label: function (context) {
                        return context.dataset.label + ': ' + context.parsed.y.toLocaleString() + ' VNĐ';
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function (value) {
                        return value + ' VNĐ';
                    }
                }
            }
        }
    }
});
// Khởi tạo ngày mặc định
document.getElementById('start-date').valueAsDate = new Date();
document.getElementById('end-date').valueAsDate = new Date();
// Hàm load dữ liệu theo khoảng thời gian
function loadData(period) {
    // Đây là nơi bạn sẽ gọi API để lấy dữ liệu
    console.log('Loading data for period:', period);
    fetch(`/administrator/thongkedoanhthu/thongke?period=${period}`, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
        .then(response => response.json())
        .then(data => {
            updateRevenueChart(data.revenueData);
            updateComparisonChart(data.comparisonData);
            updateTable(data.tableData);
        })
        .catch(error => console.error('Error loading data:', error));
}

function updateComparisonChart(data) {
    comparisonChart.data.labels = data.labels; // Cập nhật labels trước (ví dụ: ["T1", "T2", "T3"] hoặc ["Q1", "Q2"])

    comparisonChart.data.datasets[0].data = data.values.previous; // Dữ liệu kỳ trước
    comparisonChart.data.datasets[1].data = data.values.current;  // Dữ liệu kỳ hiện tại

    comparisonChart.update();
}

function updateRevenueChart(data) {
    revenueChart.data.labels = data.labels;
    revenueChart.data.datasets[0].data = data.values;
    revenueChart.update();
}

function updateTable(data) {
    const tbody = document.querySelector('.data-table tbody');
    tbody.innerHTML = ''; // Xóa nội dung cũ

    data.forEach(row => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${row.time}</td>
            <td>${row.revenue.toLocaleString()} ₫</td>
            <td>${row.orders}</td>
            <td>${row.avgValue.toLocaleString()} ₫</td>
            
        `;
        tbody.appendChild(tr);
    });
}
{/* <td class="change ${row.growth >= 0 ? 'up' : 'down'}">
                ${row.growth >= 0 ? '+' : ''}${row.growth}%
            </td> */}