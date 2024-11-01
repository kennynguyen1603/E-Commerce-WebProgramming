<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="login-container">
        <div class="image-section">
            <img src="/E-Commerce/public/assets/image/LoginBG-89b402e9.png" alt="Login Background">
        </div>
        <div class="form-section">
            <div class="logo-section">
                <img src="/E-Commerce/public/assets/image/logoGrey-81085dfe.png" alt="apple-logo" class="logo-image">
                <a href="/E-Commerce/app/views/home.php" class="logo-text">ex.iphones</a>
            </div>
            <h1 class="login-title">Login</h1>
            <form method="POST" action="login_handler.php">
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-container">
                        <input type="email" name="email" placeholder="Enter your email" class="input-field">
                    </div>
                    <div class="error-message">
                        <!-- Error message for email -->
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-container">
                        <input type="password" name="password" placeholder="Enter your password" class="input-field">
                    </div>
                    <div class="error-message">
                        <!-- Error message for password -->
                    </div>
                </div>
                <button type="submit" class="submit-button">Login</button>
            </form>
            <div class="additional-options">
                <a href="/forgot-password" class="forgot-password-link">Forgot Password?</a>
                <p class="separator">OR</p>
                <p class="sign-up-prompt">
                    Don't have an account?
                    <a href="/e-commerce/app/views/sign-up.php" class="sign-up-link">Sign Up now</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>