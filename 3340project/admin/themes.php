<?php $pageTitle='Theme Manager';require_once __DIR__.'/../config/config.php';require_once __DIR__.'/../includes/functions.php';requireAdmin();require __DIR__.'/../includes/header.php';?>
<section class="section"><div class="container"><h1>Site templates</h1><?php require __DIR__.'/_nav.php';?><div class="grid grid-3">
<div class="panel card-body"><h2>Modern</h2><p>Clean light interface with purple accents.</p><a class="btn btn-primary" href="<?=BASE_URL?>/theme.php?set=modern">Activate</a></div>
<div class="panel card-body"><h2>Midnight</h2><p>Dark interface with cyan and violet accents.</p><a class="btn btn-primary" href="<?=BASE_URL?>/theme.php?set=midnight">Activate</a></div>
<div class="panel card-body"><h2>Sunset</h2><p>Warm cream interface with coral accents.</p><a class="btn btn-primary" href="<?=BASE_URL?>/theme.php?set=sunset">Activate</a></div>
</div></div></section><?php require __DIR__.'/../includes/footer.php'; ?>
