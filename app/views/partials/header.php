<?php
require_once __DIR__ . '/../../../config/config.php';

$infoUser = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Kiểm tra nếu người dùng nhấn nút "Logout"
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: /e-commerce/app/views/home.php");
    exit();
}
?>


<div class="header-container">
    <div class="logo">
        <i class="fa fa-apple"></i>
        <a href="/e-commerce/app/views/home.php">ex.iphones</a>
    </div>

    <nav class="routes">
        <a href="/e-commerce/app/views/home.php" class="<?= ($_SERVER['REQUEST_URI'] === '/e-commerce/app/views/home.php' || $_SERVER['REQUEST_URI'] === '/e-commerce/app/views/') ? 'active-item' : '' ?>">Home</a>
        <a href="/e-commerce/app/views/contact.php" class="<?= ($_SERVER['REQUEST_URI'] === '/e-commerce/app/views/contact.php') ? 'active-item' : '' ?>">Contact</a>
        <a href="/e-commerce/app/views/about.php" class="<?= ($_SERVER['REQUEST_URI'] === '/e-commerce/app/views/about.php') ? 'active-item' : '' ?>">About</a>
        <a href="/e-commerce/app/views/products.php" class="<?= ($_SERVER['REQUEST_URI'] === '/e-commerce/app/views/products.php') ? 'active-item' : '' ?>">Products</a>
    </nav>

    <div class="auth <?php echo $infoUser ? 'logged-in' : 'logged-out'; ?>">
        <?php if ($infoUser): ?>
            <a href="/e-commerce/app/views/cart.php">
                <i class="fa fa-shopping-cart"></i>
            </a>
            <!-- <a href="/e-commerce/app/views/wishlist.php">
                <i class="fa fa-heart" aria-hidden="true"></i>
            </a> -->

            <div class="dropdown">
                <button class="dropbtn">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </button>

                <div class="dropdown-content">
                    <a href="/e-commerce/app/views/profile.php">Profile</a>
                    <a href="/e-commerce/app/views/admin_dashboard.php">Admin</a>
                    <form method="POST" style="display:inline;">
                        <button type="submit" name="logout" class="logout-button">Logout</button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <a href="/e-commerce/app/views/login.php">Login</a>
            <p>|</p>
            <a href="/e-commerce/app/views/sign-up.php">Sign up</a>
        <?php endif; ?>
    </div>
</div>