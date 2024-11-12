<?php
session_start();
require_once '../../database/db_connection.php';
$db = new DB_Connection();

$customer_id = $_SESSION['user_id'] ?? null;

$billing_info = [
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],
    'company_name' => $_POST['company_name'] ?? null,
    'address' => $_POST['address'],
    'country' => $_POST['country'],
    'region' => $_POST['region'],
    'city' => $_POST['city'],
    'zip_code' => $_POST['zip_code'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone']
];

$payment_method = $_POST['payment'];
$order_notes = $_POST['order_notes'] ?? '';

$order_items = json_decode($_POST['order_items'], true);

// Calculate total order amount
$total = array_reduce($order_items, function ($carry, $item) {
    return $carry + ($item['discounted_price'] * $item['quantity']);
}, 0);

try {
    // Create order
    $orderQuery = "INSERT INTO orders (customer_id, total) VALUES (:customer_id, :total)";
    $params = [
        'customer_id' => $customer_id,
        'total' => $total
    ];
    $db->query($orderQuery, $params);

    $order_id = $db->lastInsertId();

    if (!$order_id) {
        echo json_encode(['success' => false, 'error' => 'Failed to retrieve order_id after insertion']);
        exit;
    }

    // Insert billing information
    $billingQuery = "INSERT INTO order_billing_details 
                     (order_id, first_name, last_name, company_name, address, country, region, city, zip_code, email, phone) 
                     VALUES 
                     (:order_id, :first_name, :last_name, :company_name, :address, :country, :region, :city, :zip_code, :email, :phone)";
    $db->query($billingQuery, array_merge(['order_id' => $order_id], $billing_info));

    // Insert order items
    foreach ($order_items as $item) {
        $orderItemQuery = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
        $params = [
            'order_id' => $order_id,
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'price' => $item['discounted_price']
        ];
        $db->query($orderItemQuery, $params);
    }

    echo json_encode(['success' => true, 'message' => 'Order created successfully']);
    echo '<button onclick="window.location.href=\'/e-commerce/app/views/home.php\'">Go to Home</button>';
    // header('Location: /app/views/order_confirmation.php?order_id=' . $order_id); chuyển đến trang xác nhận đơn hàng
    // tạm thời cho chuyển đến trang products
    // header('Location: /e-commerce/app/views/products.php');
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Failed to create order: ' . $e->getMessage()]);
}
