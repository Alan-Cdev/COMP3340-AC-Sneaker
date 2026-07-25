<?php
$pageTitle='Product Form';require_once __DIR__.'/../config/database.php';require_once __DIR__.'/../includes/functions.php';requireAdmin();
$id=filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);$product=['name'=>'','category'=>'','description'=>'','price'=>'','colors'=>'','sizes'=>'','image'=>'assets/images/products/product-01.svg'];
if($id){$stmt=$pdo->prepare("SELECT * FROM products WHERE id=?");$stmt->execute([$id]);$product=$stmt->fetch()?:$product;}
if($_SERVER['REQUEST_METHOD']==='POST'){
 $data=[trim($_POST['name']),trim($_POST['category']),trim($_POST['description']),(float)$_POST['price'],trim($_POST['colors']),trim($_POST['sizes']),trim($_POST['image'])];
 if($id){$stmt=$pdo->prepare("UPDATE products SET name=?,category=?,description=?,price=?,colors=?,sizes=?,image=? WHERE id=?");$stmt->execute([...$data,$id]);}
 else{$stmt=$pdo->prepare("INSERT INTO products(name,category,description,price,colors,sizes,image) VALUES(?,?,?,?,?,?,?)");$stmt->execute($data);}
 $_SESSION['flash']='Product saved.';redirect('/admin/products.php');
}
require __DIR__.'/../includes/header.php';
?><section class="section"><div class="container"><h1><?= $id?'Edit':'Add'?> product</h1><?php require __DIR__.'/_nav.php';?><form class="form-card" method="post">
<label>Name</label><input name="name" value="<?=e($product['name'])?>" required><label>Category</label><input name="category" value="<?=e($product['category'])?>" required>
<label>Description</label><textarea name="description" required><?=e($product['description'])?></textarea><label>Price</label><input type="number" step=".01" name="price" value="<?=e((string)$product['price'])?>" required>
<label>Colors (use | separator)</label><input name="colors" value="<?=e($product['colors'])?>" required><label>Sizes (use | separator)</label><input name="sizes" value="<?=e($product['sizes'])?>" required>
<label>Image path</label><input name="image" value="<?=e($product['image'])?>" required><br><button class="btn btn-primary">Save product</button></form></div></section><?php require __DIR__.'/../includes/footer.php'; ?>
