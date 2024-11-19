<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}


if (!isset($_SESSION['user_id'])) {
    header("Location: /e-commerce/app/views/login.php");
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
              value="<?= htmlspecialchars($_SESSION['first_name'] ?? '') ?>">
    </div>
    <div class="form-group">
        <label for="second_name"><strong>Last Name:</strong></label>
        <input type="text" id="second_name" name="second_name" 
              value="<?= htmlspecialchars($_SESSION['last_name'] ?? '') ?>">
    </div>
    <div class="form-group">
        <label for="username"><strong>Username:</strong></label>
        <input type="text" id="username" name="username" 
              value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>">
    </div>
    <div class="form-group">
        <label for="email"><strong>Email:</strong></label>
        <input type="email" id="email" name="email" 
              value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>">
    </div>
    <div class="form-group">
        <label for="phone"><strong>Phone Number:</strong></label>
        <input type="tel" id="phone" name="phone" 
              value="<?= htmlspecialchars($_SESSION['phone'] ?? '') ?>">
    </div>
    <div class="form-group">
        <label for="country"><strong>Country:</strong></label>
        <select id="country" name="country">
            <option <?= ($_SESSION['country'] ?? '') == 'India' ? 'selected' : '' ?>>India</option>
            <option <?= ($_SESSION['country'] ?? '') == 'Viet Nam' ? 'selected' : '' ?>>Viet Nam</option>
            <option <?= ($_SESSION['country'] ?? '') == 'Indonesia' ? 'selected' : '' ?>>Indonesia</option>
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
