<?php 
require_once "Setting/baglan.php";
require_once "Setting/function.php";
$Sor=$db->prepare("SELECT * FROM ip");
$Sor->execute();
while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
	$ID=$Cek['ID'];
	$IP=$Cek['IP'];
	$SonCavabTarixi="Null";

	$IpNoktesiz=ReqemlerXaricButunKarakterleriSil($Cek['IP']);

	$kaydet=$db->prepare("UPDATE ip SET 
		SonCavabTarixi=:SonCavabTarixi
		WHERE ID=$ID");
	$update=$kaydet->execute(array(
		'SonCavabTarixi'        => $SonCavabTarixi
	));
	if ($update) {
		echo "sdfsdf";
	}
}


?>
