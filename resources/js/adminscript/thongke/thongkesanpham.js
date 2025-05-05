//
async function fetchThongKeSanPham() {
    try {
        const response = await fetch('/administrator/thongkesanpham/data');
        const data = await response.json();

        if (data.status === 'success') {
            updateCategoryDistributionChart(data.data.categoryDistribution);
            updateInventoryStatusChart(data.data.inventoryStatus);
            renderTopSellingProductsTable(data.data.topSellingProducts); // Bây giờ là bảng
            updateCategoryPerformanceChart(data.data.categoryPerformance);
        } else {
            console.error('Lỗi server:', data.message);
            console.error('Chi tiết:', data.error_detail);
            console.error('File:', data.file, 'Dòng:', data.line);
            alert('Đã có lỗi xảy ra khi lấy dữ liệu thống kê. Vui lòng thử lại sau!');
        }
    } catch (error) {
        console.error('Lỗi kết nối server:', error);
    }
}

function updateCategoryDistributionChart(categoryDistribution) {
    const labels = categoryDistribution.map(c => c.tendanhmuc);
    const percentages = categoryDistribution.map(c => c.percentage);

    categoryDistChart.data.labels = labels;
    categoryDistChart.data.datasets[0].data = percentages;
    categoryDistChart.update();
}

function updateInventoryStatusChart(inventoryStatus) {
    inventoryChart.data.datasets[0].data = [
        inventoryStatus.stocked,
        inventoryStatus.low,
        inventoryStatus.out
    ];
    inventoryChart.update();
}

function renderTopSellingProductsTable(topSellingProducts) {
    const tableBody = document.getElementById('topSellingProductsTableBody');
    tableBody.innerHTML = ''; // Clear old data

    topSellingProducts.forEach((product, index) => {
        const row = `<tr>
            <td>${index + 1}</td>
            <td>${product.tensp}</td>
            <td>${product.total_sold}</td>
        </tr>`;
        tableBody.innerHTML += row;
    });
}

function updateCategoryPerformanceChart(categoryPerformance) {
    const labels = categoryPerformance.map(c => c.ten);
    const sales = categoryPerformance.map(c => c.total_sales);
    const profits = categoryPerformance.map(c => c.total_profit);

    categoryPerfChart.data.labels = labels;
    categoryPerfChart.data.datasets[0].data = sales;
    categoryPerfChart.data.datasets[1].data = profits;
    categoryPerfChart.update();
}
// Gọi fetch khi trang load
document.addEventListener('DOMContentLoaded', fetchThongKeSanPham);

// Dữ liệu mẫu cho biểu đồ
const productData = {
    categoryDistribution: {
        labels: ['Điện tử', 'Thời trang', 'Gia dụng', 'Thể thao', 'Phụ kiện', 'Khác'],
        data: [35, 25, 15, 12, 8, 5],
        colors: ['#4e79a7', '#f28e2b', '#59a96a', '#e15759', '#76b7b2', '#edc948']
    },
    inventory: {
        labels: ['Còn hàng', 'Sắp hết', 'Hết hàng'],
        data: [65, 20, 15],
        colors: ['#59a96a', '#f28e2b', '#e15759']
    },
    categoryPerformance: {
        labels: ['Điện tử', 'Thời trang', 'Gia dụng', 'Thể thao', 'Phụ kiện'],
        sales: [41200000, 24500000, 15600000, 18700000, 9800000],
        profit: [12360000, 7350000, 4680000, 5610000, 2940000],
        profitMargin: [30, 30, 30, 30, 30]
    }
};

// Khởi tạo biểu đồ phân bố danh mục
const categoryDistCtx = document.getElementById('categoryDistributionChart').getContext('2d');
const categoryDistChart = new Chart(categoryDistCtx, {
    type: 'doughnut',
    data: {
        labels: productData.categoryDistribution.labels,
        datasets: [{
            data: productData.categoryDistribution.data,
            backgroundColor: productData.categoryDistribution.colors,
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'right',
                labels: {
                    boxWidth: 12,
                    padding: 20
                }
            },
            tooltip: {
                callbacks: {
                    label: function (context) {
                        return context.label + ': ' + context.raw + '%';
                    }
                }
            }
        },
        cutout: '70%'
    }
});

// Khởi tạo biểu đồ tồn kho
const inventoryCtx = document.getElementById('inventoryChart').getContext('2d');
const inventoryChart = new Chart(inventoryCtx, {
    type: 'pie',
    data: {
        labels: productData.inventory.labels,
        datasets: [{
            data: productData.inventory.data,
            backgroundColor: productData.inventory.colors,
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'right',
                labels: {
                    boxWidth: 12,
                    padding: 20
                }
            },
            tooltip: {
                callbacks: {
                    label: function (context) {
                        return context.label + ': ' + context.raw + '%';
                    }
                }
            }
        }
    }
});

// Khởi tạo biểu đồ hiệu suất danh mục
const categoryPerfCtx = document.getElementById('categoryPerformanceChart').getContext('2d');
const categoryPerfChart = new Chart(categoryPerfCtx, {
    type: 'bar',
    data: {
        labels: productData.categoryPerformance.labels,
        datasets: [
            {
                label: 'Doanh số',
                data: productData.categoryPerformance.sales,
                backgroundColor: 'rgba(74, 111, 165, 0.7)',
                borderColor: '#4a6fa5',
                borderWidth: 1,
                yAxisID: 'y'
            },
            {
                label: 'Lợi nhuận',
                data: productData.categoryPerformance.profit,
                backgroundColor: 'rgba(89, 169, 106, 0.7)',
                borderColor: '#59a96a',
                borderWidth: 1,
                yAxisID: 'y'
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            tooltip: {
                callbacks: {
                    label: function (context) {
                        let label = context.dataset.label || '';
                        if (label) {
                            label += ': ';
                        }
                        label += context.raw.toLocaleString('vi-VN') + 'đ';
                        return label;
                    }
                }
            },
            legend: {
                position: 'top',
            }
        },
        scales: {
            y: {
                type: 'linear',
                display: true,
                position: 'left',
                ticks: {
                    callback: function (value) {
                        return (value / 1000000).toLocaleString('vi-VN') + 'tr';
                    }
                }
            }
        }
    }
});

// Xử lý chuyển đổi loại biểu đồ
// document.querySelectorAll('.btn-chart-type').forEach(btn => {
//     btn.addEventListener('click', function () {
//         document.querySelectorAll('.btn-chart-type').forEach(b => b.classList.remove('active'));
//         this.classList.add('active');

//         const chartType = this.getAttribute('data-type');
//         salesTrendChart.config.type = chartType;
//         salesTrendChart.update();
//     });
// });

// Xử lý thay đổi khoảng thời gian
// document.getElementById('time-period').addEventListener('change', function () {
//     // Trong thực tế, bạn sẽ gọi API để lấy dữ liệu mới dựa trên khoảng thời gian
//     console.log('Đã chọn khoảng thời gian:', this.value);
//     // Cập nhật dữ liệu biểu đồ ở đây
// });