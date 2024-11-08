<?php
session_start();
require_once __DIR__ . '/../../database/db_connection.php';
$db = new DB_Connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_SESSION['user_id'] ?? null;
    $product_id = $_POST['product_id'] ?? null;
    $new_quantity = $_POST['quantity'] ?? null;

    if (!$customer_id) {
        echo json_encode(['success' => false, 'error' => 'User not logged in']);
        exit();
    }

    if (!$product_id || !is_numeric($new_quantity) || $new_quantity < 1) {
        echo json_encode(['success' => false, 'error' => 'Invalid product ID or quantity']);
        exit();
    }

    try {
        // Cập nhật số lượng sản phẩm trong giỏ hàng
        $query = "UPDATE cart_items ci
                  JOIN cart c ON ci.cart_id = c.id
                  SET ci.quantity = ?
                  WHERE c.customer_id = ? AND ci.product_id = ?";
        $db->query($query, [$new_quantity, $customer_id, $product_id]);

        echo json_encode(['success' => true, 'message' => 'Quantity updated successfully']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Failed to update quantity']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
