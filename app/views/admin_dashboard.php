<?php
require_once __DIR__ . '/layout/MainLayout.php';
require_once __DIR__ . '/../../database/db_connection.php';

$db = new DB_Connection();

$data = [
    'pageTitle' => 'AdminDashboard',

];

renderMainLayout(__DIR__ . '/components/admin_dashboard_content.php', $data);