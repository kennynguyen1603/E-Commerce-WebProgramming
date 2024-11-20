<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect to login if the user is not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: /e-commerce/app/views/login.php");
    exit();
}

require_once '../../database/db_connection.php';

try {
    $db = new DB_Connection();
    $conn = $db->connect();
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch latest orders
try {
    $query = "SELECT order_id, address, country, region, email, phone 
              FROM order_billing_details
              ORDER BY order_id DESC
              LIMIT 15";

    $stmt = $conn->prepare($query);
    $stmt->execute();

    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['latest_orders'] = $orders;
} catch (Exception $e) {
    error_log('Error fetching latest orders: ' . $e->getMessage());
    $_SESSION['latest_orders'] = [];
}

// Fetch most sold items
try {
    $query = "SELECT name, is_best_seller 
              FROM products
              ORDER BY is_best_seller DESC
              LIMIT 10"; // Fetch top 10 items based on is_best_seller score

    $stmt = $conn->prepare($query);
    $stmt->execute();

    $mostSoldItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalBestSellers = array_sum(array_column($mostSoldItems, 'is_best_seller')); // Total best-seller values

    foreach ($mostSoldItems as &$item) {
        $item['percentage'] = ($totalBestSellers > 0) 
            ? round(($item['is_best_seller'] / $totalBestSellers) * 100) 
            : 0;
    }

    $_SESSION['most_sold_items'] = $mostSoldItems;
} catch (Exception $e) {
    error_log('Error fetching most sold items: ' . $e->getMessage());
    $_SESSION['most_sold_items'] = [];
}

// Fetch Total Revenue
try {
    $query = "SELECT SUM(total) AS total_revenue 
              FROM orders 
              WHERE status = 'pending'";

    $stmt = $conn->prepare($query);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalRevenue = $result['total_revenue'] ?? 0; // Default to 0 if null

    $_SESSION['total_revenue'] = $totalRevenue; // Store total revenue in session
} catch (Exception $e) {
    error_log('Error fetching total revenue: ' . $e->getMessage());
    $_SESSION['total_revenue'] = 0; // Default to 0 in case of error
}

// Optional: Debugging (remove in production)
if (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'development') {
    echo "<pre>";
    echo "Latest Orders: ";
    print_r($_SESSION['latest_orders']);
    echo "Most Sold Items: ";
    print_r($_SESSION['most_sold_items']);
    echo "Total Revenue: " . number_format($_SESSION['total_revenue'], 2);
    echo "</pre>";
}
// Fetch monthly revenue
try {
    $query = "SELECT 
                MONTH(order_date) AS month,
                SUM(CASE WHEN status = 'completed' THEN total ELSE 0 END) AS completed_revenue,
                SUM(CASE WHEN status = 'pending' THEN total ELSE 0 END) AS pending_revenue
              FROM orders
              GROUP BY MONTH(order_date)
              ORDER BY MONTH(order_date)";

    $stmt = $conn->prepare($query);
    $stmt->execute();

    $monthlyRevenue = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Store the results in the session for frontend use
    $_SESSION['monthly_revenue'] = $monthlyRevenue;

} catch (Exception $e) {
    error_log('Error fetching revenue data: ' . $e->getMessage());
    $_SESSION['monthly_revenue'] = [];
}
try {
    // 1. Fetch This Month's Sales
    $query = "SELECT COUNT(*) AS month_sales 
              FROM orders 
              WHERE MONTH(order_date) = MONTH(CURDATE()) AND YEAR(order_date) = YEAR(CURDATE())";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $monthSales = $stmt->fetch(PDO::FETCH_ASSOC)['month_sales'] ?? 0;

    // 2. Fetch This Month's Revenue
    $query = "SELECT SUM(total) AS month_revenue 
              FROM orders 
              WHERE MONTH(order_date) = MONTH(CURDATE()) AND YEAR(order_date) = YEAR(CURDATE()) AND status = 'pending'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $monthRevenue = $stmt->fetch(PDO::FETCH_ASSOC)['month_revenue'] ?? 0;

    // 3. Fetch Total Users Count
    $query = "SELECT COUNT(*) AS all_users 
              FROM customers";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $allUsers = $stmt->fetch(PDO::FETCH_ASSOC)['all_users'] ?? 0;

    // Store in session for frontend
    $_SESSION['month_sales'] = $monthSales;
    $_SESSION['month_revenue'] = $monthRevenue;
    $_SESSION['all_users'] = $allUsers;
} catch (Exception $e) {
    error_log('Error fetching dashboard metrics: ' . $e->getMessage());
    $_SESSION['month_sales'] = 0;
    $_SESSION['month_revenue'] = 0;
    $_SESSION['all_users'] = 0;
}

try {
    // Fetch current month's total revenue
    $queryCurrentMonth = "SELECT SUM(total) AS current_month_revenue
                          FROM orders
                          WHERE status = 'pending'
                          AND MONTH(order_date) = MONTH(CURRENT_DATE())
                          AND YEAR(order_date) = YEAR(CURRENT_DATE())";

    $stmt = $conn->prepare($queryCurrentMonth);
    $stmt->execute();
    $currentMonthRevenue = $stmt->fetch(PDO::FETCH_ASSOC)['current_month_revenue'] ?? 0;

    // Fetch previous month's total revenue
    $queryPreviousMonth = "SELECT SUM(total) AS previous_month_revenue
                           FROM orders
                           WHERE status = 'pending'
                           AND MONTH(order_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
                           AND YEAR(order_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)";

    $stmt = $conn->prepare($queryPreviousMonth);
    $stmt->execute();
    $previousMonthRevenue = $stmt->fetch(PDO::FETCH_ASSOC)['previous_month_revenue'] ?? 0;

    // Calculate growth percentage
    $growthPercentage = 0;
    if ($previousMonthRevenue > 0) {
        $growthPercentage = (($currentMonthRevenue - $previousMonthRevenue) / $previousMonthRevenue) * 100;
    }

    // Store in session
    $_SESSION['current_month_revenue'] = $currentMonthRevenue;
    $_SESSION['growth_percentage'] = round($growthPercentage, 2);
} catch (Exception $e) {
    error_log('Error calculating revenue growth: ' . $e->getMessage());
    $_SESSION['current_month_revenue'] = 0;
    $_SESSION['growth_percentage'] = 0;
}

// Handle View, Edit, Delete Actions
$action = $_GET['action'] ?? null;

switch ($action) {
    case 'view':
        $orderId = $_GET['order_id'] ?? null;
        if ($orderId) {
            $stmt = $conn->prepare("SELECT * FROM order_billing_details WHERE order_id = :order_id");
            $stmt->execute([':order_id' => $orderId]);
            $order = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'order' => $order]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Missing order ID.']);
        }
        break;

    case 'delete':
        $data = json_decode(file_get_contents('php://input'), true);
        $orderId = $data['order_id'] ?? null;
        if ($orderId) {
            $stmt = $conn->prepare("DELETE FROM order_billing_details WHERE order_id = :order_id");
            $stmt->execute([':order_id' => $orderId]);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Missing order ID.']);
        }
        break;

        case 'edit':
            $data = json_decode(file_get_contents('php://input'), true);
            $orderId = $data['order_id'] ?? null;
            $newAddress = $data['address'] ?? null;
            $newCountry = $data['country'] ?? null;
            $newRegion = $data['region'] ?? null;
            $newEmail = $data['email'] ?? null;
            $newPhone = $data['phone'] ?? null;
        
            if ($orderId && $newAddress && $newCountry && $newRegion && $newEmail && $newPhone) {
                try {
                    $stmt = $conn->prepare("
                        UPDATE order_billing_details 
                        SET address = :address, 
                            country = :country, 
                            region = :region, 
                            email = :email, 
                            phone = :phone
                        WHERE order_id = :order_id
                    ");
                    $stmt->execute([
                        ':address' => $newAddress,
                        ':country' => $newCountry,
                        ':region' => $newRegion,
                        ':email' => $newEmail,
                        ':phone' => $newPhone,
                        ':order_id' => $orderId,
                    ]);
                    echo json_encode(['success' => true]);
                } catch (Exception $e) {
                    error_log('Error updating order: ' . $e->getMessage());
                    echo json_encode(['success' => false, 'error' => 'Database error occurred.']);
                }
            } else {
                echo json_encode(['success' => false, 'error' => 'Missing or invalid input data.']);
            }
            break;
        

    default:
        echo json_encode(['success' => false, 'error' => 'Invalid action.']);
}

// Modular Functions
function viewOrder($conn, $orderId)
{
    try {
        $query = "SELECT * FROM order_billing_details WHERE order_id = :order_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->execute();

        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($order) {
            return ['success' => true, 'order' => $order];
        } else {
            return ['success' => false, 'error' => 'Order not found.'];
        }
    } catch (Exception $e) {
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

function editOrder($conn, $orderId, $newAddress)
{
    try {
        $query = "UPDATE order_billing_details SET address = :address WHERE order_id = :order_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':address', $newAddress, PDO::PARAM_STR);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return ['success' => true];
        } else {
            return ['success' => false, 'error' => 'Failed to update the order.'];
        }
    } catch (Exception $e) {
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

function deleteOrder($conn, $orderId)
{
    try {
        $query = "DELETE FROM order_billing_details WHERE order_id = :order_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return ['success' => true];
        } else {
            return ['success' => false, 'error' => 'Failed to delete the order.'];
        }
    } catch (Exception $e) {
        return ['success' => false, 'error' => $e->getMessage()];
    }
}
?>
