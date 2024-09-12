<?php 
require_once "Setting/baglan.php";
$PingHazirSor=$db->prepare("SELECT * FROM pingatilacaqipler");
$PingHazirSor->execute();
$Say           = $PingHazirSor->rowCount();

if ($Say==0) {
	$Sor=$db->prepare("SELECT * FROM ip");
	$Sor->execute();
	$doplamdeyer=0;
	while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
		$ip=$Cek['IP'];
		$IP_ID=$Cek['ID'];
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
}


$Sor=$db->prepare("SELECT * FROM pingatilacaqipler order by Pinga_Atilacaq_Id ASC LIMIT 1");
$Sor->execute();
$doplamdeyer=0;
$Statusu=0;
while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {	
	require_once "Setting/function.php";
	unset ($output);
	$ip=$Cek['Ping_Atilacaq_IP'];
	$IP_ID=$Cek['IP_ID'];
	$Pinga_Atilacaq_Id=$Cek['Pinga_Atilacaq_Id'];

	$sil = $db->prepare("DELETE from pingatilacaqipler where Pinga_Atilacaq_Id=:Pinga_Atilacaq_Id");
	$kontrol = $sil->execute(array(
		'Pinga_Atilacaq_Id' => $Pinga_Atilacaq_Id
	));

	exec("ping -n 1 $ip", $output);
	$bir=explode(" ", $output[2]) ;
	$iki= rtrim($bir[2],":");
	if ($iki==$ip) {
		$Statusu=1;
	}else{
		$Statusu=0;
	}
	$BagliCihazinMacAdresi = MacAddress($ip);
	$Elave_Et = $db->prepare("INSERT INTO ping SET                               
		IP=:IP,
		PingTarix=:PingTarix,
		Statusu=:Statusu
		");
	$Insert   = $Elave_Et->execute(
		array(
			'IP'        => $ip,
			'PingTarix'        => $TarixSaat,
			'Statusu'        => $Statusu
		)
	);

echo $macuzunluq=strlen($BagliCihazinMacAdresi);
	if ($Statusu==1) {
		if ($Insert) {
			$kaydet=$db->prepare("UPDATE ip SET 
				SonCavabTarixi=:SonCavabTarixi,
				Status=:Status,
				BagliCihazinMacAdresi=:BagliCihazinMacAdresi
				WHERE ID=$IP_ID");
			$update=$kaydet->execute(array(
				'SonCavabTarixi'        => $TarixSaat,
				'Status'        => 1,
				'BagliCihazinMacAdresi'        => $BagliCihazinMacAdresi
			));
		}
	}else{
		$kaydet=$db->prepare("UPDATE ip SET 			
			Status=:Status
			WHERE ID=$IP_ID");
		$update=$kaydet->execute(array(
			'Status'        => 0
		));
	}

	$NameAndGroup = NameAndGroup($ip);
	$deyerAdveGroup=count($NameAndGroup);
	if($deyerAdveGroup>0 && $Statusu==1){
		$kaydet=$db->prepare("UPDATE ip SET 
			BagliCihazinAdi=:BagliCihazinAdi,
			BagliCihazinGroupu=:BagliCihazinGroupu
			WHERE ID=$IP_ID");
		$update=$kaydet->execute(array(
			'BagliCihazinAdi'        => $NameAndGroup[0],
			'BagliCihazinGroupu'        => $NameAndGroup[1]
		));
	}
}

?>