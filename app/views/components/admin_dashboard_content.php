<?php
require_once __DIR__ . '/../../server/admin_dashboard_handler.php';
$orders = $_SESSION['latest_orders'] ?? [];
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
    <header class="dashboard-header">
      <h1>Dashboard</h1>
      <p>28 Jan, 2021 - 28 Dec, 2021</p>
    </header>
    <div class="dashboard">
  <!-- Metrics Row -->
  <section class="dashboard-metrics">
    <div class="metric-box">
      <h3>Today's Sales</h3>
      <p>₹100,999</p>
    </div>
    <div class="metric-box">
      <h3>Today's Revenue</h3>
      <p>₹30,000</p>
    </div>
    <div class="metric-box">
      <h3>Users Count</h3>
      <p>20,390</p>
    </div>
  </section>

  <!-- Row for Total Revenue and Most Sold Items -->
  <section class="dashboard-row">
    <!-- Total Revenue -->
    <div class="total-revenue">
      <h3>Total Revenue</h3>
      <p>₹50,23780 <span class="growth">↑ 5% than last month</span></p>
      <div id="revenue-chart"></div>
    </div>

    <!-- Most Sold Items -->
    <div class="most-sold-items">
      <h3>Most Sold Items</h3>
      <ul>
        <li>
          <span>iPhone</span>
          <div class="progress-bar">
            <div class="progress" style="width: 70%;"></div>
          </div>
          <span>70%</span>
        </li>
        <li>
          <span>iMac</span>
          <div class="progress-bar">
            <div class="progress" style="width: 40%;"></div>
          </div>
          <span>40%</span>
        </li>
        <li>
          <span>MacBook</span>
          <div class="progress-bar">
            <div class="progress" style="width: 60%;"></div>
          </div>
          <span>60%</span>
        </li>
        <li>
          <span>Apple Watch</span>
          <div class="progress-bar">
            <div class="progress" style="width: 80%;"></div>
          </div>
          <span>80%</span>
        </li>
        <li>
          <span>AirPods</span>
          <div class="progress-bar">
            <div class="progress" style="width: 20%;"></div>
          </div>
          <span>20%</span>
        </li>
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
              <tr>
                <td><?= htmlspecialchars($order['order_id']) ?></td>
                <td><?= htmlspecialchars($order['address']) ?></td>
                <td><?= htmlspecialchars($order['country']) ?></td>
                <td><?= htmlspecialchars($order['region']) ?></td>
                <td><?= htmlspecialchars($order['email']) ?></td>
                <td><?= htmlspecialchars($order['phone']) ?></td>
                <td>
                  <div class="action-buttons">
                    <!-- View Button -->
                    <button class="view-btn" data-order-id="<?= htmlspecialchars($order['order_id']) ?>">
                      <i class="fa fa-eye" aria-hidden="true"></i> View
                    </button>
                    <!-- Edit Button -->
                    <button class="edit-btn" data-order-id="<?= htmlspecialchars($order['order_id']) ?>">
                      <i class="fa fa-edit" aria-hidden="true"></i> Edit
                    </button>
                    <!-- Delete Button -->
                    <button class="delete-btn" data-order-id="<?= htmlspecialchars($order['order_id']) ?>">
                      <i class="fa fa-trash" aria-hidden="true"></i> Delete
                    </button>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <tr>
              <td colspan="7" class="text-center">No orders found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </section>
  </main>
</div>

<script>
// Function to view an order
function viewOrder(orderId) {
    console.log("Fetching order details for Order ID:", orderId);

    fetch(`/e-commerce/app/views/components/editions/order_details.php?id=${orderId}`)
        .then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then((data) => {
            console.log("API Response:", data);
            if (data.success) {
                displayOrderDetails(data.order);
            } else {
                alert("Failed to fetch order details: " + data.error);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("An error occurred while fetching order details.");
        });
}

// Function to display order details
function displayOrderDetails(order) {
    const modal = document.getElementById("order-details-modal");
    const modalContent = document.getElementById("modal-content");

    modalContent.innerHTML = `
        <h2>Order Details</h2>
        <p><strong>Order ID:</strong> ${order.id}</p>
        <p><strong>Order Date:</strong> ${order.order_date}</p>
        <p><strong>Status:</strong> ${order.status}</p>
        <p><strong>Total:</strong> ₹${order.total}</p>
        <h3>Customer Information</h3>
        <p><strong>Customer ID:</strong> ${order.customer_id}</p>
        <button onclick="closeModal()">Close</button>
    `;

    modal.style.display = "block";
}

// Function to close the modal
function closeModal() {
    const modal = document.getElementById("order-details-modal");
    modal.style.display = "none";
}

// Function to edit an order
function editOrder(orderId) {
    window.location.href = `/e-commerce/app/views/components/editions/edit_order.php?id=${orderId}`;
}

// Function to delete an order
function deleteOrder(orderId) {
    if (confirm("Are you sure you want to delete this order?")) {
        fetch(`/e-commerce/app/actions/delete_order.php`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ order_id: orderId }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    alert("Order deleted successfully.");
                    window.location.reload();
                } else {
                    alert("Failed to delete order: " + data.error);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("An error occurred while deleting the order.");
            });
    }
}

// Attach event listeners dynamically
function attachEventListeners() {
    document.querySelectorAll(".view-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
            const orderId = this.getAttribute("data-order-id");
            viewOrder(orderId);
        });
    });

    document.querySelectorAll(".edit-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
            const orderId = this.getAttribute("data-order-id");
            editOrder(orderId);
        });
    });

    document.querySelectorAll(".delete-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
            const orderId = this.getAttribute("data-order-id");
            deleteOrder(orderId);
        });
    });
}

// Attach event listeners after DOM content is loaded
document.addEventListener("DOMContentLoaded", () => {
    attachEventListeners();
});

</script>