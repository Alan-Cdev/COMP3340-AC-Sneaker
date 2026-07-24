<?php
$pageTitle='Service Request';require_once __DIR__.'/config/database.php';require_once __DIR__.'/includes/functions.php';requireLogin();
if($_SERVER['REQUEST_METHOD']==='POST'){$subject=trim($_POST['subject']??'');$message=trim($_POST['message']??'');if($subject&&$message){$stmt=$pdo->prepare("INSERT INTO service_requests(user_id,subject,message) VALUES(?,?,?)");$stmt->execute([$_SESSION['user']['id'],$subject,$message]);$_SESSION['flash']='Request submitted.';redirect('/service_history.php');}}
require __DIR__.'/includes/header.php';
?>
<section class="section"><div class="container"><h1>Ask AC Sneaker support</h1><form class="form-card" method="post"><label>Subject</label><input name="subject" required><label>Message</label><textarea name="message" rows="7" required></textarea><br><button class="btn btn-primary">Submit request</button></form><p><a href="<?=BASE_URL?>/help/support.php">Context help: submitting a request</a></p></div></section>
<?php require __DIR__.'/includes/footer.php'; ?>
