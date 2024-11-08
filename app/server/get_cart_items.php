<?php
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../../database/db_connection.php';
$db = new DB_Connection();

if (isset($_SESSION['user_id'])) {
    $customer_id = $_SESSION['user_id'];

    try {
        // Lấy tất cả sản phẩm trong giỏ hàng của người dùng
        $query = "SELECT product_id, quantity FROM cart_items WHERE cart_id = (
                      SELECT id FROM cart WHERE customer_id = :customer_id
                  )";
        $cartItems = $db->get($query, ['customer_id' => $customer_id]);

        echo json_encode(['success' => true, 'cart_items' => $cartItems]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Lỗi khi tải giỏ hàng: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Người dùng chưa đăng nhập.']);
}
