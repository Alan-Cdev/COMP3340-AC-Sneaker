<?php
require_once __DIR__.'/config/config.php';
require_once __DIR__.'/includes/functions.php';
$allowed=['modern','midnight','sunset'];$theme=$_GET['set']??'modern';
if(in_array($theme,$allowed,true))$_SESSION['theme']=$theme;
redirect($_SERVER['HTTP_REFERER']??'/index.php');
