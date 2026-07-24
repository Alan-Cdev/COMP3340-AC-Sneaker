<?php
$pageTitle='Checkout';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';
requireLogin();
$cart=$_SESSION['cart']??[];
if($_SERVER['REQUEST_METHOD']==='POST' && $cart){
 $ids=array_keys($cart); $marks=implode(',',array_fill(0,count($ids),'?'));
 $stmt=$pdo->prepare("SELECT * FROM products WHERE id IN ($marks)"); $stmt->execute($ids); $products=$stmt->fetchAll();
 $total=0; foreach($products as $p){$total += $p['price']*$cart[$p['id']];}
 $pdo->beginTransaction();
 $stmt=$pdo->prepare("INSERT INTO orders(user_id,total) VALUES(?,?)"); $stmt->execute([$_SESSION['user']['id'],$total]); $orderId=(int)$pdo->lastInsertId();
 $itemStmt=$pdo->prepare("INSERT INTO order_items(order_id,product_id,quantity,price) VALUES(?,?,?,?)");
 foreach($products as $p){$itemStmt->execute([$orderId,$p['id'],$cart[$p['id']],$p['price']]);}
 $pdo->commit(); unset($_SESSION['cart']); $_SESSION['flash']="Order #$orderId created successfully."; redirect('/orders.php');
}
require __DIR__.'/includes/header.php';
?>
<section class="section"><div class="container"><h1>Checkout</h1>
<form class="form-card" method="post">
<div class="form-grid">
<div><label>Full name</label><input required value="<?= e($_SESSION['user']['name']) ?>"></div>
<div><label>Email</label><input required type="email" value="<?= e($_SESSION['user']['email']) ?>"></div>
<div class="full"><label>Shipping address</label><textarea required name="address" rows="4"></textarea></div>
<div><label>City</label><input required></div><div><label>Postal code</label><input required></div>
<div class="full"><button class="btn btn-primary">Place order</button></div>
</div></form></div></section>
<?php require __DIR__.'/includes/footer.php'; ?>
