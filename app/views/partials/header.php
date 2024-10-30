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
            <a href="/home">ex.iphones</a>
        </div>

        <nav class="routes">
            <a href="/home" class="<?= ($_SERVER['REQUEST_URI'] === '/home') ? 'active-item' : '' ?>">Home</a>
            <a href="/contact" class="<?= ($_SERVER['REQUEST_URI'] === '/contact') ? 'active-item' : '' ?>">Contact</a>
            <a href="/about" class="<?= ($_SERVER['REQUEST_URI'] === '/about') ? 'active-item' : '' ?>">About</a>
            <a href="/products" class="<?= ($_SERVER['REQUEST_URI'] === '/products') ? 'active-item' : '' ?>">Products</a>
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
                <a href="/login">Login</a>
                <p>|</p>
                <a href="/sign-up">Sign up</a>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>