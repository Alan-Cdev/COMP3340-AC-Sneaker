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
        <p class="eyebrow">Featured campaigns</p>
        <h2>AC Sneaker in Motion</h2>

        <p class="muted">
            Explore performance and everyday footwear through our
            running, basketball, and lifestyle campaign videos.
        </p>

        <div class="media-grid">

            <article class="panel media-card">
                <video controls muted preload="metadata">
                    <source
                        src="<?= BASE_URL ?>/assets/media/running-ad.mp4"
                        type="video/mp4"
                    >
                    Your browser does not support HTML5 video.
                </video>

                <div class="card-body">
                    <span class="badge">Running</span>
                    <h3>Built to Move</h3>
                    <p>
                        Lightweight cushioning and responsive movement
                        for everyday training.
                    </p>
                </div>
            </article>

            <article class="panel media-card">
                <video controls muted preload="metadata">
                    <source
                        src="<?= BASE_URL ?>/assets/media/basketball-ad.mp4"
                        type="video/mp4"
                    >
                    Your browser does not support HTML5 video.
                </video>

                <div class="card-body">
                    <span class="badge">Basketball</span>
                    <h3>Own the Court</h3>
                    <p>
                        Court-ready support, traction, and stability for
                        fast movement.
                    </p>
                </div>
            </article>

            <article class="panel media-card">
                <video controls muted preload="metadata">
                    <source
                        src="<?= BASE_URL ?>/assets/media/lifestyle-ad.mp4"
                        type="video/mp4"
                    >
                    Your browser does not support HTML5 video.
                </video>

                <div class="card-body">
                    <span class="badge">Lifestyle</span>
                    <h3>Style After Dark</h3>
                    <p>
                        Everyday comfort inspired by modern streetwear
                        and expressive design.
                    </p>
                </div>
            </article>

        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
