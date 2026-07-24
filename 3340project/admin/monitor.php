<?php
$pageTitle='Website Monitor';require_once __DIR__.'/../config/database.php';require_once __DIR__.'/../includes/functions.php';requireAdmin();
$checks=[
 'PHP Runtime'=>PHP_VERSION,
 'Database Connection'=>$pdo instanceof PDO?'Online':'Offline',
 'Session Service'=>session_status()===PHP_SESSION_ACTIVE?'Online':'Offline',
 'Product Catalogue'=>(int)$pdo->query("SELECT COUNT(*) FROM products")->fetchColumn()>=20?'Online':'Needs data',
 'Image Directory'=>is_dir(__DIR__.'/../assets/images/products')?'Online':'Offline',
 'Media Directory'=>is_dir(__DIR__.'/../assets/media')?'Online':'Offline',
 'Writable Session'=>isset($_SESSION)?'Online':'Offline'
];require __DIR__.'/../includes/header.php';
?><section class="section"><div class="container"><h1>Website status monitor</h1><?php require __DIR__.'/_nav.php';?><div class="table-wrap"><table><tr><th>Service</th><th>Status / Version</th></tr><?php foreach($checks as $name=>$status):?><tr><td><?=e($name)?></td><td class="<?=in_array($status,['Online'],true)?'status-online':''?>"><?=e((string)$status)?></td></tr><?php endforeach;?></table></div></div></section><?php require __DIR__.'/../includes/footer.php'; ?>
