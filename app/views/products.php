<?php
require_once __DIR__ . '/layout/MainLayout.php';

$data = [
    'pageTitle' => 'Products',
    'infoUser' => false,
];

renderMainLayout(__DIR__ . '/components/products_content.php', $data);
