<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json; charset=utf-8');

$q = trim($_GET['q'] ?? '');
if (mb_strlen($q) < 2) {
    echo json_encode([]);
    exit;
}

$stmt = $pdo->prepare(
    "SELECT id, name, category, price, image
     FROM products
     WHERE active = 1 AND (name LIKE :q OR category LIKE :q OR description LIKE :q)
     ORDER BY rating DESC
     LIMIT 8"
);
$stmt->execute(['q' => "%{$q}%"]);
echo json_encode($stmt->fetchAll(), JSON_UNESCAPED_SLASHES);
