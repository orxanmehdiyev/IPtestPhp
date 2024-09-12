<?php 
require_once "Setting/baglan.php"; 
require_once "Setting/function.php"; 

$ip="172.24.20.";

for ($i=1; $i < 255 ; $i++) { 
	$ipp=$ip.$i;
	$SubnetMask="255.255.254.0";
	$DefaultGateway="172.24.20.1";
	$UserName="admin";
	$Qeyd="Kamera ";
	$Elave_Et = $db->prepare("INSERT INTO ip SET                               
		IP=:IP,
		IstifadeMeksediID=:IstifadeMeksediID,
		SubnetMask=:SubnetMask,
		DefaultGateway=:DefaultGateway,
		UserName=:UserName,
		Qeyd=:Qeyd
		");
	$Insert   = $Elave_Et->execute(
		array(
			'IP'        => $ipp,
			'IstifadeMeksediID'        => 3,
			'SubnetMask'        => $SubnetMask,
			'DefaultGateway'        => $DefaultGateway,
			'UserName'        => $UserName,
			'Qeyd'        => $Qeyd
		)
	);
}


?>
