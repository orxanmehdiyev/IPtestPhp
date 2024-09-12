<?php 
require_once "../Setting/baglan.php";
if (isset($_POST['daxiOl'])) {
	$user_name=$_POST['user_name'];
	$user_pass=$_POST['user_pass'];

	$admin           = $db->prepare("SELECT * FROM user where user_name=:user_name and user_pass=:user_pass");
	$admin->execute(array(
		'user_name'=>$user_name,
		'user_pass'=>$user_pass,
	));
	$Say           = $admin->rowCount();
	if ($Say==1) {
		$_SESSION['admin']="admin";
		header("Location:../index.php");
	}else{
		header("Location:../login.php?durum=no");
	}
}

?>