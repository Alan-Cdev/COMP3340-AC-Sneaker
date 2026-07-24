<?php
$pageTitle = 'Shopping Cart';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';
if (isset($_GET['remove'])) { unset($_SESSION['cart'][(int)$_GET['remove']]); redirect('/cart.php'); }
$cart = $_SESSION['cart'] ?? [];
$items=[]; $total=0;
if ($cart) {
 $ids = array_keys($cart);
 $marks = implode(',', array_fill(0,count($ids),'?'));
 $stmt=$pdo->prepare("SELECT * FROM products WHERE id IN ($marks)");
 $stmt->execute($ids);
 foreach($stmt->fetchAll() as $p){ $p['quantity']=$cart[$p['id']]; $p['subtotal']=$p['price']*$p['quantity']; $total+=$p['subtotal']; $items[]=$p; }
}
require __DIR__ . '/includes/header.php';
?>
<section class="section"><div class="container"><h1>Your cart</h1>
<div class="table-wrap"><table><thead><tr><th>Product</th><th>Quantity</th><th>Price</th><th>Subtotal</th><th></th></tr></thead><tbody>
<?php if(!$items): ?><tr><td colspan="5">Your cart is empty.</td></tr><?php endif; ?>
<?php foreach($items as $item): ?><tr><td><?= e($item['name']) ?></td><td><?= (int)$item['quantity'] ?></td><td><?= formatPrice((float)$item['price']) ?></td><td><?= formatPrice((float)$item['subtotal']) ?></td><td><a href="?remove=<?= (int)$item['id'] ?>">Remove</a></td></tr><?php endforeach; ?>
</tbody></table></div>
<h2>Total: <?= formatPrice((float)$total) ?></h2>
<div class="button-row"><a class="btn btn-secondary" href="<?= BASE_URL ?>/shop.php">Continue shopping</a><a class="btn btn-primary" href="<?= BASE_URL ?>/checkout.php">Checkout</a></div>
</div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
