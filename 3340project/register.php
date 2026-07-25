<?php
$pageTitle='Register';
require_once __DIR__.'/config/database.php';
require_once __DIR__.'/includes/functions.php';
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $name=trim($_POST['name']??''); $email=filter_var($_POST['email']??'',FILTER_VALIDATE_EMAIL); $password=$_POST['password']??'';
 if(!$name||!$email||strlen($password)<8){$error='Enter a valid name, email, and password of at least 8 characters.';}
 else{
  try{$stmt=$pdo->prepare("INSERT INTO users(name,email,password_hash) VALUES(?,?,?)");$stmt->execute([$name,$email,password_hash($password,PASSWORD_DEFAULT)]);$_SESSION['flash']='Registration complete. Please log in.';redirect('/login.php');}
  catch(PDOException $e){$error='This email is already registered.';}
 }
}
require __DIR__.'/includes/header.php';
?>
<section class="section"><div class="container"><h1>Create an account</h1><?php if($error):?><div class="alert"><?=e($error)?></div><?php endif;?>
<form class="form-card" method="post"><label>Name</label><input name="name" required><label>Email</label><input name="email" type="email" required><label>Password</label><input name="password" type="password" minlength="8" required><br><button class="btn btn-primary">Register</button></form>
</div></section><?php require __DIR__.'/includes/footer.php'; ?>
