<?php
$pageTitle='Login';
require_once __DIR__.'/config/database.php';
require_once __DIR__.'/includes/functions.php';
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $email=filter_var($_POST['email']??'',FILTER_VALIDATE_EMAIL);$password=$_POST['password']??'';
 $stmt=$pdo->prepare("SELECT * FROM users WHERE email=?");$stmt->execute([$email]);$user=$stmt->fetch();
 if($user && $user['status']==='active' && password_verify($password,$user['password_hash'])){
  $_SESSION['user']=['id'=>$user['id'],'name'=>$user['name'],'email'=>$user['email'],'role'=>$user['role']];redirect('/dashboard.php');
 } else {$error='Invalid login or disabled account.';}
}
require __DIR__.'/includes/header.php';
?>
<section class="section"><div class="container"><h1>Login</h1><?php if($error):?><div class="alert"><?=e($error)?></div><?php endif;?>
<form class="form-card" method="post"><label>Email</label><input name="email" type="email" required><label>Password</label><input name="password" type="password" required><br><button class="btn btn-primary">Login</button></form>
<p class="muted">Demo password for both sample accounts: password</p><p><a href="<?=BASE_URL?>/register.php">Create an account</a></p>
</div></section><?php require __DIR__.'/includes/footer.php'; ?>
