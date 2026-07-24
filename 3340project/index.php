<?php
$pageTitle = 'Custom Sneakers for Everyday Life';
require_once __DIR__ . '/config/database.php';
$stmt = $pdo->query("SELECT * FROM products WHERE active = 1 ORDER BY rating DESC LIMIT 4");
$featured = $stmt->fetchAll();
require __DIR__ . '/includes/header.php';
?>
<section class="hero">
  <div class="container hero-grid">
    <div>
      <p class="eyebrow">Designed by you</p>
      <h1>Move differently.</h1>
      <p>AC Sneaker is a modern online sneaker catalogue where customers can explore, compare, customize, and order footwear for running, training, travel, and everyday life.</p>
      <div class="button-row">
        <a class="btn btn-primary" href="<?= BASE_URL ?>/shop.php">Browse collection</a>
        <a class="btn btn-secondary" href="<?= BASE_URL ?>/customize.php">Build a custom pair</a>
      </div>
    </div>
    <div class="hero-card"><img src="<?= BASE_URL ?>/assets/images/site/hero.svg" alt="Illustration of a modern custom sneaker"></div>
  </div>
</section>
<section class="section">
  <div class="container">
    <p class="eyebrow">Popular now</p><h2>Featured footwear</h2>
    <div class="grid grid-4">
      <?php foreach ($featured as $product): ?>
      <article class="card">
        <img class="card-image" src="<?= BASE_URL . '/' . e($product['image']) ?>" alt="<?= e($product['name']) ?>">
        <div class="card-body">
          <span class="badge"><?= e($product['category']) ?></span>
          <h3><?= e($product['name']) ?></h3>
          <p class="price"><?= formatPrice((float)$product['price']) ?></p>
          <a class="btn btn-primary" href="<?= BASE_URL ?>/product.php?id=<?= (int)$product['id'] ?>">View product</a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<section class="section">
 <div class="container">
  <h2>Sound of AC Sneaker</h2>
  <p class="muted">Three short original audio samples included as project multimedia.</p>
  <div class="media-grid">
   <audio controls src="<?= BASE_URL ?>/assets/media/track-1.wav"></audio>
   <audio controls src="<?= BASE_URL ?>/assets/media/track-2.wav"></audio>
   <audio controls src="<?= BASE_URL ?>/assets/media/track-3.wav"></audio>
  </div>
 </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
