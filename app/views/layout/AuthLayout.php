<?php
// AuthLayout.php

function renderAuthLayout($contentPath, $data = [])
{
    // Chuyển data sang các biến có thể truy cập trong template
    extract($data);
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Auth Layout</title>
        <link rel="stylesheet" href="/public/assets/css/main.css">
    </head>

    <body>
        <div class="auth-container">
            <?php include $contentPath; ?> <!-- Nội dung trang xác thực -->
        </div>
    </body>

    </html>

<?php
}
