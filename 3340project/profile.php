<?php
$pageTitle='Profile';require_once __DIR__.'/config/database.php';require_once __DIR__.'/includes/functions.php';requireLogin();
if($_SERVER['REQUEST_METHOD']==='POST'){$name=trim($_POST['name']??'');if($name){$stmt=$pdo->prepare("UPDATE users SET name=? WHERE id=?");$stmt->execute([$name,$_SESSION['user']['id']]);$_SESSION['user']['name']=$name;$_SESSION['flash']='Profile updated.';redirect('/profile.php');}}
require __DIR__.'/includes/header.php';
?>
<section class="section"><div class="container"><h1>Your profile</h1><form class="form-card" method="post"><label>Name</label><input name="name" value="<?=e($_SESSION['user']['name'])?>" required><label>Email</label><input value="<?=e($_SESSION['user']['email'])?>" disabled><br><button class="btn btn-primary">Save changes</button></form></div></section>
<?php require __DIR__.'/includes/footer.php'; ?>
