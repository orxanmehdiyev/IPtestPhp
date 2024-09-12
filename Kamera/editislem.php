<?php 
require_once "../Setting/baglan.php";
require_once "../Setting/function.php";
if (isset($_POST['Deyer'])) {
	$deyer = json_decode($_POST['Deyer'], true);
	$ID                              =  $deyer['ID'];
	$IstifadeMeksediID               =  $deyer['IstifadeMeksediID'];	
	$IdareAD                         =  $deyer['IdareAD'];
	$BagliCihazinMarkasi             =  $deyer['BagliCihazinMarkasi'];	
	$BagliCihazinModeli              =  $deyer['BagliCihazinModeli'];
	$BagliCihazinAdi                 =  $deyer['BagliCihazinAdi'];	
	$SubnetMask                      =  $deyer['SubnetMask'];
	$DefaultGateway                  =  $deyer['DefaultGateway'];
	$NVR                             =  $deyer['NVR'];
	$AlarmStatusu                    =  (ReqemlerXaricButunKarakterleriSil($deyer['AlarmStatusu'])>0)?ReqemlerXaricButunKarakterleriSil($deyer['AlarmStatusu']):NULL;
	$Alarm                           =  (ReqemlerXaricButunKarakterleriSil($deyer['Alarm'])>0)?ReqemlerXaricButunKarakterleriSil($deyer['Alarm']):NULL;
	$MulticastIpBir                  =  trim($deyer['MulticastIpBir']);
	$MulticastPortBir                =  (ReqemlerXaricButunKarakterleriSil($deyer['MulticastPortBir'])>0)?ReqemlerXaricButunKarakterleriSil($deyer['MulticastPortBir']):NULL;
	$MulticastIpIki                  =  trim($deyer['MulticastIpIki']);
	$MulticastPortIki                =  (ReqemlerXaricButunKarakterleriSil($deyer['MulticastPortIki'])>0)?ReqemlerXaricButunKarakterleriSil($deyer['MulticastPortIki']):NULL;	
	$IstifadeyeVerildiyiTarix        =  ($deyer['IstifadeyeVerildiyiTarix']>0)?$deyer['IstifadeyeVerildiyiTarix']:NULL;
	$KameraTipi                      =  $deyer['KameraTipi'];
	$Qeyd                            =  $deyer['Qeyd'];

	if ($MulticastIpBir==$MulticastIpIki and $MulticastIpBir!="") {
		echo json_encode(array('status' => 'error', 'message' => 'Yenilənmə uğursuz! Multicast IP-lər bərabərdir'));
		exit();
	}

	if ($MulticastPortBir==$MulticastPortIki and $MulticastPortIki!=NULL) {
		echo json_encode(array('status' => 'error', 'message' => 'Yenilənmə uğursuz! Multicast portlar bərabər ola bilməz'));
		exit();
	}

	$ToplamIPSor           = $db->prepare("SELECT * FROM ip where (Alarm=:Alarm or AlarmStatusu=:AlarmStatusu or MulticastIpBir=:MulticastIpBir or MulticastIpBir=:MulticastIpBiriki or MulticastIpIki=:MulticastIpIki or MulticastIpIki=:MulticastIpIkiBir or MulticastPortBir=:MulticastPortBir or MulticastPortBir=:MulticastPortBirIki     or MulticastPortIki=:MulticastPortIki or MulticastPortIki=:MulticastPortIkiBir) and ID<>:ID");
	$ToplamIPSor->execute(array(
		'Alarm'=>$Alarm,
		'AlarmStatusu'=>$AlarmStatusu,
		'MulticastIpBir'=>$MulticastIpBir,
		'MulticastIpBiriki'=>$MulticastIpIki,
		'MulticastIpIki'=>$MulticastIpIki,
		'MulticastIpIkiBir'=>$MulticastIpBir,
		'MulticastPortBir'=>$MulticastPortBir,
		'MulticastPortBirIki'=>$MulticastPortIki,
		'MulticastPortIki'=>$MulticastPortIki,
		'MulticastPortIkiBir'=>$MulticastPortBir,
		'ID'=>$ID
	));
	$ToplamSay           = $ToplamIPSor->rowCount();	

	if ($ToplamSay>0) {
		$IPCek = $ToplamIPSor->fetch(PDO::FETCH_ASSOC);
		$ipdeolan=$IPCek['IP'];
		if ($IPCek['Alarm']==$Alarm and $Alarm!=NULL) {
			echo json_encode(array('status' => 'error', 'message' => $ipdeolan.' alarm mövcutdur'));
			exit();
		}

		if ($IPCek['AlarmStatusu']==$AlarmStatusu and $AlarmStatusu!=NULL) {
			echo json_encode(array('status' => 'error', 'message' => $ipdeolan.' alarm status mövcutdur'));
			exit();
		}

		if ($IPCek['MulticastIpBir']==$MulticastIpBir and $MulticastIpBir!=NULL) {
			echo json_encode(array('status' => 'error', 'message' => $ipdeolan.' multicast IP bir mövcutdur'));
			exit();
		}

		if ($IPCek['MulticastIpIki']==$MulticastIpIki and $MulticastIpIki!=NULL) {
			echo json_encode(array('status' => 'error', 'message' => $ipdeolan.' multicast IP iki mövcutdur'));
			exit();
		}

		if ($IPCek['MulticastIpIki']==$MulticastIpBir and $MulticastIpBir!=NULL) {
			echo json_encode(array('status' => 'error', 'message' => $ipdeolan.' multicast IP bir Multicast IP ikidə var'));
			exit();
		}

		if ($IPCek['MulticastIpBir']==$MulticastIpIki and $MulticastIpIki!=NULL) {
			echo json_encode(array('status' => 'error', 'message' => $ipdeolan.' multicast IP iki Multicast IP birdə var'));
			exit();
		}

		if ($IPCek['MulticastPortBir']==$MulticastPortBir and $MulticastPortBir!=NULL) {
			echo json_encode(array('status' => 'error', 'message' => $ipdeolan.' multicast port bir mövcutdur'));
			exit();
		}

		if ($IPCek['MulticastPortIki']==$MulticastPortBir and $MulticastPortBir!=NULL) {
			echo json_encode(array('status' => 'error', 'message' => $ipdeolan.' multicast port bir multicast port ikidə var'));
			exit();
		}


		if ($IPCek['MulticastPortIki']==$MulticastPortIki and $MulticastPortIki!=NULL) {
			echo json_encode(array('status' => 'error', 'message' => $ipdeolan.' multicast port iki mövcutdur'));
			exit();
		}

		if ($IPCek['MulticastPortBir']==$MulticastPortIki and $MulticastPortIki!=NULL) {
			echo json_encode(array('status' => 'error', 'message' => $ipdeolan.' multicast port iki multicast port birdə var '));
			exit();
		}
		
		
	}

	$kaydet = $db->prepare("UPDATE ip SET 
		IstifadeMeksediID           =:IstifadeMeksediID,
		IdareAD                     =:IdareAD,
		BagliCihazinMarkasi         =:BagliCihazinMarkasi,
		BagliCihazinModeli          =:BagliCihazinModeli,
		BagliCihazinAdi             =:BagliCihazinAdi,		
		SubnetMask                  =:SubnetMask,
		DefaultGateway              =:DefaultGateway,
		NVR                         =:NVR,
		AlarmStatusu                =:AlarmStatusu,
		Alarm                       =:Alarm,
		MulticastIpBir              =:MulticastIpBir,
		MulticastPortBir            =:MulticastPortBir,
		MulticastIpIki              =:MulticastIpIki,
		MulticastPortIki            =:MulticastPortIki,		
		IstifadeyeVerildiyiTarix    =:IstifadeyeVerildiyiTarix,
		SonDuzelisTarixi            =:SonDuzelisTarixi,
		KameraTipi                  =:KameraTipi,
		Qeyd                        =:Qeyd
		WHERE ID = $ID");
	$update = $kaydet->execute(array(
		'IstifadeMeksediID'         => $IstifadeMeksediID,
		'IdareAD'                   => $IdareAD,		
		'BagliCihazinMarkasi'       => $BagliCihazinMarkasi,
		'BagliCihazinModeli'        => $BagliCihazinModeli,
		'BagliCihazinAdi'           => $BagliCihazinAdi,	
		'SubnetMask'                => $SubnetMask,
		'DefaultGateway'            => $DefaultGateway,
		'NVR'                       => $NVR,
		'AlarmStatusu'              => $AlarmStatusu,
		'Alarm'                     => $Alarm,
		'MulticastIpBir'            => $MulticastIpBir,
		'MulticastPortBir'          => $MulticastPortBir,
		'MulticastIpIki'            => $MulticastIpIki,
		'MulticastPortIki'          => $MulticastPortIki,		
		'IstifadeyeVerildiyiTarix'  => $IstifadeyeVerildiyiTarix,
		'SonDuzelisTarixi'          => $TarixSaat,
		'KameraTipi'                => $KameraTipi,
		'Qeyd'                      => $Qeyd
	));



	if ($update) {
		$stmt = $db->prepare("SELECT
			ip.ID                                   AS 		IP_ID,
			ip.IP                                   AS 		IP_IP,
			ip.IpNoktesiz                           AS 		IpNoktesiz,
			ip.IstifadeMeksediID                    AS 		IP_IstifadeMeksediID,
			ip.IdareAD                              AS 		IP_IdareAD,
			ip.BagliCihazinYeri                     AS 		IP_BagliCihazinYeri,
			ip.BagliCihazinMarkasi                  AS 		IP_BagliCihazinMarkasi,
			ip.BagliCihazinModeli                   AS 		IP_BagliCihazinModeli,
			ip.BagliCihazinMacAdresi                AS 		IP_BagliCihazinMacAdresi,
			ip.BagliCihazinAdi                      AS 		IP_BagliCihazinAdi,		
			ip.SubnetMask                           AS 		IP_SubnetMask,
			ip.DefaultGateway                       AS 		IP_DefaultGateway,
			ip.NVR                                  AS 		IP_NVR,		
			ip.AlarmStatusu                         AS 		IP_AlarmStatusu,
			ip.Alarm                                AS 		IP_Alarm,
			ip.MulticastIpBir                       AS 		IP_MulticastIpBir,
			ip.MulticastPortBir                     AS 		IP_MulticastPortBir,
			ip.MulticastIpIki                       AS 		IP_MulticastIpIki,
			ip.MulticastPortIki                     AS 		IP_MulticastPortIki,
			ip.IstifadeyeVerildiyiTarix             AS 		IstifadeyeVerildiyiTarix,
			ip.KameraTipi                           AS 		KameraTipi,
			ip.Qeyd                                 AS 		IP_Qeyd,
			ip.Status                               AS 		Status,
			ip.SonCavabTarixi                       AS 		SonCavabTarixi,
			ip.SonDuzelisTarixi                     AS 		SonDuzelisTarixi,
			istifademeksedi.IstifadeMeksediID       AS 		istifademeksedi_IstifadeMeksediID,
			istifademeksedi.ItifadeYeriAd           AS 		istifademeksedi_ItifadeYeriAd
			FROM ip
			LEFT JOIN istifademeksedi ON ip.IstifadeMeksediID = istifademeksedi.IstifadeMeksediID
			WHERE ip.ID = :ID");
		$stmt->execute(array('ID' => $ID));
		$Cek = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($Cek['Status'] == 1) {
			$Status = "A";                        
		} else {
			$Status = "P";                        
		}

		if ($Cek['IstifadeyeVerildiyiTarix'] > 0) {
			$IstifadeteVerlidiyiTarix = TarixAz($Cek['IstifadeyeVerildiyiTarix']);
		} else {
			$IstifadeteVerlidiyiTarix = "";
		}

		echo json_encode(array(
			'IP_ID' => $Cek['IP_ID'],						
			'IP_IP' => $Cek['IP_IP'],			
			'Status' => $Status,			
			'SonCavabTarixi' => TarixSaatAz($Cek['SonCavabTarixi']),			
			'IstifadeYeriAd' => $Cek['istifademeksedi_ItifadeYeriAd'],			
			'IdareAD' => $Cek['IP_IdareAD'],			
			'BagliCihazinMarkasi' => $Cek['IP_BagliCihazinMarkasi'],			
			'BagliCihazinModeli' => $Cek['IP_BagliCihazinModeli'],			
			'BagliCihazinMacAdresi' => $Cek['IP_BagliCihazinMacAdresi'],			
			'BagliCihazinAdi' => $Cek['IP_BagliCihazinAdi'],			
			'KameraTipi' => ($Cek['KameraTipi'] == 1) ? "Hərəkətli" : (($Cek['KameraTipi'] == 2) ? "Sabit" : ""),			
			'SubnetMask' => $Cek['IP_SubnetMask'],			
			'DefaultGateway' => $Cek['IP_DefaultGateway'],			
			'IP_NVR' => $Cek['IP_NVR'],			
			'IP_AlarmStatusu' => $Cek['IP_AlarmStatusu'],			
			'IP_Alarm' => $Cek['IP_Alarm'],			
			'IP_MulticastIpBir' => $Cek['IP_MulticastIpBir'],			
			'IP_MulticastPortBir' => $Cek['IP_MulticastPortBir'],			
			'IP_MulticastIpIki' => $Cek['IP_MulticastIpIki'],			
			'IP_MulticastPortIki' => $Cek['IP_MulticastPortIki'],						
			'IstifadeyeVerildiyiTarix' => $IstifadeteVerlidiyiTarix,
			'SonDuzelisTarixi' => $Cek['SonDuzelisTarixi'],
			'Qeyd' => $Cek['IP_Qeyd']
		));
	}else{
		echo json_encode(array('status' => 'error', 'message' => 'Invalid request'));
	}
}
?>