<?php
require_once __DIR__ . '/layout/AuthLayout.php';

$data = [
    'pageTitle' => 'Login',
];

renderAuthLayout(__DIR__ . '/components/login_content.php', $data);
