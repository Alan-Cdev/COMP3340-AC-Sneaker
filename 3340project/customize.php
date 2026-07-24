<?php
$pageTitle='Customize';require_once __DIR__.'/config/database.php';$products=$pdo->query("SELECT id,name,price FROM products WHERE active=1 ORDER BY name")->fetchAll();require __DIR__.'/includes/header.php';
?>
<section class="section"><div class="container"><h1>Build a custom pair</h1>
<form id="quote-form" class="form-card" data-base="0">
<label>Base model</label><select data-price name="model"><?php foreach($products as $p):?><option data-add="<?=e((string)$p['price'])?>"><?=e($p['name'])?> — <?=formatPrice((float)$p['price'])?></option><?php endforeach;?></select>
<label>Material</label><select data-price><option data-add="0">Standard mesh</option><option data-add="25">Premium knit (+$25)</option><option data-add="45">Vegan leather (+$45)</option></select>
<label><input type="checkbox" data-price="15"> Reflective laces (+$15)</label>
<label><input type="checkbox" data-price="20"> Custom name tag (+$20)</label>
<label><input type="checkbox" data-price="35"> Performance insole (+$35)</label>
<h2>Estimated quote: $<span id="quote-total">0.00</span></h2>
<button type="button" class="btn btn-primary">Save design preview</button>
</form></div></section><?php require __DIR__.'/includes/footer.php'; ?>
