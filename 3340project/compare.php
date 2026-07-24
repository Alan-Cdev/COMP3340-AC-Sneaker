<?php
$pageTitle='Compare';require_once __DIR__.'/config/database.php';$products=$pdo->query("SELECT * FROM products WHERE active=1 ORDER BY rating DESC LIMIT 3")->fetchAll();require __DIR__.'/includes/header.php';
?>
<section class="section"><div class="container"><h1>Compare top-rated shoes</h1><div class="table-wrap"><table><tr><th>Feature</th><?php foreach($products as $p):?><th><?=e($p['name'])?></th><?php endforeach;?></tr>
<tr><td>Category</td><?php foreach($products as $p):?><td><?=e($p['category'])?></td><?php endforeach;?></tr>
<tr><td>Price</td><?php foreach($products as $p):?><td><?=formatPrice((float)$p['price'])?></td><?php endforeach;?></tr>
<tr><td>Rating</td><?php foreach($products as $p):?><td><?=e((string)$p['rating'])?>/5</td><?php endforeach;?></tr>
<tr><td>Colors</td><?php foreach($products as $p):?><td><?=e(str_replace('|',', ',$p['colors']))?></td><?php endforeach;?></tr>
</table></div></div></section><?php require __DIR__.'/includes/footer.php'; ?>
