<?php 
require_once "Setting/baglan.php"; 
require_once "Setting/function.php";
if (empty($_SESSION['admin'])) {
	header("Location:login.php");
	exit();
} 
?>
<!DOCTYPE html >
<html lang="AZ">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Ip Yoxlanış</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/modal.css">
	<!--<link href="img/favicon.ico" type="image/ico" rel="shortcut icon">	-->
	<script src="js/jquery36.js"></script> 
	<script src="js/script.js" ></script>
</head>
<body id="body">
	<nav>
		<ul>				
			<li><a href="index.php">Ana Səhifə</a></li>	
			<li><a href="kamera.php">Kamera</a></li>
			<li><a href="trskamera.php">TRS Kamera</a></li>
			<li><a href="kamerapc.php">Kamera-PC</a></li>	
			<li><a href="tibbo.php">TİBBO</a></li>	
			<li><a href="switch.php">Switch</a></li>
			<li><a href="server.php">Server</a></li>	
			<li><a href="pc.php">PC</a></li>				
			<li><a href="kamera.php">X-Ray Kamera</a></li>
			<li><a href="beyannemekosku.php">Bəyannamə Köşkü</a></li>
			<li><a href="melumatlovhesi.php">Məlumat Lövhəsi</a></li>
			<li><a href="nvr.php">NVR</a></li>
			<li><a href="terezi.php">Tərəzi</a></li>
			<li><a href="isareedicimonitor.php">İşarə Ediçi Monitor</a></li>
		</ul>
	</nav>
	<div class="yenibuttoalani">
		<div class="axtaralani">
			<input class="senednomresiinput" type="" id="Axtar_IPB" name="" placeholder="000.000.000.000">
			<input class="senednomresiinput" type="" id="Axtar_IPS" name="" placeholder="000.000.000.000">
			<button class="axtarbodalbuttonu" id="axtarbodalbuttonu" onclick="Axtar()">Axtar</button>
		</div>
	</div>
	<?php require_once "_modal.php"; ?>