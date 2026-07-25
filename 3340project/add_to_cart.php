<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirect('/shop.php');
$id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT) ?: 1;
if ($id) {
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + min(max($quantity,1),10);
    $_SESSION['flash'] = 'Product added to cart.';
}
redirect('/cart.php');
