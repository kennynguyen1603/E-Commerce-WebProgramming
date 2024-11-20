<?php
require_once __DIR__ . '/../../server/admin_dashboard_handler.php';
$orders = $_SESSION['latest_orders'] ?? [];
$mostSoldItems = $_SESSION['most_sold_items'] ?? [];
$totalRevenue = $_SESSION['total_revenue'] ?? 0; // Default to 0 if not set
$growthPercentage = 5; // Placeholder for growth calculation (hardcoded for now)
?>
<div class="admindashboard-container">
  <!-- Sidebar -->
  <aside class="sidebar">
    <ul>
      <li><a href="/e-commerce/app/views/admin_dashboard.php">
        <i class="fa fa-slack" aria-hidden="true"></i> Dashboard</a></li>
      <li><a href="/e-commerce/app/views/profile.php">
        <i class="fa fa-user-circle" aria-hidden="true"></i> Account Details</a></li>
      <li><a href="#"><i class="fa fa-history" aria-hidden="true"></i> Order History</a></li>
      <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> Track Order</a></li>
      <li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping Cart</a></li>
    </ul>
  </aside>

  <!-- Main Dashboard -->
  <main class="dashboard">
    <div class="dashboard">
  <!-- Metrics Row -->
  <div class="dashboard-metrics">
    <div class="metric-box">
        <h3>Month's Sales</h3>
        <p>₹<?= number_format($_SESSION['month_sales'] ?? 0) ?></p>
    </div>
    <div class="metric-box">
        <h3>Month's Revenue</h3>
        <p>₹<?= number_format($_SESSION['month_revenue'] ?? 0, 2) ?></p>
    </div>
    <div class="metric-box">
        <h3>Users Count</h3>
        <p><?= number_format($_SESSION['all_users'] ?? 0) ?></p>
    </div>
</div>


  <!-- Row for Total Revenue and Most Sold Items -->
  <section class="dashboard-row">
    <!-- Total Revenue -->
    <div class="total-revenue">
    <h3>Total Revenue</h3>
    <p>₹<?= number_format($totalRevenue, 2) ?> 
    <span class="growth">
            <?= ($_SESSION['growth_percentage'] >= 0 ? '↑' : '↓') . abs($_SESSION['growth_percentage']) ?>% than last month
        </span>
    </p>
    <canvas id="revenue-chart-canvas" width="400" height="200"></canvas>
    <div class="chart-legend">
        <span><span style="background-color: #4caf50; display: inline-block; width: 12px; height: 12px; border-radius: 2px; margin-right: 4px;"></span> Profit</span>
        <span><span style="background-color: #ccc; display: inline-block; width: 12px; height: 12px; border-radius: 2px; margin-right: 4px;"></span> Loss</span>
    </div>
</div>

    <!-- Most Sold Items -->
    <div class="most-sold-items">
    <h3>Most Sold Items</h3>
    <ul>
        <?php if (!empty($mostSoldItems)) : ?>
            <?php foreach ($mostSoldItems as $item) : ?>
                <li>
                    <span><?= htmlspecialchars($item['name']) ?></span>
                    <div class="progress-bar">
                        <div 
                            class="progress" 
                            style="width: <?= htmlspecialchars($item['percentage']) ?>%;"
                        ></div>
                    </div>
                    <span><?= htmlspecialchars($item['percentage']) ?>%</span>
                </li>
            <?php endforeach; ?>
        <?php else : ?>
            <li>No best-selling products found.</li>
        <?php endif; ?>
    </ul>
</div>
  </section>
</div>
<section class="latest-orders">
      <h2>Latest Orders</h2>
      <table>
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Address</th>
            <th>Country</th>
            <th>Region</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($orders)) : ?>
            <?php foreach ($orders as $order) : ?>
              <tr id="order-row-<?= htmlspecialchars($order['order_id']) ?>">
                <td><?= htmlspecialchars($order['order_id']) ?></td>
                <td><?= htmlspecialchars($order['address']) ?></td>
                <td><?= htmlspecialchars($order['country']) ?></td>
                <td><?= htmlspecialchars($order['region']) ?></td>
                <td><?= htmlspecialchars($order['email']) ?></td>
                <td><?= htmlspecialchars($order['phone']) ?></td>
                <td>
                  <div class="action-buttons">
                    <button class="view-btn" data-order-id="<?= htmlspecialchars($order['order_id']) ?>">View</button>
                    <button class="edit-btn" data-order-id="<?= htmlspecialchars($order['order_id']) ?>">Edit</button>
                    <button class="delete-btn" data-order-id="<?= htmlspecialchars($order['order_id']) ?>">Delete</button>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <tr><td colspan="7" class="text-center">No orders found.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </section>
  </main>
</div>
<!-- Modal -->
<div id="order-modal" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); z-index: 1000;">
  <div id="modal-content">
    <h2>Order Details</h2>
    <div id="order-details"></div>
    <button onclick="closeModal()" style="margin-top: 10px; background: #f44336; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px;">Close</button>
  </div>
</div>
<!-- Unified Modal -->
<div id="order-modal" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); z-index: 1000; max-width: 400px; width: 100%;">
  <div id="modal-content">
    <h2 id="modal-title">Edit Details</h2>
    <div id="modal-body"></div>
    <div class="modal-footer">
      <button id="modal-cancel-btn" onclick="closeModal()" style="background: #f44336; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Cancel</button>
      <button id="modal-save-btn" style="display: none; background: #4caf50; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Save Changes</button>
    </div>
  </div>
</div>

<!-- Modal Background -->
<div id="modal-bg" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 999;" onclick="closeModal()"></div>


<script>
 // View Order
function viewOrder(orderId) {
    fetch(`/e-commerce/app/server/admin_dashboard_handler.php?action=view&order_id=${orderId}`)
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                const details = data.order;
                const detailsContainer = document.getElementById("order-details");
                detailsContainer.innerHTML = `
                    <p><strong>Order ID:</strong> ${details.order_id}</p>
                    <p><strong>Address:</strong> ${details.address}</p>
                    <p><strong>Country:</strong> ${details.country}</p>
                    <p><strong>Region:</strong> ${details.region}</p>
                    <p><strong>Email:</strong> ${details.email}</p>
                    <p><strong>Phone:</strong> ${details.phone}</p>
                `;
                document.getElementById("order-modal").style.display = "block";
            } else {
                alert("Failed to fetch order details: " + data.error);
            }
        })
        .catch((error) => alert("An error occurred: " + error));
}
function openModal(title, body, showSaveButton = false) {
    document.getElementById('modal-title').innerText = title; // Đặt tiêu đề modal
    document.getElementById('modal-body').innerHTML = body;  // Đặt nội dung modal
    const saveButton = document.getElementById('modal-save-btn'); // Lấy nút Save
    saveButton.style.display = showSaveButton ? 'inline-block' : 'none'; // Hiển thị hoặc ẩn nút Save Changes
    document.getElementById('order-modal').style.display = 'block'; // Hiển thị modal
    document.getElementById('modal-bg').style.display = 'block'; // Hiển thị nền mờ
}


// Delete Order
function deleteOrder(orderId) {
    if (confirm("Are you sure you want to delete this order?")) {
        fetch(`/e-commerce/app/server/admin_dashboard_handler.php?action=delete`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ order_id: orderId }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    alert("Order deleted successfully.");
                    document.getElementById(`order-row-${orderId}`).remove();
                } else {
                    alert("Failed to delete order: " + data.error);
                }
            })
            .catch((error) => alert("An error occurred: " + error));
    }
}
    // Handle Edit button click
    document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function () {
        const orderId = this.dataset.orderId;

        fetch(`/e-commerce/app/server/admin_dashboard_handler.php?action=view&order_id=${orderId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const order = data.order;

                    // Tạo form chỉnh sửa
                    const form = `
                        <form id="edit-order-form">
                            <div>
                                <label for="edit-address">Address:</label>
                                <input type="text" id="edit-address" value="${order.address}" required />
                            </div>
                            <div>
                                <label for="edit-country">Country:</label>
                                <input type="text" id="edit-country" value="${order.country}" required />
                            </div>
                            <div>
                                <label for="edit-region">Region:</label>
                                <input type="text" id="edit-region" value="${order.region}" required />
                            </div>
                            <div>
                                <label for="edit-email">Email:</label>
                                <input type="email" id="edit-email" value="${order.email}" required />
                            </div>
                            <div>
                                <label for="edit-phone">Phone:</label>
                                <input type="text" id="edit-phone" value="${order.phone}" required />
                            </div>
                        </form>
                    `;

                    openModal('Edit Order', form, true); // Gọi modal với nội dung form chỉnh sửa

                    // Gán sự kiện lưu
                    const saveButton = document.getElementById('modal-save-btn');
                    saveButton.onclick = function () {
                        saveOrder(orderId);
                    };
                } else {
                    alert('Error fetching order details: ' + data.error);
                }
            })
            .catch(error => console.error('Error fetching order details:', error));
    });
});




document.addEventListener('DOMContentLoaded', function () {
    // View Order
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function () {
            const orderId = this.dataset.orderId;

            // Fetch order details
            fetch(`/e-commerce/app/server/admin_dashboard_handler.php?action=view&order_id=${orderId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const detailsContainer = document.getElementById('order-details');
                        const modal = document.getElementById('order-modal');
                        const modalBg = document.getElementById('modal-bg');

                        // Populate order details
                        detailsContainer.innerHTML = `
                            <p><strong>Order ID:</strong> ${data.order.order_id}</p>
                            <p><strong>Address:</strong> ${data.order.address}</p>
                            <p><strong>Country:</strong> ${data.order.country}</p>
                            <p><strong>Region:</strong> ${data.order.region}</p>
                            <p><strong>Email:</strong> ${data.order.email}</p>
                            <p><strong>Phone:</strong> ${data.order.phone}</p>
                        `;

                        // Show modal and background
                        modal.style.display = 'block';
                        modalBg.style.display = 'block';
                    } else {
                        alert('Error fetching order details: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Fetch Error:', error);
                    alert('An error occurred while fetching order details.');
                });
        });
    });

    // Close the modal
    window.closeModal = function () {
        document.getElementById('order-modal').style.display = 'none';
        document.getElementById('modal-bg').style.display = 'none';
    };
    
    //delete 
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const orderId = this.dataset.orderId;
            if (confirm("Are you sure?")) {
                fetch(`/e-commerce/app/server/admin_dashboard_handler.php?action=delete`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ order_id: orderId }),
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(`order-row-${orderId}`).remove();
                        } else {
                            alert("Error: " + data.error);
                        }
                    });
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
    // Đảm bảo tất cả các nút được gán sự kiện
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const orderId = this.dataset.orderId;

            // Debug: Xác nhận sự kiện click
            console.log('Edit button clicked for order ID:', orderId);

            fetch(`/e-commerce/app/server/admin_dashboard_handler.php?action=view&order_id=${orderId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Order data:', data.order); // Debug: Xác nhận dữ liệu nhận được
                        const order = data.order;

                        // Tạo form để chỉnh sửa
                        const form = `
                            <form id="edit-order-form">
                                <div>
                                    <label for="edit-address">Address:</label>
                                    <input type="text" id="edit-address" value="${data.order.address}" required />
                                </div>
                                <div>
                                    <label for="edit-country">Country:</label>
                                    <input type="text" id="edit-country" value="${data.order.country}" required />
                                </div>
                                <div>
                                    <label for="edit-region">Region:</label>
                                    <input type="text" id="edit-region" value="${data.order.region}" required />
                                </div>
                                <div>
                                    <label for="edit-email">Email:</label>
                                    <input type="email" id="edit-email" value="${data.order.email}" required />
                                </div>
                                <div>
                                    <label for="edit-phone">Phone:</label>
                                    <input type="text" id="edit-phone" value="${data.order.phone}" required />
                                </div>
                            </form>
                        `;

                        openModal('Edit Order', form, true);

                        // Gán sự kiện Save cho nút Save Changes
                        document.getElementById('modal-save-btn').onclick = function () {
                            saveOrder(orderId);
                        };
                    } else {
                        alert('Error fetching order details: ' + data.error);
                    }
                })
                .catch(error => console.error('Error fetching order details:', error));
        });
    });
});


// Save Edited Order
function saveOrder(orderId) {
    const updatedData = {
        address: document.getElementById('edit-address').value,
        country: document.getElementById('edit-country').value,
        region: document.getElementById('edit-region').value,
        email: document.getElementById('edit-email').value,
        phone: document.getElementById('edit-phone').value,
    };

    fetch(`/e-commerce/app/server/admin_dashboard_handler.php?action=edit`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ order_id: orderId, ...updatedData }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Order updated successfully!');
                closeModal();

                // Update the order row in the table
                const row = document.getElementById(`order-row-${orderId}`);
                row.querySelector('td:nth-child(2)').innerText = updatedData.address;
                row.querySelector('td:nth-child(3)').innerText = updatedData.country;
                row.querySelector('td:nth-child(4)').innerText = updatedData.region;
                row.querySelector('td:nth-child(5)').innerText = updatedData.email;
                row.querySelector('td:nth-child(6)').innerText = updatedData.phone;
            } else {
                alert('Failed to update order: ' + data.error);
            }
        })
        .catch(error => console.error('Error updating order:', error));
}

});

</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('revenue-chart-canvas').getContext('2d');

    // Data from the backend (via PHP session)
    const monthlyRevenue = <?= json_encode($_SESSION['monthly_revenue'] ?? []) ?>;

    // Process data for the chart
    const labels = monthlyRevenue.map(item => `Month ${item.month}`);
    const completedRevenue = monthlyRevenue.map(item => item.completed_revenue);
    const pendingRevenue = monthlyRevenue.map(item => item.pending_revenue);

    // Chart configuration
    const config = {
        type: 'bar', // Bar chart
        data: {
            labels: labels, // X-axis labels (months)
            datasets: [
                {
                    label: 'Completed Revenue',
                    data: completedRevenue, // Completed revenue data
                    backgroundColor: 'rgba(75, 192, 192, 0.7)', // Green for completed
                },
                {
                    label: 'Pending Revenue',
                    data: pendingRevenue, // Pending revenue data
                    backgroundColor: 'rgba(255, 99, 132, 0.7)', // Red for pending
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Revenue (₹)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                }
            }
        }
    };

    // Render the chart
    new Chart(ctx, config);
});
</script>   
