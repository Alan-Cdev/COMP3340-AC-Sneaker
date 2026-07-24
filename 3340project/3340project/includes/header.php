<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/functions.php';
$pageTitle = $pageTitle ?? APP_NAME;
$metaDescription = $metaDescription ?? 'AC Sneaker custom sneakers and accessories.';
$metaKeywords = $metaKeywords ?? 'sneakers, custom shoes, footwear, online store';
$theme = currentTheme();
?>
<!doctype html>
<html lang="en" data-theme="<?= e($theme) ?>" data-base-url="<?= e(BASE_URL) ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle) ?> | <?= APP_NAME ?></title>
    <meta name="description" content="<?= e($metaDescription) ?>">
    <meta name="keywords" content="<?= e($metaKeywords) ?>">
    <meta name="author" content="Alan Chen">
    <link rel="icon" href="<?= BASE_URL ?>/assets/images/site/favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/styles.css">
    <script defer src="<?= BASE_URL ?>/assets/js/app.js"></script>
</head>
<body>
<a class="skip-link" href="#main-content">Skip to main content</a>
<header class="site-header">
    <div class="container nav-wrap">
        <a class="brand" href="<?= BASE_URL ?>/index.php">AC Sneaker</a>
        <button class="menu-toggle" aria-label="Toggle navigation" aria-expanded="false">☰</button>
        <nav class="main-nav" aria-label="Primary navigation">
            <a href="<?= BASE_URL ?>/shop.php">Shop</a>
            <a href="<?= BASE_URL ?>/customize.php">Customize</a>
            <a href="<?= BASE_URL ?>/compare.php">Compare</a>
            <a href="<?= BASE_URL ?>/about.php">About</a>
            <a href="<?= BASE_URL ?>/help/index.php">Help</a>
            <?php if (isLoggedIn()): ?>
                <a href="<?= BASE_URL ?>/dashboard.php">Dashboard</a>
                <a href="<?= BASE_URL ?>/wishlist.php">Wishlist</a>
                <?php if (isAdmin()): ?><a href="<?= BASE_URL ?>/admin/index.php">Admin</a><?php endif; ?>
                <a href="<?= BASE_URL ?>/logout.php">Logout</a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>/login.php">Login</a>
            <?php endif; ?>
            <a class="cart-link" href="<?= BASE_URL ?>/cart.php">Cart (<?= cartCount() ?>)</a>
        </nav>
    </div>
</header>
<?php if ($message = flash()): ?>
<div class="container"><div class="alert"><?= e($message) ?></div></div>
<?php endif; ?>
<main id="main-content">
