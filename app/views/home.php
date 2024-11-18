<?php
require_once __DIR__ . '/layout/MainLayout.php';
require_once __DIR__ . '/../../database/db_connection.php';

$db = new DB_Connection();

$data = [
    'pageTitle' => 'Home',
    'products' => $db->get('SELECT id, name, thumbnail_url, price FROM products WHERE is_best_seller = 1'),
];

renderMainLayout(__DIR__ . '/components/home_content.php', $data);
