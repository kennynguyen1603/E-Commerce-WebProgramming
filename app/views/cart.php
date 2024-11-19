<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/layout/MainLayout.php';
require_once __DIR__ . '/../../database/db_connection.php';
$db = new DB_Connection();

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['user_id'])) {
  header("Location: /E-Commerce/app/views/login.php");
  exit();
}


$customer_id = $_SESSION['user_id'];
$data = [
  'pageTitle' => 'Cart',
];

$cartQuery = "SELECT 
                c.id AS cart_id,
                ci.product_id,
                p.name AS product_name,
                p.price AS original_price,
                COALESCE(d.discount_percentage, 0) AS discount_percentage,
                (p.price * (1 - COALESCE(d.discount_percentage, 0) / 100)) AS discounted_price,
                COALESCE(s.quantity, 0) AS stock_quantity,
                ci.quantity AS cart_quantity,
                (p.price * (1 - COALESCE(d.discount_percentage, 0) / 100) * ci.quantity) AS sub_total,
                pi.image_url AS main_image_url
              FROM 
                cart c
              JOIN 
                cart_items ci ON c.id = ci.cart_id
              JOIN 
                products p ON ci.product_id = p.id
              LEFT JOIN 
                discounts d ON p.id = d.product_id AND (d.start_date <= NOW() AND d.end_date >= NOW())
              LEFT JOIN 
                stocks s ON p.id = s.product_id
              LEFT JOIN 
                product_images pi ON p.id = pi.product_id AND pi.is_main = 1
              WHERE 
                c.customer_id = ?";

$cartItems = $db->get($cartQuery, [$customer_id]);

// Tính toán tổng phụ, giảm giá, thuế và tổng cộng
$subTotal = 0;
$discount = 999; // Giả sử giảm giá cố định

foreach ($cartItems as $item) {
  $subTotal += $item['sub_total'];
  $totalDiscount += ($item['original_price'] - $item['discounted_price']) * $item['cart_quantity'];
}

$tax = 2999; // Giả sử thuế cố định
$total = $subTotal - $discount + $tax;

// Chuyển dữ liệu sang view để hiển thị
$data = [
  'pageTitle' => 'Cart',
  'cartItems' => $cartItems,
  'subTotal' => $subTotal,
  'discount' => $totalDiscount,
  'tax' => $tax,
  'total' => $total
];

renderMainLayout(__DIR__ . '/components/cart_content.php', $data);
