<?php
require_once __DIR__ . '/layout/MainLayout.php';

$data = [
    'pageTitle' => 'About',
    'infoUser' => false,
];

renderMainLayout(__DIR__ . '/components/about_content.php', $data);
