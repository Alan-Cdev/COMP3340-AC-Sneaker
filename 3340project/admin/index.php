<?php
$pageTitle='Admin Dashboard';require_once __DIR__.'/../config/database.php';require_once __DIR__.'/../includes/functions.php';requireAdmin();
$stats=['Products'=>$pdo->query("SELECT COUNT(*) FROM products")->fetchColumn(),'Users'=>$pdo->query("SELECT COUNT(*) FROM users")->fetchColumn(),'Orders'=>$pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn(),'Requests'=>$pdo->query("SELECT COUNT(*) FROM service_requests")->fetchColumn()];
require __DIR__.'/../includes/header.php';
?><section class="section"><div class="container"><div class="admin-hero"><p class="eyebrow">Control centre</p><h1>Admin dashboard</h1><p>Manage catalogue content, customer accounts, support requests, themes, and system health.</p></div><?php require __DIR__.'/_nav.php';?><div class="stat-grid"><?php foreach($stats as $label=>$value):?><div class="stat"><strong><?= (int)$value ?></strong><?=e($label)?></div><?php endforeach;?></div></div></section><?php require __DIR__.'/../includes/footer.php'; ?>
