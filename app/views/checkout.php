<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/layout/MainLayout.php';
require_once __DIR__ . '/../../database/db_connection.php';
$db = new DB_Connection();

// Dữ liệu mặc định
$data = [];
// Khởi tạo các biến cho order summary
$orderSummary = [];
$subTotal = 0;

// Kiểm tra xem yêu cầu là từ "Buy Now" hay từ giỏ hàng
if (isset($_GET['product_id']) && isset($_GET['quantity'])) {
    // Trường hợp "Buy Now" cho một sản phẩm cụ thể
    $productId = (int)$_GET['product_id'];
    $quantity = (int)$_GET['quantity'];

    // Truy vấn sản phẩm từ bảng `products`
    $productQuery = "SELECT name, price, thumbnail_url FROM products WHERE id = :product_id";
    $product = $db->get_one($productQuery, ['product_id' => $productId]);

    if ($product) {
        $discountQuery = "SELECT discount_percentage FROM discounts WHERE product_id = :product_id";
        $discountData = $db->get_one($discountQuery, ['product_id' => $productId]);
        $discountPercentage = $discountData['discount_percentage'] ?? 0;

        // Tính giá sau khi áp dụng giảm giá
        $discountedPrice = $product['price'] * (1 - $discountPercentage / 100);

        // Tính tổng giá cho mục này
        $totalPrice = $discountedPrice * $quantity;
        $subTotal += $totalPrice;

        // Thêm sản phẩm vào danh sách tóm tắt đơn hàng
        $orderSummary[] = [
            'name' => $product['name'],
            'thumbnail_url' => $product['thumbnail_url'],
            'quantity' => $quantity,
            'price' => $product['price'],
            'discounted_price' => $discountedPrice,
            'total_price' => $totalPrice
        ];
    } else {
        // Xử lý trường hợp sản phẩm không tồn tại  
        echo "Sản phẩm không tồn tại.";
        exit;
    }
}


// Tính tổng cộng
$shipping = 0;  // Miễn phí vận chuyển (ví dụ)
$discountTotal = 24;  // Số tiền giảm giá chung (có thể tính lại từ các sản phẩm nếu cần)
$tax = $subTotal * 0.18;  // Thuế 18% (ví dụ)
$total = $subTotal + $tax + $shipping - $discountTotal;

// Thêm các biến vào mảng dữ liệu để truyền vào layout
$data['product'] = $product ?? null;
$data['orderSummary'] = $orderSummary;
$data['subTotal'] = $subTotal;
$data['shipping'] = $shipping;
$data['discountTotal'] = $discountTotal;
$data['tax'] = $tax;
$data['total'] = $total;

$data['pageTitle'] = 'Checkout';
renderMainLayout(__DIR__ . '/components/checkout_content.php', $data);
