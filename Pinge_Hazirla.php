<?php 
require_once "Setting/baglan.php";
$Sor=$db->prepare("SELECT * FROM ip");
$Sor->execute();
$doplamdeyer=0;
while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
	$ip=$Cek['IP'];
	$IP_ID=$Cek['ID'];
	$PingHazirSor=$db->prepare("SELECT * FROM pingatilacaqipler");
	$PingHazirSor->execute(array(
		'Ping_Atilacaq_IP'=>$ip));
	$Say           = $PingHazirSor->rowCount();

	if ($Say==0) {
		$doplamdeyer++;
		$Elave_Et = $db->prepare("INSERT INTO pingatilacaqipler SET                               
			Ping_Atilacaq_IP=:Ping_Atilacaq_IP,
			IP_ID=:IP_ID
			");
		$Insert   = $Elave_Et->execute(
			array(
				'Ping_Atilacaq_IP'        => $ip,
				'IP_ID'        => $IP_ID
			)
		);
	}
}
if ($doplamdeyer>0) {
	$CronSor=$db->prepare("SELECT * FROM cronlar where CronID=:CronID");
	$CronSor->execute(array(
		'CronID'=>1));
	$CronCek=$CronSor->fetch(PDO::FETCH_ASSOC);
	$CronIslemeSayi=$CronCek['CronIslemeSayi']+1;
	$Elave_Et=$db->prepare("UPDATE  cronlar SET                               
		CronIslemeSayi=:CronIslemeSayi
		where CronID=1
		");
	$Insert=$Elave_Et->execute(array(                                
		'CronIslemeSayi'=>$CronIslemeSayi
	));
}

?>