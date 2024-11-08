<?php
require_once __DIR__ . '/layout/MainLayout.php';

$data = [
    'pageTitle' => 'Cart',
    'infoUser' => false,
];

renderMainLayout(__DIR__ . '/components/cart_content.php', $data);
