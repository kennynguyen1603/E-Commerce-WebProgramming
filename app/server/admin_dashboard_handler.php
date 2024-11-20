<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect to login if the user is not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: /e-commerce/app/views/login.php");
    exit();
}

// Include the database connection
require_once '../../database/db_connection.php';

try {
    $db = new DB_Connection();
    $conn = $db->connect();
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if a specific order ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Fetch details for a specific order
    $order_id = intval($_GET['id']); // Sanitize input

    try {
        // Query to fetch order details
        $query = "SELECT id, customer_id, order_date, status, total
                  FROM orders
                  WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->execute(['id' => $order_id]);

        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$order) {
            echo json_encode(['success' => false, 'error' => 'Order not found.']);
            exit();
        }

        // Return the order details as JSON
        echo json_encode(['success' => true, 'order' => $order]);
    } catch (Exception $e) {
        error_log('Error fetching order: ' . $e->getMessage());
        echo json_encode(['success' => false, 'error' => 'Error fetching order. Please try again later.']);
        exit();
    }
} else {
    // Fetch the latest orders if no specific order ID is provided
    try {
        // Query to fetch the latest orders
        $query = "SELECT order_id, address, country, region, email, phone 
                  FROM order_billing_details
                  ORDER BY order_id DESC
                  LIMIT 15";

        $stmt = $conn->prepare($query);
        $stmt->execute();

        // Fetch results
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Store orders in session for later use
        $_SESSION['latest_orders'] = $orders;

        // Optional: Debugging information (for development)
        if (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'development') {
            echo "<pre>SQL Query: " . $query . "</pre>";
            echo "<pre>Fetched Data: ";
            print_r($orders);
            echo "</pre>";
        }
    } catch (Exception $e) {
        error_log('Error fetching latest orders: ' . $e->getMessage());
        die("Error fetching latest orders: " . $e->getMessage());
    }
}
?>
