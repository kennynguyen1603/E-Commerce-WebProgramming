<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: /e-commerce/app/views/login.php");
    exit();
}

// Kết nối cơ sở dữ liệu
require_once '../../database/db_connection.php';

try {
    $db = new DB_Connection();
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Lấy dữ liệu từ database
$user_id = $_SESSION['user_id'];
$query = "SELECT first_name, last_name, email, phone, country, address, pin FROM customers WHERE id = :user_id";
$params = [':user_id' => $user_id];
$userData = $db->get_one($query, $params);

if ($userData) {
    $_SESSION['first_name'] = $userData['first_name'];
    $_SESSION['last_name'] = $userData['last_name'];
    $_SESSION['email'] = $userData['email'];
    $_SESSION['phone'] = $userData['phone'] ?? '';
    $_SESSION['country'] = $userData['country'] ?? '';
    $_SESSION['address'] = $userData['address'] ?? '';
    $_SESSION['pin'] = $userData['pin'] ?? '';
} else {
    echo "Không tìm thấy dữ liệu người dùng.";
    exit();
}
?>

<div class="profile-container">
  <aside class="sidebar">
    <ul>
      <li><a href="#">
        <i class="fa fa-slack" aria-hidden="true"></i>

      </svg> Dashboard</a></li>
      <li><a href="#">
          <i class="fa fa-user-circle" aria-hidden="true"></i>
       Account Details</a></li>
      <li><a href="#"><i class="fa fa-history" aria-hidden="true"></i>
      Order History</a></li>
      <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>
      Track Order</a></li>
      <li><a href="#"> <i class="fa fa-shopping-cart"></i> Shopping Cart</a></li>
    </ul>
  </aside>
  <main class="main-content">
    <h1>Account Setting</h1>
    <section class="account-details">
      <div class="profile-section">
        <div class="profile-img">
          <img src="https://i.imgur.com/bDLhJiP.jpg" class="rounded-circle" alt="Profile Picture">
        </div>
      </div>
      <div class="profile-info">


      <form action="/e-commerce/app/server/saveprofile_handler.php" method="POST">
      <div class="form-group">
        <label for="first_name"><strong>First Name:</strong></label>
        <input type="text" id="first_name" name="first_name" 
               value="<?= htmlspecialchars($_SESSION['first_name'] ?? '') ?>" 
               readonly>
    </div>
    <div class="form-group">
        <label for="last_name"><strong>Last Name:</strong></label>
        <input type="text" id="last_name" name="last_name" 
               value="<?= htmlspecialchars($_SESSION['last_name'] ?? '') ?>" 
               readonly>
    </div>
    <div class="form-group">
        <label for="email"><strong>Email:</strong></label>
        <input type="email" id="email" name="email" 
               value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>" 
               readonly>
    </div>
    <div class="form-group">
        <label for="phone"><strong>Phone Number:</strong></label>
        <input type="tel" id="phone" name="phone" 
              value="<?= htmlspecialchars($_SESSION['phone'] ?? '') ?>">
    </div>
    <div class="form-group">
        <label for="country"><strong>Country:</strong></label>
        <select id="country" name="country">
            <option <?= ($_SESSION['country'] ?? '') == 'Viet Nam' ? 'selected' : '' ?>>Viet Nam</option>
            <option <?= ($_SESSION['country'] ?? '') == 'Indonesia' ? 'selected' : '' ?>>Indonesia</option>
            <option <?= ($_SESSION['country'] ?? '') == 'India' ? 'selected' : '' ?>>India</option>
            <option <?= ($_SESSION['country'] ?? '') == 'Japanese' ? 'selected' : '' ?>>Japanese</option>
            <option <?= ($_SESSION['country'] ?? '') == 'Korea' ? 'selected' : '' ?>>Korea</option>
            <option <?= ($_SESSION['country'] ?? '') == 'Iran' ? 'selected' : '' ?>>Iran</option>
            <option <?= ($_SESSION['country'] ?? '') == 'Ukraine' ? 'selected' : '' ?>>Ukraine</option>
        </select>
    </div>
    <div class="form-group">
    <label for="address"><strong>Address</strong></label>
    <input type="text" id="address" name="address" 
           value="<?= htmlspecialchars($_SESSION['address'] ?? '') ?>" 
           placeholder="">
    </div>

    <div class="form-group">
        <label for="pin"><strong>Pin Code:</strong></label>
        <input type="text" id="pin" name="pin" 
              value="<?= htmlspecialchars($_SESSION['pin'] ?? '') ?>">
    </div>


    <button type="submit">Save Changes</button>
</form>
    </section>
  </main>
</div>