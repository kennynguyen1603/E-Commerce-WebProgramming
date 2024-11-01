<?php

function renderMainLayout($contentPath, $data = [])
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <?php include __DIR__ . '/../partials/header.php'; ?> <!-- Header dùng chung -->

        <main>
            <?php include $contentPath; ?> <!-- Nội dung trang  -->
        </main>

        <?php include __DIR__ . '/../partials/footer.php'; ?> <!-- Footer dùng chung -->
    </body>

    </html>

<?php
}
