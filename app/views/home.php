<?php
require_once __DIR__ . '/layout/MainLayout.php';
require_once __DIR__ . '/../../database/db_connection.php';

$db = new DB_Connection();

$data = [
    'pageTitle' => 'Home',
    // SELECT * FROM products WHERE best_seller = 1
    'products' => $db->get('SELECT * FROM products'),
];

renderMainLayout(__DIR__ . '/components/home_content.php', $data);
