<?php
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../../database/db_connection.php';
$db = new DB_Connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['customer_id'], $data['product_id'], $data['quantity'])) {
        $customer_id = $data['customer_id'];
        $product_id = $data['product_id'];
        $quantity = (int)$data['quantity'];

        // Kiểm tra sự tồn tại của khách hàng trong bảng `customers`
        $checkCustomerQuery = "SELECT id FROM customers WHERE id = ?";
        $customerExists = $db->get_one($checkCustomerQuery, [$customer_id]);

        if (!$customerExists) {
            echo json_encode(['success' => false, 'error' => 'Khách hàng không tồn tại. Vui lòng đăng nhập lại.']);
            exit();
        }

        try {
            // Kiểm tra hoặc tạo giỏ hàng cho khách hàng
            $query = "SELECT * FROM cart WHERE customer_id = ?";
            $cart = $db->get_one($query, [$customer_id]);

            // Tạo giỏ hàng nếu chưa tồn tại
            if (!$cart) {
                $createCartQuery = "INSERT INTO cart (customer_id) VALUES (:customer_id)";
                $db->query($createCartQuery, ['customer_id' => $customer_id]);
                // $cart_id = $db->connect()->lastInsertId(); 

                // Lấy ID của giỏ hàng vừa tạo
                $query = "SELECT id FROM cart WHERE customer_id = :customer_id ORDER BY created_at DESC LIMIT 1";
                $cart = $db->get_one($query, ['customer_id' => $customer_id]);

                if (!$cart) {
                    echo json_encode(['success' => false, 'error' => 'Không thể lấy ID của giỏ hàng vừa tạo.']);
                    exit();
                }
                $cart_id = $cart['id'];
            } else {
                $cart_id = $cart['id']; // Lấy ID của giỏ hàng hiện tại
            }

            // Thêm sản phẩm vào `cart_items` sau khi đảm bảo có `cart_id`
            $cartItemQuery = "SELECT * FROM cart_items WHERE cart_id = ? AND product_id = ?";
            $cartItem = $db->get_one($cartItemQuery, [$cart_id, $product_id]);

            if ($cartItem) {
                // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
                $newQuantity = $cartItem['quantity'] + $quantity;
                $updateCartItemQuery = "UPDATE cart_items SET quantity = :quantity WHERE id = :id";
                $db->query($updateCartItemQuery, ['quantity' => $newQuantity, 'id' => $cartItem['id']]);
            } else {
                // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới vào `cart_items`
                $addCartItemQuery = "INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (:cart_id, :product_id, :quantity)";
                $db->query($addCartItemQuery, [
                    'cart_id' => $cart_id,
                    'product_id' => $product_id,
                    'quantity' => $quantity
                ]);
            }

            // Phản hồi thành công
            echo json_encode(['success' => true, 'message' => 'Sản phẩm đã được thêm vào giỏ hàng.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Lỗi khi thêm vào giỏ hàng: ' . $e->getMessage()]);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Dữ liệu không hợp lệ.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Phương thức yêu cầu không hợp lệ.']);
}
