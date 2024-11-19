<?php
session_start();
require_once '../../database/db_connection.php';

try {
    $db = new DB_Connection();
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: /e-commerce/app/views/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Lấy thông tin người dùng từ cơ sở dữ liệu
$query = "SELECT first_name, last_name, email, phone, country, state, pin FROM custmers WHERE id = :user_id";
$params = [':user_id' => $user_id];
$userData = $db->get_one($query, $params);

if ($userData) {

    // Lưu dữ liệu vào session
    $_SESSION['first_name'] = $userData['first_name'];
    $_SESSION['last_name'] = $userData['last_name'];
    $_SESSION['email'] = $userData['email'];
    $_SESSION['phone'] = $userData['phone'] ?? '';
    $_SESSION['country'] = $userData['country'] ?? '';
    $_SESSION['state'] = $userData['state'] ?? '';
    $_SESSION['pin'] = $userData['pin'] ?? '';

    // Chuyển hướng về trang profile_content.php
    header("Location: /e-commerce/app/views/profile.php");
    exit();
} else {
    echo "Error: User data not found.";
    exit();
}
