<?php

function renderAuthLayout($contentPath, $data = [])
{
    extract($data);
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            <?php echo htmlspecialchars($pageTitle); ?>
        </title>
        <link rel="stylesheet" href="/E-Commerce/public/assets/css/main.css">
    </head>

    <body>

        <div class="auth-container">
            <?php include $contentPath; ?>
        </div>

    </body>

    </html>

<?php
}
