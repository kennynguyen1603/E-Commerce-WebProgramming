<?php
// Bắt đầu session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Lấy thông tin từ session
$billingInfo = isset($_SESSION['billing_info']) ? $_SESSION['billing_info'] : [];
$orderSummary = isset($_SESSION['order_summary']) ? json_decode($_SESSION['order_summary'], true) : [];

// Đảm bảo $orderSummary là mảng
if (!is_array($orderSummary)) {
    $orderSummary = [];
}
$totalPrice = 0;
foreach ($orderSummary as $item) {
    $totalPrice += $item['total_price'];
}
$discount = 0; 
if (isset($_SESSION['discount'])) {
    $discount = $_SESSION['discount']; 
}

$taxRate = 0.10; // Thuế 10%
$tax = ($totalPrice - $discount) * $taxRate;

$total = $totalPrice - $discount + $tax;
date_default_timezone_set('Asia/Ho_Chi_Minh'); 
$orderNumber = 'ORD' . strtoupper(uniqid());
?>

<div class="order-details">
    <header>
        <h2>-Order Details-</h2>
        <?php echo '<button onclick="window.location.href=\'/e-commerce/app/views/home.php\'">Home</button>'; ?>
    </header>
    <div class="order-header">
        <h3>Order Number: <?php echo $orderNumber; ?></h3>
        <h3><?php echo count($orderSummary); ?> Products - Order Placed on <?php echo date('d M, Y \a\t H:i A'); ?>~</h3>
        <h3 class="order-total"> Total: $<?php echo number_format($total, 2); ?></h3> <!-- Hiển thị tổng giá -->
    </div>

    <!-- <div class="billing-info">
        <h4>Billing Information</h4>
        <?php
            // Kiểm tra xem thông tin thanh toán có tồn tại trong session không
            if (isset($_SESSION['billing_info'])) {
                $billing_info = $_SESSION['billing_info'];
                // Hiển thị thông tin thanh toán
                $fullName = htmlspecialchars($billing_info['first_name']) . ' ' . htmlspecialchars($billing_info['last_name']);
                $address = htmlspecialchars($billing_info['address']);
                $email = htmlspecialchars($billing_info['email']);
                
                echo "<p><strong>Name:</strong> " . $fullName . "</p>";
                echo "<p><strong>Address:</strong> " . $address . "</p>";
                echo "<p><strong>Email:</strong> " . $email . "</p>";
            } else {
                echo "<p>No billing information found.</p>";
            }
        ?>

    </div> -->
    
    <div class="order-timeline">
        <div class="timeline-step active">Order Placed</div>
        <div class="timeline-step ">Packaging</div>
        <div class="timeline-step ">Shipping</div>
        <div class="timeline-step">Delivered</div>
    </div>



    <!-- Hiển thị chi tiết sản phẩm -->
    <section class="product-details">
        <h4>Product (<?php echo count($orderSummary); ?>)</h4>
        <table>
            <thead>
                <tr>
                    <th>Products</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderSummary as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td>$<?php echo htmlspecialchars($item['discounted_price']); ?></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td>$<?php echo htmlspecialchars($item['total_price']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>
