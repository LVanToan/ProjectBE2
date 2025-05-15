document.addEventListener('DOMContentLoaded', function () {
    const filterButton = document.querySelector('.filter-btn');

    filterButton.addEventListener('click', function () {
        const startDate = document.querySelector('#start-date').value;
        const endDate = document.querySelector('#end-date').value;

        if (startDate && endDate) {
            console.log(`Lọc từ ngày: ${startDate} đến ngày: ${endDate}`);

            // Gửi yêu cầu lọc đến server
            fetch('/admin/revenue/filter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ start_date: startDate, end_date: endDate }),
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Dữ liệu lọc:', data);

                    // Cập nhật giao diện với dữ liệu mới
                    updateRevenueSummary(data);
                    updateOrderTable(data.orders);
                })
                .catch(error => {
                    console.error('Lỗi khi lọc dữ liệu:', error);
                });
        } else {
            alert('Vui lòng chọn cả Từ ngày và Đến ngày.');
        }
    });

    // Hàm cập nhật phần tổng quan doanh thu
    function updateRevenueSummary(data) {
        document.querySelector('.total-revenue').textContent = `${data.totalRevenue.toLocaleString()} ₫`;
        document.querySelector('.total-orders').textContent = data.totalOrders;
        document.querySelector('.successful-orders').textContent = data.successfulOrders;
        document.querySelector('.canceled-orders').textContent = data.canceledOrders;
    }

    // Hàm cập nhật bảng đơn hàng
    function updateOrderTable(orders) {
        const tableBody = document.querySelector('table tbody');
        tableBody.innerHTML = ''; // Xóa nội dung cũ

        orders.forEach(order => {
            const row = `
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">#${order.id}</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">${order.first_name ?? 'N/A'}</p>
                        <p class="text-xs text-secondary mb-0">${order.last_name ?? 'N/A'}</p>
                    </td>
                    <td class="align-middle text-sm">
                        <span class="text-secondary text-xs font-weight-bold">${new Date(order.created_at).toLocaleDateString()}</span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">${order.phone ?? 0}</span>
                    </td>
                    <td class="align-middle text-sm">
                        <span class="text-success text-xs font-weight-bold">${Number(order.total).toLocaleString()} ₫</span>
                    </td>
                    <td class="align-middle">
                        <span class="text-secondary text-xs font-weight-bold">${order.payment_method ?? 'N/A'}</span>
                    </td>
                    <td class="align-middle">
                        ${getStatusBadge(order.status)}
                    </td>
                </tr>
            `;
            tableBody.insertAdjacentHTML('beforeend', row);
        });
    }

    // Hàm trả về badge trạng thái
    function getStatusBadge(status) {
        if (status === 'delivered') {
            return '<span class="badge badge-sm bg-gradient-success">Thành công</span>';
        } else if (status === 'processing') {
            return '<span class="badge badge-sm bg-gradient-warning">Đang xử lý</span>';
        } else if (status === 'canceled') {
            return '<span class="badge badge-sm bg-gradient-danger">Đã hủy</span>';
        } else {
            return '<span class="badge badge-sm bg-gradient-secondary">Không xác định</span>';
        }
    }
});