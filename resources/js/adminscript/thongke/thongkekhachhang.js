document.addEventListener('DOMContentLoaded', function () {
    fetchData();
});

const sampleData = {
    userGrowth: {
        labels: [],
        data: []
    },
    userLocation: {
        labels: [],
        data: [],
        backgroundColor: [
            '#4a6fa5',
            '#6b8cae',
            '#8da9c4',
            '#afc6d9',
            '#d1e3ef'
        ]
    },
    ageDistribution: {
        labels: [],
        data: []
    }
};

// Khởi tạo biểu đồ tăng trưởng người dùng
const growthCtx = document.getElementById('userGrowthChart').getContext('2d');
const userGrowthChart = new Chart(growthCtx, {
    type: 'line',
    data: {
        labels: sampleData.userGrowth.labels,
        datasets: [{
            label: 'Tổng số người dùng',
            data: sampleData.userGrowth.data,
            borderColor: '#4a6fa5',
            backgroundColor: 'rgba(74, 111, 165, 0.1)',
            borderWidth: 2,
            tension: 0.3,
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Tăng Trưởng Người Dùng',
                font: {
                    size: 16
                }
            },
            legend: {
                position: 'top',
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Khởi tạo biểu đồ phân bố địa lý
const locationCtx = document.getElementById('userLocationChart').getContext('2d');
const userLocationChart = new Chart(locationCtx, {
    type: 'doughnut',
    data: {
        labels: sampleData.userLocation.labels,
        datasets: [{
            data: sampleData.userLocation.data,
            backgroundColor: sampleData.userLocation.backgroundColor,
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Phân Bố Người Dùng Theo Khu Vực',
                font: {
                    size: 16
                }
            },
            legend: {
                position: 'right',
            }
        }
    }
});

// Khởi tạo biểu đồ phân bố độ tuổi
const ageCtx = document.getElementById('ageDistributionChart').getContext('2d');
const ageDistributionChart = new Chart(ageCtx, {
    type: 'polarArea',
    data: {
        labels: sampleData.ageDistribution.labels,
        datasets: [{
            data: sampleData.ageDistribution.data,
            backgroundColor: [
                '#4a6fa5',
                '#6b8cae',
                '#8da9c4',
                '#afc6d9',
                '#d1e3ef',
                '#f0f7fa'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Phân Bố Độ Tuổi Người Dùng',
                font: {
                    size: 16
                }
            },
            legend: {
                position: 'right',
            }
        }
    }
});

async function fetchData() {
    try {
        const response = await fetch('/administrator/thongkenguoidung/data');
        const data = await response.json();

        // Cập nhật số liệu tổng
        document.getElementById('total-users').innerText = data.tong;
        document.getElementById('new-users').innerText = data.ndmoi;

        // Cập nhật biểu đồ tăng trưởng
        userGrowthChart.data.labels = data.userGrowth.map(item => item.label);
        userGrowthChart.data.datasets[0].data = data.userGrowth.map(item => item.value);
        userGrowthChart.update();

        // Cập nhật biểu đồ địa lý
        userLocationChart.data.labels = data.userLocation.map(item => item.label);
        userLocationChart.data.datasets[0].data = data.userLocation.map(item => item.value);
        userLocationChart.update();

        // Cập nhật biểu đồ độ tuổi
        ageDistributionChart.data.labels = Object.keys(data.ageDistribution);
        ageDistributionChart.data.datasets[0].data = Object.values(data.ageDistribution);
        ageDistributionChart.update();

    } catch (error) {
        console.error('Lỗi khi fetch dữ liệu thống kê:', error);
    }
}