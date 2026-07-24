<?php
$pageTitle = 'Shop';
require_once __DIR__ . '/config/database.php';
$q = trim($_GET['q'] ?? '');
$category = trim($_GET['category'] ?? '');
$sort = $_GET['sort'] ?? 'name';

$allowedSorts = ['name' => 'name ASC', 'price_low' => 'price ASC', 'price_high' => 'price DESC', 'rating' => 'rating DESC'];
$orderBy = $allowedSorts[$sort] ?? $allowedSorts['name'];

$sql = "SELECT * FROM products WHERE active = 1";
$params = [];
if ($q !== '') { $sql .= " AND (name LIKE :q OR description LIKE :q)"; $params['q'] = "%$q%"; }
if ($category !== '') { $sql .= " AND category = :category"; $params['category'] = $category; }
$sql .= " ORDER BY $orderBy";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();
$categories = $pdo->query("SELECT DISTINCT category FROM products WHERE active=1 ORDER BY category")->fetchAll();
require __DIR__ . '/includes/header.php';
?>
<section class="section"><div class="container">
<h1>Shop all sneakers</h1>
<form class="filters" method="get">
 <div class="search-shell"><input id="live-search" autocomplete="off" type="search" name="q" value="<?= e($q) ?>" placeholder="Search products"><div id="search-results" class="search-results" hidden></div></div>
 <select name="category"><option value="">All categories</option><?php foreach($categories as $c): ?><option <?= $category===$c['category']?'selected':'' ?>><?= e($c['category']) ?></option><?php endforeach; ?></select>
 <select name="sort">
  <option value="name">Name</option><option value="price_low" <?= $sort==='price_low'?'selected':'' ?>>Price: low to high</option>
  <option value="price_high" <?= $sort==='price_high'?'selected':'' ?>>Price: high to low</option><option value="rating" <?= $sort==='rating'?'selected':'' ?>>Rating</option>
 </select>
 <button class="btn btn-primary">Apply</button>
</form>
<div class="grid grid-4">
<?php foreach($products as $product): ?>
<article class="card"><img class="card-image" src="<?= BASE_URL . '/' . e($product['image']) ?>" alt="<?= e($product['name']) ?>"><div class="card-body">
<span class="badge"><?= e($product['category']) ?></span><h3><?= e($product['name']) ?></h3><p><?= e($product['description']) ?></p>
<p class="price"><?= formatPrice((float)$product['price']) ?></p><a class="btn btn-primary" href="<?= BASE_URL ?>/product.php?id=<?= (int)$product['id'] ?>">View details</a>
</div></article>
<?php endforeach; ?>
</div>
</div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
