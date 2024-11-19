<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/layout/MainLayout.php';
require_once __DIR__ . '/../../database/db_connection.php';
$db = new DB_Connection();

$data = [];
$orderSummary = [];
$subTotal = 0;

// Kiểm tra nếu là yêu cầu "Buy Now" (một sản phẩm duy nhất)
if (isset($_GET['product_id']) && isset($_GET['quantity']) && !is_array($_GET['product_id']) && !is_array($_GET['quantity'])) {
    $productId = (int)$_GET['product_id'];
    $quantity = (int)$_GET['quantity'];

    // Truy vấn sản phẩm từ cơ sở dữ liệu
    $productQuery = "SELECT name, price, thumbnail_url FROM products WHERE id = :product_id";
    $product = $db->get_one($productQuery, ['product_id' => $productId]);

    if ($product) {
        // Truy vấn giảm giá từ bảng `discounts`
        $discountQuery = "SELECT discount_percentage FROM discounts WHERE product_id = :product_id";
        $discountData = $db->get_one($discountQuery, ['product_id' => $productId]);
        $discountPercentage = $discountData['discount_percentage'] ?? 0;

        // Tính giá sau khi áp dụng giảm giá
        $discountedPrice = $product['price'] * (1 - $discountPercentage / 100);
        $totalPrice = $discountedPrice * $quantity;
        $subTotal += $totalPrice;

        // Thêm sản phẩm vào danh sách tóm tắt đơn hàng
        $orderSummary[] = [
            'product_id' => $productId,
            'name' => $product['name'],
            'thumbnail_url' => $product['thumbnail_url'],
            'quantity' => $quantity,
            'price' => $product['price'],
            'discounted_price' => $discountedPrice,
            'total_price' => $totalPrice
        ];
    }
} elseif (isset($_GET['product_id']) && isset($_GET['quantity']) && is_array($_GET['product_id']) && is_array($_GET['quantity'])) {
    $productIds = $_GET['product_id'];
    $quantities = $_GET['quantity'];

    // Lặp qua các sản phẩm trong giỏ hàng
    for ($i = 0; $i < count($productIds); $i++) {
        $productId = (int)$productIds[$i];
        $quantity = (int)$quantities[$i];

        // Truy vấn sản phẩm từ cơ sở dữ liệu
        $productQuery = "SELECT name, price, thumbnail_url FROM products WHERE id = :product_id";
        $product = $db->get_one($productQuery, ['product_id' => $productId]);

        if ($product) {
            // Truy vấn giảm giá từ bảng `discounts`
            $discountQuery = "SELECT discount_percentage FROM discounts WHERE product_id = :product_id";
            $discountData = $db->get_one($discountQuery, ['product_id' => $productId]);
            $discountPercentage = $discountData['discount_percentage'] ?? 0;

            // Tính giá sau khi áp dụng giảm giá
            $discountedPrice = $product['price'] * (1 - $discountPercentage / 100);
            $totalPrice = $discountedPrice * $quantity;
            $subTotal += $totalPrice;

            // Thêm sản phẩm vào danh sách tóm tắt đơn hàng
            $orderSummary[] = [
                'product_id' => $productId,
                'name' => $product['name'],
                'thumbnail_url' => $product['thumbnail_url'],
                'quantity' => $quantity,
                'price' => $product['price'],
                'discounted_price' => $discountedPrice,
                'total_price' => $totalPrice
            ];
        }
    }
} else {
    echo "<p>Dữ liệu giỏ hàng không hợp lệ</p>";
    exit;
}

$shipping = 0;
$subTotal = 0;
$totalDiscount = 0;
$tax = 2999;

foreach ($orderSummary as $item) {
    $subTotal += $item['total_price'];
    $totalDiscount += ($item['price'] - $item['discounted_price']) * $item['quantity'];
}

// Tổng giá trị thanh toán
$total = $subTotal + $tax + $shipping;

// Trả về dữ liệu cho giao diện
$data = [
    'orderSummary' => $orderSummary,
    'subTotal' => $subTotal,
    'shipping' => $shipping,
    'discountTotal' => $totalDiscount,
    'tax' => $tax,
    'total' => $total,
    'pageTitle' => 'Checkout'
];

// Gọi giao diện chính
renderMainLayout(__DIR__ . '/components/checkout_content.php', $data);
