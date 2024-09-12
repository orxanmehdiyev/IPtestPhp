<?php 
require_once "Setting/baglan.php";
require_once "Setting/function.php";
$PingHazirSor=$db->prepare("SELECT * FROM pingatilacaqipler");
$PingHazirSor->execute();
$Say           = $PingHazirSor->rowCount();

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
}


$Sor=$db->prepare("SELECT * FROM pingatilacaqipler order by Pinga_Atilacaq_Id ASC limit 200");
$Sor->execute();

while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
	
	$TarixSaat=TarixSaat();
	$ip=$Cek['Ping_Atilacaq_IP'];
	$IP_ID=$Cek['IP_ID'];
	$Pinga_Atilacaq_Id=$Cek['Pinga_Atilacaq_Id'];

	$sil = $db->prepare("DELETE from pingatilacaqipler where Pinga_Atilacaq_Id=:Pinga_Atilacaq_Id");
	$kontrol = $sil->execute(array(
		'Pinga_Atilacaq_Id' => $Pinga_Atilacaq_Id
	));



	$Statusu =pingWithTimeout($ip);
	$BagliCihazinMacAdresi = MacAddress($ip);
	$PingSor = $db->prepare("SELECT IP, PingTarix, Statusu FROM ping WHERE IP = :IP AND PingTarix = :PingTarix AND Statusu = :Statusu");
	$PingSor->execute(array(
		'IP'=>$ip,
		'PingTarix'=>$TarixSaat,
		'Statusu'=>$Statusu
	)
);

	$PingSay           = $PingSor->rowCount();
	if ($PingSay==0) {
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
	}

	$NameAndGroup = NameAndGroup($ip);
	if ($Statusu==1) {
		if ($Insert) {
			$kaydet=$db->prepare("UPDATE ip SET 
				SonCavabTarixi=:SonCavabTarixi,
				Status=:Status,
				BagliCihazinMacAdresi=:BagliCihazinMacAdresi,
				BagliCihazinGroupu=:BagliCihazinGroupu
				WHERE ID=$IP_ID");
			$update=$kaydet->execute(array(
				'SonCavabTarixi'        => $TarixSaat,
				'Status'        => 1,
				'BagliCihazinMacAdresi'        => $BagliCihazinMacAdresi,
				'BagliCihazinGroupu'        => $NameAndGroup
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



	$PingSil=$db->prepare("SELECT * FROM ping where IP=:IP");
	$PingSil->execute(array(
		'IP'=>$ip
	)
);
	while($PingSilCek=$PingSil->fetch(PDO::FETCH_ASSOC)){
		$PingSilsay=TarixFerqiIl($PingSilCek['PingTarix'],$TarixSaat);
		if ($PingSilsay>=1) {
			$sil = $db->prepare("DELETE from ping where PingID=:PingID");
			$kontrol = $sil->execute(array(
				'PingID' => $PingSilCek['PingID']
			));
		}

	}


	$IpAndMacSor=$db->prepare("SELECT * FROM IpAndMac where IP=:IP and Mac=:Mac");
	$IpAndMacSor->execute(array(
		'IP'=>$ip,
		'Mac'=>$BagliCihazinMacAdresi
	)
);

	$IpAndMacSay           = $IpAndMacSor->rowCount();
	if ($IpAndMacSay==0 && strlen($BagliCihazinMacAdresi)>0) {
		$Elave_Etmac = $db->prepare("INSERT INTO IpAndMac SET                               
			IP            =:IP,
			MacDate       =:MacDate,
			Mac           =:Mac
			");
		$Inserts   = $Elave_Etmac->execute(
			array(
				'IP'          => $ip,
				'MacDate'     => $TarixSaat,
				'Mac'         => $BagliCihazinMacAdresi
			)
		);
	}	
}

	//$result = shell_exec("/bin/ping -c 1 $ip");

/*
	$bir=explode(" ", $result) ;
	$iki=rtrim(trim($bir[9]),":");
	if ($iki==$ip) {
		$Statusu=1;
	}else{
		$Statusu=0;
	}
*/

?>