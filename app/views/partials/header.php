<?php
session_start();
$infoUser = isset($_SESSION['infoUser']) ? $_SESSION['infoUser'] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="/e-commerce/public/assets/css/main.css">
</head>

<body>
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

        <?php if ($infoUser): ?>
            <div class="auth">
                <a href="/cart">
                    <i class="fa fa-shopping-cart"></i>
                </a>
                <form method="POST" style="display:inline;">
                    <button type="submit" name="logout">Logout</button>
                </form>
            </div>
        <?php else: ?>
            <div class="auth">
                <a href="/e-commerce/app/views/login.php">Login</a>
                <p>|</p>
                <a href="/e-commerce/app/views/sign-up.php">Sign up</a>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>