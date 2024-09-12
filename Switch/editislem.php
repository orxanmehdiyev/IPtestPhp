<?php 
require_once "../Setting/baglan.php";
require_once "../Setting/function.php";
if (isset($_POST['Deyer'])) {    
	$deyer = json_decode($_POST['Deyer'], true);
	$ID = $deyer['ID'];
	$IstifadeMeksediID = $deyer['IstifadeMeksediID'];
	$IdareAD = $deyer['IdareAD'];
	$BagliCihazinYeri = $deyer['BagliCihazinYeri'];
	$BagliCihazinMarkasi = $deyer['BagliCihazinMarkasi'];
	$BagliCihazinModeli = $deyer['BagliCihazinModeli'];
	$BagliCihazinAdi = $deyer['BagliCihazinAdi'];
	$BagliCihazinPortSayi = ($deyer['BagliCihazinPortSayi'] > 0) ? $deyer['BagliCihazinPortSayi'] : NULL;
	$SubnetMask = $deyer['SubnetMask'];
	$DefaultGateway = $deyer['DefaultGateway'];    
	$UserName = $deyer['UserName'];    
	$IstifadeyeVerildiyiTarix = ($deyer['IstifadeyeVerildiyiTarix'] > 0) ? $deyer['IstifadeyeVerildiyiTarix'] : NULL;
	$Qeyd = $deyer['Qeyd'];

	$kaydet = $db->prepare("UPDATE ip SET 
		IstifadeMeksediID = :IstifadeMeksediID,
		IdareAD = :IdareAD,
		BagliCihazinYeri = :BagliCihazinYeri,
		BagliCihazinMarkasi = :BagliCihazinMarkasi,
		BagliCihazinModeli = :BagliCihazinModeli,
		BagliCihazinAdi = :BagliCihazinAdi,
		BagliCihazinPortSayi = :BagliCihazinPortSayi,
		SubnetMask = :SubnetMask,
		DefaultGateway = :DefaultGateway,
		UserName = :UserName,
		IstifadeyeVerildiyiTarix = :IstifadeyeVerildiyiTarix,
		Qeyd = :Qeyd
		WHERE ID = $ID");
	$update = $kaydet->execute(array(
		'IstifadeMeksediID' => $IstifadeMeksediID,
		'IdareAD' => $IdareAD,
		'BagliCihazinYeri' => $BagliCihazinYeri,
		'BagliCihazinMarkasi' => $BagliCihazinMarkasi,
		'BagliCihazinModeli' => $BagliCihazinModeli,
		'BagliCihazinAdi' => $BagliCihazinAdi,
		'BagliCihazinPortSayi' => $BagliCihazinPortSayi,
		'SubnetMask' => $SubnetMask,
		'DefaultGateway' => $DefaultGateway,
		'UserName' => $UserName,
		'IstifadeyeVerildiyiTarix' => $IstifadeyeVerildiyiTarix,
		'Qeyd' => $Qeyd,
	));
	if ($update) {
		$stmt = $db->prepare("SELECT
		ip.ID                                 AS IP_ID,
		ip.IP                                 AS IP_IP,    
		ip.IstifadeMeksediID                  AS IP_IstifadeMeksediID,
		ip.IdareAD                            AS IP_IdareAD,
		ip.BagliCihazinYeri                   AS IP_BagliCihazinYeri,
		ip.BagliCihazinMarkasi                AS IP_BagliCihazinMarkasi,
		ip.BagliCihazinModeli                 AS IP_BagliCihazinModeli,
		ip.BagliCihazinMacAdresi              AS IP_BagliCihazinMacAdresi,
		ip.BagliCihazinAdi                    AS IP_BagliCihazinAdi,
		ip.BagliCihazinPortSayi               AS IP_BagliCihazinPortSayi,
		ip.SubnetMask                         AS IP_SubnetMask,
		ip.DefaultGateway                     AS IP_DefaultGateway,
		ip.IstifadeyeVerildiyiTarix           AS IstifadeyeVerildiyiTarix,
		ip.Qeyd                               AS IP_Qeyd,
		ip.Status                             AS Status,
		ip.SonCavabTarixi                     AS SonCavabTarixi,
		ip.UserName                           AS UserName,
		istifademeksedi.IstifadeMeksediID     AS istifademeksedi_IstifadeMeksediID,
		istifademeksedi.ItifadeYeriAd         AS istifademeksedi_ItifadeYeriAd
		FROM ip
		LEFT JOIN istifademeksedi ON ip.IstifadeMeksediID = istifademeksedi.IstifadeMeksediID
		WHERE ip.ID = :IP_ID");
		$stmt->execute(array('IP_ID' => $ID));
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
			'BagliCihazinYeri' => $Cek['IP_BagliCihazinYeri'],
			'BagliCihazinMarkasi' => $Cek['IP_BagliCihazinMarkasi'],
			'BagliCihazinModeli' => $Cek['IP_BagliCihazinModeli'],
			'BagliCihazinMacAdresi' => $Cek['IP_BagliCihazinMacAdresi'],
			'BagliCihazinAdi' => $Cek['IP_BagliCihazinAdi'],
			'BagliCihazinPortSayi' => ($Cek['IP_BagliCihazinPortSayi'] > 0) ? $Cek['IP_BagliCihazinPortSayi'] : "",
			'SubnetMask' => $Cek['IP_SubnetMask'],
			'DefaultGateway' => $Cek['IP_DefaultGateway'],
			'UserName' => $Cek['UserName'],
			'IstifadeyeVerildiyiTarix' => $IstifadeteVerlidiyiTarix,
			'Qeyd' => $Cek['IP_Qeyd']
		));
	} else {
		echo json_encode(array('status' => 'error', 'message' => 'Update failed'));
	}

} else {
	echo json_encode(array('status' => 'error', 'message' => 'Invalid request'));
}
?>
