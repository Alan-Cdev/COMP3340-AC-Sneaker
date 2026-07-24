<?php
$pageTitle='Request History';require_once __DIR__.'/config/database.php';require_once __DIR__.'/includes/functions.php';requireLogin();
$stmt=$pdo->prepare("SELECT * FROM service_requests WHERE user_id=? ORDER BY created_at DESC");$stmt->execute([$_SESSION['user']['id']]);$rows=$stmt->fetchAll();
require __DIR__.'/includes/header.php';
?>
<section class="section"><div class="container"><h1>Support request history</h1><div class="grid">
<?php foreach($rows as $r):?><article class="panel card-body"><span class="badge"><?=e($r['status'])?></span><h2><?=e($r['subject'])?></h2><p><?=nl2br(e($r['message']))?></p><?php if($r['admin_response']):?><h3>Admin response</h3><p><?=nl2br(e($r['admin_response']))?></p><?php endif;?></article><?php endforeach;?>
</div></div></section><?php require __DIR__.'/includes/footer.php'; ?>
