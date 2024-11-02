<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="signup-container">
        <div class="image-section">
            <img src="/E-Commerce/public/assets/image/LoginBG-89b402e9.png" alt="Sign Up Background">
        </div>
        <div class="form-section">
            <div class="logo-section">
                <img src="/E-Commerce/public/assets/image/logoGrey-81085dfe.png" alt="apple-logo" class="logo-image">
                <a href="/E-Commerce/app/views/home.php" class="logo-text">ex.iphones</a>
            </div>
            <h1 class="signup-title">Sign Up</h1>
            <form method="POST" action="/E-Commerce/app/server/signup_handler.php">
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <div class="input-container">
                        <input type="text" name="fullname" placeholder="Enter your full name" class="input-field">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-container">
                        <input type="email" name="email" placeholder="Enter your email" class="input-field">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-container">
                        <input type="password" name="password" placeholder="Enter your password" class="input-field">
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <div class="input-container">
                        <input type="password" name="confirm_password" placeholder="Confirm your password" class="input-field">
                    </div>
                </div>
                <button type="submit" class="submit-button">Sign Up</button>
            </form>
            <div class="additional-options">
                <p class="sign-in-prompt">
                    Already have an account?
                    <a href="/e-commerce/app/views/login.php" class="sign-in-link">Login now</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>