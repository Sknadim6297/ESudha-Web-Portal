<?php
declare(strict_types=1);

function database(): PDO
{
    static $connection;

    if ($connection instanceof PDO) {
        return $connection;
    }

    $host = getenv('DB_HOST') ?: (getenv('ESUDHA_DB_HOST') ?: 'localhost');
    $name = getenv('DB_NAME') ?: (getenv('ESUDHA_DB_NAME') ?: 'esudha_db');
    $username = getenv('DB_USER') ?: (getenv('ESUDHA_DB_USER') ?: 'root');
    $password = getenv('DB_PASS');
    if ($password === false) {
        $password = getenv('ESUDHA_DB_PASSWORD');
    }
    $password = $password === false ? '' : $password;

    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', $host, $name);
    $connection = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    return $connection;
}
