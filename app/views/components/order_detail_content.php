<?php
// Bắt đầu session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    // Chuyển hướng đến trang đăng nhập
    header('Location: /login.php');
    exit(); // Ngừng thực thi phần còn lại của script
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
    </div>
            
    <div class="order-timeline">
        <div class="timeline-step completed">
            <div class="timeline-circle">1</div>
            <div class="timeline-label">Order Placed</div>
        </div>
        <div class="timeline-step completed">
            <div class="timeline-circle">2</div>
            <div class="timeline-label">Packaging</div>
        </div>
        <div class="timeline-step active">
            <div class="timeline-circle">3</div>
            <div class="timeline-label">Shipping</div>
        </div>
        <div class="timeline-step">
            <div class="timeline-circle">4</div>
            <div class="timeline-label">Delivered</div>
        </div>
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
                </br>

    <div class="order-header">
        <h3 class="order-total" > Total: $<?php echo number_format($total, 2); ?></h3> <!-- Hiển thị tổng giá -->
    </div>
</div>
