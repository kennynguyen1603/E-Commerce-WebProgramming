<?php
require_once __DIR__ . '/layout/AuthLayout.php';

$data = [
    'pageTitle' => 'Sign Up',
];

renderAuthLayout(__DIR__ . '/components/signup_content.php', $data);
