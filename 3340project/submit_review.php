<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';
requireLogin();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirect('/shop.php');
verifyCsrf();

$productId = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
$rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
$comment = trim($_POST['comment'] ?? '');

if ($productId && $rating >= 1 && $rating <= 5 && $comment !== '') {
    $stmt = $pdo->prepare(
        "INSERT INTO reviews(user_id, product_id, rating, comment)
         VALUES(?,?,?,?)
         ON DUPLICATE KEY UPDATE rating=VALUES(rating), comment=VALUES(comment), created_at=CURRENT_TIMESTAMP"
    );
    $stmt->execute([$_SESSION['user']['id'], $productId, $rating, mb_substr($comment, 0, 500)]);
    $pdo->prepare(
        "UPDATE products p SET rating=(SELECT ROUND(AVG(r.rating),1) FROM reviews r WHERE r.product_id=p.id) WHERE p.id=?"
    )->execute([$productId]);
    $_SESSION['flash'] = 'Your review was saved.';
}
redirect('/product.php?id=' . (int)$productId);
