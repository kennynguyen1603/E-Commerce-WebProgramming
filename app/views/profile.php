<?php
require_once __DIR__ . '/layout/MainLayout.php';
require_once __DIR__ . '/../../database/db_connection.php';

$db = new DB_Connection();

$data = [
    'pageTitle' => 'Profile',

];

renderMainLayout(__DIR__ . '/components/profile_content.php', $data);
