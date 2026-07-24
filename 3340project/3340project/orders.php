<?php
$pageTitle='Order History';require_once __DIR__.'/config/database.php';require_once __DIR__.'/includes/functions.php';requireLogin();
$stmt=$pdo->prepare("SELECT * FROM orders WHERE user_id=? ORDER BY created_at DESC");$stmt->execute([$_SESSION['user']['id']]);$orders=$stmt->fetchAll();
require __DIR__.'/includes/header.php';
?>
<section class="section"><div class="container"><h1>Order history</h1><div class="table-wrap"><table><tr><th>Order</th><th>Date</th><th>Total</th><th>Status</th></tr>
<?php foreach($orders as $o):?><tr><td>#<?= (int)$o['id']?></td><td><?=e($o['created_at'])?></td><td><?=formatPrice((float)$o['total'])?></td><td><?=e($o['status'])?></td></tr><?php endforeach;?>
</table></div></div></section><?php require __DIR__.'/includes/footer.php'; ?>
