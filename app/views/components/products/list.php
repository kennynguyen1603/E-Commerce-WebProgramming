<?php
require_once __DIR__ . '/../../../../database/db_connection.php';
$db = new DB_Connection();

// Lấy tất cả sản phẩm nếu không có bộ lọc
if (empty($_GET)) {
    $query = "SELECT * FROM products";
    $products = $db->get($query);
}

foreach ($products as $product) {
    include __DIR__ . '/product_item.php';
}
