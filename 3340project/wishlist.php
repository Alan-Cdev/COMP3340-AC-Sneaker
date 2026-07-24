<?php
$pageTitle = 'Wishlist';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyCsrf();
    $productId = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    $action = $_POST['action'] ?? 'add';
    if ($productId) {
        if ($action === 'remove') {
            $stmt = $pdo->prepare("DELETE FROM wishlist WHERE user_id=? AND product_id=?");
        } else {
            $stmt = $pdo->prepare("INSERT IGNORE INTO wishlist(user_id,product_id) VALUES(?,?)");
        }
        $stmt->execute([$_SESSION['user']['id'], $productId]);
    }
    redirect('/wishlist.php');
}

$stmt = $pdo->prepare(
    "SELECT p.* FROM wishlist w
     JOIN products p ON p.id=w.product_id
     WHERE w.user_id=? AND p.active=1
     ORDER BY w.created_at DESC"
);
$stmt->execute([$_SESSION['user']['id']]);
$products = $stmt->fetchAll();
require __DIR__ . '/includes/header.php';
?>
<section class="section"><div class="container">
<p class="eyebrow">Saved collection</p><h1>Your wishlist</h1>
<div class="grid grid-4">
<?php foreach ($products as $product): ?>
<article class="card">
<img class="card-image" src="<?= BASE_URL . '/' . e($product['image']) ?>" alt="<?= e($product['name']) ?>">
<div class="card-body"><span class="badge"><?= e($product['category']) ?></span><h2><?= e($product['name']) ?></h2>
<p class="price"><?= formatPrice((float)$product['price']) ?></p>
<div class="button-row"><a class="btn btn-primary" href="<?=BASE_URL?>/product.php?id=<?=(int)$product['id']?>">View</a>
<form method="post"><?=csrfField()?><input type="hidden" name="product_id" value="<?=(int)$product['id']?>"><input type="hidden" name="action" value="remove"><button class="btn btn-secondary">Remove</button></form></div>
</div></article>
<?php endforeach; ?>
<?php if (!$products): ?><div class="panel card-body"><h2>No saved products yet</h2><p>Use the heart button on any product page.</p></div><?php endif; ?>
</div></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
