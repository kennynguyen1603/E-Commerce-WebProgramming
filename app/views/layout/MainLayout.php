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
        <title>Main Layout</title>
        <link rel="stylesheet" href="/public/assets/css/main.css">
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
