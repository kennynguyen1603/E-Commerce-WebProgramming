<?php
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../../database/db_connection.php';
$db = new DB_Connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'] ?? null;

    if ($product_id && isset($_SESSION['user_id'])) {
        $customer_id = $_SESSION['user_id'];

        try {
            // Xóa sản phẩm khỏi `cart_items`
            $deleteItemQuery = "DELETE FROM cart_items WHERE product_id = :product_id AND cart_id IN (
                                    SELECT id FROM cart WHERE customer_id = :customer_id
                                )";
            $db->query($deleteItemQuery, [
                'product_id' => $product_id,
                'customer_id' => $customer_id
            ]);

            echo json_encode(['success' => true, 'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Lỗi khi xóa sản phẩm khỏi giỏ hàng: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Dữ liệu không hợp lệ hoặc chưa đăng nhập.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Phương thức yêu cầu không hợp lệ.']);
}
