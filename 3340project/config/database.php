<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

/*
 * University of Windsor DirectAdmin database settings.
 * For security, paste your database password only on the server.
 */
$host = 'localhost';
$dbname = 'chen5w_3340project';
$username = 'chen5w_3340project';
$password = 'YOUR_DATABASE_PASSWORD';
$charset = 'utf8mb4';

$dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $exception) {
    error_log($exception->getMessage());
    http_response_code(500);
    exit('Database connection failed. Check config/database.php.');
}
