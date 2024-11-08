<?php
require_once __DIR__ . '/../../../../database/db_connection.php';
$db = new DB_Connection();

// Lấy tất cả sản phẩm nếu không có bộ lọc
if (empty($_GET)) {
    $query = "SELECT * FROM products";
    $products = $db->get($query);
}

foreach ($products as $product) {
    echo "<div class='product-item'>";
    echo "<img src='{$product['thumbnail_url']}' alt='{$product['name']}'>";
    echo "<h4 class='product-name'>{$product['name']}</h4>";
    echo "<p class='product-price'>{$product['price']}</p>";
    echo "<button class='btn btn-primary'>Mua Ngay</button>";
    echo "</div>";
}
