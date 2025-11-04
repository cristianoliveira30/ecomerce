<?php
require_once __DIR__ . '/../app/Core/EnvLoader.php';

EnvLoader::load(__DIR__ . '../../.env');

return [
    'host' => getenv('DB_HOST'),
    'dbname' => getenv('DB_NAME'),
    'user' => getenv('DB_USER'),
    'password' => getenv('DB_PASS'),
];
