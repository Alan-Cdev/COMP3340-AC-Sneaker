<?php $pageTitle='Admin Documentation';require_once __DIR__.'/../config/config.php';require_once __DIR__.'/../includes/functions.php';requireAdmin();require __DIR__.'/../includes/header.php';?>
<section class="section"><div class="container"><h1>Admin documentation</h1><?php require __DIR__.'/_nav.php';?><div class="panel card-body">
<h2>Products</h2><p>Use Products to add, edit, hide, or restore catalogue records. Colors and sizes use the vertical bar character as a separator.</p>
<h2>Users</h2><p>Use Users to disable or reactivate customer accounts. Administrator accounts are protected from accidental disabling.</p>
<h2>Themes</h2><p>Use Themes to switch the entire website between Modern, Midnight, and Sunset templates.</p>
<h2>Support</h2><p>Use Requests to read customer questions and publish a response to the customer history page.</p>
<h2>Monitoring</h2><p>Use Monitor to verify PHP, MySQL, sessions, images, media, and catalogue status.</p>
</div></div></section><?php require __DIR__.'/../includes/footer.php'; ?>
