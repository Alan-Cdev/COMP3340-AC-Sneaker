<?php
$pageTitle = 'Product';
require_once __DIR__ . '/config/database.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ? AND active = 1");
$stmt->execute([$id]);
$product = $stmt->fetch();
if (!$product) { http_response_code(404); exit('Product not found.'); }
$pageTitle = $product['name'];
$colors = explode('|', $product['colors']);
$sizes = explode('|', $product['sizes']);
require __DIR__ . '/includes/header.php';
?>
<section class="section"><div class="container product-detail">
<div class="card"><img class="card-image" src="<?= BASE_URL . '/' . e($product['image']) ?>" alt="<?= e($product['name']) ?>"></div>
<div>
<span class="badge"><?= e($product['category']) ?></span><h1><?= e($product['name']) ?></h1>
<p><?= e($product['description']) ?></p><p class="rating-line" aria-label="Rated <?= e((string)$product['rating']) ?> out of 5">★ <?= e((string)$product['rating']) ?>/5</p><p class="price"><?= formatPrice((float)$product['price']) ?></p>
<form method="post" action="<?= BASE_URL ?>/add_to_cart.php" class="form-card">
<input type="hidden" name="product_id" value="<?= (int)$product['id'] ?>">
<div class="form-grid">
<div><label for="color">Color</label><select id="color" name="color"><?php foreach($colors as $color): ?><option><?= e($color) ?></option><?php endforeach; ?></select></div>
<div><label for="size">Size</label><select id="size" name="size"><?php foreach($sizes as $size): ?><option><?= e($size) ?></option><?php endforeach; ?></select></div>
<div><label for="quantity">Quantity</label><input class="quantity" id="quantity" type="number" name="quantity" min="1" max="10" value="1"></div>
<div class="full"><button class="btn btn-primary">Add to cart</button></div>
</div></form>
<?php if (isLoggedIn()): ?>
<form method="post" action="<?=BASE_URL?>/wishlist.php" class="inline-form">
<?=csrfField()?><input type="hidden" name="product_id" value="<?=(int)$product['id']?>">
<button class="btn btn-secondary">♡ Save to wishlist</button>
</form>
<?php endif; ?>
<p><a href="<?= BASE_URL ?>/help/shopping.php">Context help: how to choose options</a></p>
</div></div></section>
<section class="section"><div class="container">
<h2>Customer reviews</h2>
<?php
$reviewStmt=$pdo->prepare("SELECT r.*,u.name FROM reviews r JOIN users u ON u.id=r.user_id WHERE r.product_id=? ORDER BY r.created_at DESC");
$reviewStmt->execute([$product['id']]); $reviews=$reviewStmt->fetchAll();
?>
<div class="grid grid-3">
<?php foreach($reviews as $review): ?><article class="panel card-body"><p class="rating-line"><?=str_repeat('★',(int)$review['rating'])?></p><h3><?=e($review['name'])?></h3><p><?=e($review['comment'])?></p></article><?php endforeach;?>
<?php if(!$reviews):?><p class="muted">No reviews yet. Be the first customer to review this product.</p><?php endif;?>
</div>
<?php if(isLoggedIn()):?>
<form class="form-card" method="post" action="<?=BASE_URL?>/submit_review.php">
<?=csrfField()?><input type="hidden" name="product_id" value="<?=(int)$product['id']?>">
<label for="rating">Rating</label><select id="rating" name="rating" required><option value="">Choose rating</option><option value="5">5 — Excellent</option><option value="4">4 — Very good</option><option value="3">3 — Good</option><option value="2">2 — Fair</option><option value="1">1 — Poor</option></select>
<label for="comment">Review</label><textarea id="comment" name="comment" maxlength="500" rows="4" required></textarea><button class="btn btn-primary">Publish review</button>
</form><?php endif;?>
</div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
