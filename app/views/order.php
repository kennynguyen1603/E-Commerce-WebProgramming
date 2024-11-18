<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/layout/MainLayout.php';
require_once __DIR__ . '/../../database/db_connection.php';
// Khởi tạo đối tượng DB_Connection
$db = new DB_Connection();
// Lấy kết nối từ DB_Connection
$link = $db->connect(); 
$data = [
    'pageTitle' => 'Order',
];


// Render layout
renderMainLayout(__DIR__ . '/components/order_detail_content.php', $data);
