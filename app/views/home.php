<?php
require_once __DIR__ . '/layout/MainLayout.php';

$data = [
    'pageTitle' => 'Home',
    'infoUser' => false,
];

renderMainLayout(__DIR__ . '/components/home_content.php', $data);
