<?php
session_start();
require_once '../../database/db_connection.php';

try {
    $db = new DB_Connection();
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ form
    $firstName = $_POST['firstName'];
    $secondName = $_POST['secondName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Kiểm tra dữ liệu có đầy đủ và hợp lệ
    if (empty($firstName) || empty($secondName) || empty($email) || empty($phone) || empty($subject) || empty($message)) {
        echo "Vui lòng điền đầy đủ thông tin.";
    } else {
        // Kiểm tra email hợp lệ
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email không hợp lệ. Vui lòng kiểm tra lại.";
        } else {
            // Nếu dữ liệu hợp lệ, thực thi câu lệnh INSERT vào cơ sở dữ liệu
            $query = "INSERT INTO contact (firstName, secondName, email, phone, subject, message) 
                      VALUES (:firstName, :secondName, :email, :phone, :subject, :message)";

            // Mảng tham số để bind vào câu lệnh SQL
            $params = [
                ':firstName' => $firstName,
                ':secondName' => $secondName,
                ':email' => $email,
                ':phone' => $phone,
                ':subject' => $subject,
                ':message' => $message
            ];

            // Thực thi câu lệnh SQL
            if ($db->query($query, $params)) {
                echo '<div style="color: red; text-align: center; font-size: 20px;"><b>Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi bạn trong thời gian sớm nhất.</b></div>';

                echo '<meta http-equiv="refresh" content="5;url=app/server/contact_handler.php">';
            } else {
                echo '<div style="color: red; text-align: center; font-size: 20px;">Có lỗi xảy ra. Vui lòng thử lại sau!</div>';
            }
        }
    }
}
?>
