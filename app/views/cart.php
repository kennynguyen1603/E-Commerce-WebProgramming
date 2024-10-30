<?php
require_once __DIR__ . '/layout/MainLayout.php';

$data = [
    'pageTitle' => 'Giỏ hàng',
    'infoUser' => false,
];

renderMainLayout(__DIR__ . '/components/cart_content.php', $data);
