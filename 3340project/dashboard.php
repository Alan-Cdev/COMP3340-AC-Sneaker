<?php
$pageTitle='Dashboard';require_once __DIR__.'/config/database.php';require_once __DIR__.'/includes/functions.php';requireLogin();
$stmt=$pdo->prepare("SELECT COUNT(*) FROM orders WHERE user_id=?");$stmt->execute([$_SESSION['user']['id']]);$orderCount=$stmt->fetchColumn();
require __DIR__.'/includes/header.php';
?>
<section class="section"><div class="container"><h1>Welcome, <?=e($_SESSION['user']['name'])?></h1>
<div class="grid grid-3"><div class="panel card-body"><h2><?= (int)$orderCount ?></h2><p>Orders</p><a href="<?=BASE_URL?>/orders.php">View orders</a></div>
<div class="panel card-body"><h2>Profile</h2><p>Manage your account information.</p><a href="<?=BASE_URL?>/profile.php">Edit profile</a></div>
<div class="panel card-body"><h2>Support</h2><p>Ask a question or request help.</p><a href="<?=BASE_URL?>/service_request.php">New request</a></div></div>
</div></section><?php require __DIR__.'/includes/footer.php'; ?>
