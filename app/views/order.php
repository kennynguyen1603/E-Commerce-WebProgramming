<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/layout/MainLayout.php';
require_once __DIR__ . '/../../database/db_connection.php';
// Khởi tạo kết nối và đối tượng
$db = new DB_Connection();
$link = $db->connect();

$data = [
    'pageTitle' => 'Order',
];

renderMainLayout(__DIR__ . '/components/order_detail_content.php', $data);
?>