<?php
session_start();
require_once '../../database/db_connection.php';
$db = new DB_Connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Kiểm tra xem email có tồn tại không
    $selectQuery = "SELECT id, username, password FROM users WHERE email = :email";
    $user = $db->get_one($selectQuery, [':email' => $email]);

    if ($user && password_verify($password, $user['password'])) {
        // Mật khẩu đúng, tạo session cho người dùng
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        header("Location: /E-Commerce/app/views/home.php");

        exit();
    } else {
        echo "Email hoặc mật khẩu không chính xác.";
    }
} else {
    echo "Phương thức yêu cầu không hợp lệ.";
}
