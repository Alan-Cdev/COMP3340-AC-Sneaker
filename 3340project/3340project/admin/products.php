<?php
$pageTitle='Manage Products';require_once __DIR__.'/../config/database.php';require_once __DIR__.'/../includes/functions.php';requireAdmin();
if(isset($_GET['toggle'])){$stmt=$pdo->prepare("UPDATE products SET active=1-active WHERE id=?");$stmt->execute([(int)$_GET['toggle']]);redirect('/admin/products.php');}
$products=$pdo->query("SELECT * FROM products ORDER BY id DESC")->fetchAll();require __DIR__.'/../includes/header.php';
?><section class="section"><div class="container"><h1>Product records</h1><?php require __DIR__.'/_nav.php';?><p><a class="btn btn-primary" href="<?=BASE_URL?>/admin/product_form.php">Add product</a></p>
<div class="table-wrap"><table><tr><th>ID</th><th>Name</th><th>Price</th><th>Status</th><th>Actions</th></tr><?php foreach($products as $p):?><tr><td><?= (int)$p['id']?></td><td><?=e($p['name'])?></td><td><?=formatPrice((float)$p['price'])?></td><td><?= $p['active']?'Active':'Hidden'?></td><td><a href="<?=BASE_URL?>/admin/product_form.php?id=<?=(int)$p['id']?>">Edit</a> | <a href="?toggle=<?=(int)$p['id']?>">Toggle</a></td></tr><?php endforeach;?></table></div>
</div></section><?php require __DIR__.'/../includes/footer.php'; ?>
