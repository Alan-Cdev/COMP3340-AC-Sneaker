<?php
$pageTitle='Store Analytics';require_once __DIR__.'/config/database.php';
$categories=$pdo->query("SELECT category,COUNT(*) total FROM products GROUP BY category ORDER BY total DESC LIMIT 8")->fetchAll();
$labels=array_column($categories,'category');$values=array_map('intval',array_column($categories,'total'));
require __DIR__.'/includes/header.php';
?>
<section class="section"><div class="container"><h1>Catalogue data visualization</h1><p class="muted">Number of products in each major category.</p>
<div class="panel card-body"><canvas id="salesChart" class="chart" data-labels='<?=e(json_encode($labels))?>' data-values='<?=e(json_encode($values))?>'></canvas></div>
</div></section><?php require __DIR__.'/includes/footer.php'; ?>
