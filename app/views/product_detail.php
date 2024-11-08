<?php
require_once __DIR__ . '/layout/MainLayout.php';

$data = [
    'pageTitle' => 'Product Detail',
    'infoUser' => false,
];

renderMainLayout(__DIR__ . '/components/product_detail_content.php', $data);
