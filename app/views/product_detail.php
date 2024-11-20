<?php
require_once __DIR__ . '/layout/MainLayout.php';
require_once __DIR__ . '/../../database/db_connection.php';
$db = new DB_Connection();

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id > 0) {
    // Lấy thông tin sản phẩm
    $query = "SELECT * FROM products WHERE id = $product_id";
    $product = $db->get($query);

    if (!empty($product)) {
        $product = $product[0];
    } else {
        echo "Product not found.";
        exit;
    }

    // Lấy các ảnh của sản phẩm
    $query = "SELECT * FROM product_images WHERE product_id = $product_id";
    $images = $db->get($query);

    // Lấy giảm giá của sản phẩm
    $query = "SELECT discount_percentage FROM discounts WHERE product_id = $product_id";
    $discount = $db->get($query);
    $discount = !empty($discount) ? $discount[0]['discount_percentage'] : 0;

    // Lấy số lượng sản phẩm trong kho
    $query = "SELECT quantity FROM stocks WHERE product_id = $product_id";
    $stock = $db->get($query);
    $stock = !empty($stock) ? $stock[0]['quantity'] : 0;

    // // Lấy đánh giá của sản phẩm
    // $query = "SELECT * FROM reviews WHERE product_id = $product_id";
    // $reviews = $db->get($query);
} else {
    echo "Invalid product ID.";
    exit;
}

$data = [
    'pageTitle' => $product['name'] . ' - Product Detail',
    'productDetails' => [
        'id' => $product['id'],
        'name' => $product['name'],
        'price' => $product['price'],
        'images' => $images,
        'discount' => $discount,
        'stock' => $stock,
        // 'reviews' => $reviews
    ]
];

renderMainLayout(__DIR__ . '/components/product_detail_content.php', $data);
