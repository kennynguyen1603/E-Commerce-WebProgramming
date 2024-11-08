<?php
session_start();
require_once '../../database/db_connection.php';

try {
    $db = new DB_Connection();
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $fullname = trim($_POST['fullname']);
    // $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Kiểm tra các trường bắt buộc
    if (empty($fullname) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "All fields are required.";
        exit();
    }

    // Kiểm tra mật khẩu và xác nhận mật khẩu có trùng khớp không
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit();
    }

    // Kiểm tra email hợp lệ
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
    $selectQuery = "SELECT * FROM customers WHERE email = :email";
    $existingUser = $db->get_one($selectQuery, [':email' => $email]);

    if ($existingUser) {
        echo "Email already exists. Please use a different email.";
        exit();
    }

    // Mã hóa mật khẩu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Thêm người dùng mới vào cơ sở dữ liệu
    $insertQuery = "INSERT INTO customers (username, email, password, role) VALUES (:username, :email, :password, 'user')";
    $params = [
        ':username' => $fullname,
        ':email' => $email,
        ':password' => $hashed_password
    ];

    $result = $db->query($insertQuery, $params);

    if ($result) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $db->connect()->lastInsertId();
        $_SESSION['username'] = $fullname;
        $_SESSION['role'] = 'user';

        echo "Registration successful!";
        header("Location: /e-commerce/app/views/home.php");
        exit();
    } else {
        echo "Error occurred while registering. Please try again.";
    }
} else {
    echo "Invalid request method.";
}
