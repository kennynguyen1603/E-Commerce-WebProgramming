<?php
require_once __DIR__ . '/layout/MainLayout.php';

$data = [
    'pageTitle' => 'Contact',
    'infoUser' => false,
];

renderMainLayout(__DIR__ . '/components/contact_content.php', $data);
