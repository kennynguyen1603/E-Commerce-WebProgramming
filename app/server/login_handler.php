<?php
session_start();
require_once '../../database/db_connection.php';

try {
    $db = new DB_Connection();
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    // $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Kiểm tra xem email có tồn tại không
    $selectQuery = "SELECT id, username, password, role FROM customers WHERE email = :email";
    $user = $db->get_one($selectQuery, [':email' => $email]);

    if ($user && password_verify($password, $user['password'])) {
        // Mật khẩu đúng, tạo session cho người dùng
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if (isset($_GET['redirect'])) {
            $redirectUrl = urldecode($_GET['redirect']);
            header("Location: $redirectUrl");
        } else {
            header("Location: /e-commerce/app/views/home.php");
        }

        exit();
    } else {
        echo "Email hoặc mật khẩu không chính xác.";
    }
} else {
    echo "Phương thức yêu cầu không hợp lệ.";
}
