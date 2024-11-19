<?php
session_start();
require_once '../../database/db_connection.php';

try {
    $db = new DB_Connection();
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Hiển thị thông tin để kiểm tra dữ liệu POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Received POST Data: ";
    print_r($_POST); // Kiểm tra dữ liệu gửi từ form
    echo "<br>";

    // Kiểm tra session
    if (!isset($_SESSION['user_id'])) {
        die("Session không tồn tại. Đăng nhập trước khi cập nhật thông tin.");
    }

    // Nhận dữ liệu từ form
    $firstName = $_POST['first_name'] ?? '';
    $secondName = $_POST['second_name'] ?? '';
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $country = $_POST['country'] ?? '';
    $address = $_POST['address'] ?? '';
    $pin = $_POST['pin'] ?? '';

    // Kiểm tra dữ liệu có đầy đủ
    if (empty($firstName) || empty($secondName) || empty($username) || empty($email) || empty($phone) || empty($country) || empty($address) || empty($pin)) {
        echo "Vui lòng điền đầy đủ thông tin.";
    } else {
        // Kiểm tra email hợp lệ
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email không hợp lệ. Vui lòng kiểm tra lại.";
        } else {
            // Nếu dữ liệu hợp lệ, thực thi câu lệnh UPDATE
            $query = "UPDATE customers 
            SET phone = :phone, 
                country = :country, 
                address = :address, 
                pin = :pin 
            WHERE id = :user_id";

            $params = [
                ':phone' => $phone,
                ':country' => $country,
                ':address' => $address,
                ':pin' => $pin,
                ':user_id' => $user_id
            ];
            if ($db->query($query, $params)) {
                $_SESSION['phone'] = $phone;
                $_SESSION['country'] = $country;
                $_SESSION['address'] = $address;
                $_SESSION['pin'] = $pin;
                echo '<div style="color: green; text-align: center; font-size: 20px;">Thông tin tài khoản đã được cập nhật thành công!</div>';
                header('Location: /e-commerce/app/views/home.php');
            } else {
                echo '<div style="color: red; text-align: center; font-size: 20px;">Có lỗi xảy ra. Vui lòng thử lại sau!</div>';
            }
        }
    }
}
