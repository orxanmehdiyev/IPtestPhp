<?php 
require_once "Setting/baglan.php";
if (isset($_POST['yelile'])) {	

	$ID=$_POST['ID'];
	$ip=$_POST['ip'];
	$IstifadeMeksediID=$_POST['IstifadeMeksediID'];
	$IdareAD=$_POST['IdareAD'];
	$BagliCihazinYeri=$_POST['BagliCihazinYeri'];
	$BagliCihazinMarkasi=$_POST['BagliCihazinMarkasi'];
	$BagliCihazinModeli=$_POST['BagliCihazinModeli'];
	$BagliCihazinMacAdresi=$_POST['BagliCihazinMacAdresi'];
	$BagliCihazinAdi=$_POST['BagliCihazinAdi'];
	$BagliCihazinPortSayi=$_POST['BagliCihazinPortSayi'];
	$SubnetMask=$_POST['SubnetMask'];
	$DefaultGateway=$_POST['DefaultGateway'];
	$NVR=$_POST['NVR'];
	$NVR_Status=$_POST['NVR_Status'];
	$AlarmStatusu=$_POST['AlarmStatusu'];
	$Alarm=$_POST['Alarm'];
	$MulticastIpBir=$_POST['MulticastIpBir'];
	$MulticastPortBir=$_POST['MulticastPortBir'];
	$MulticastIpIki=$_POST['MulticastIpIki'];
	$MulticastPortIki=$_POST['MulticastPortIki'];
	$UserName=$_POST['UserName'];
	$RAM=$_POST['RAM'];
	$DiskHecmi=$_POST['DiskHecmi'];
	$Processor=$_POST['Processor'];
	$IstifadeyeVerildiyiTarix=($_POST['IstifadeyeVerildiyiTarix']>0)?$_POST['IstifadeyeVerildiyiTarix']:NULL;
	$KameraTipi=$_POST['KameraTipi'];
	$Qeyd=$_POST['Qeyd'];


	$kaydet=$db->prepare("UPDATE ip SET 
		IstifadeMeksediID=:IstifadeMeksediID,
		IdareAD=:IdareAD,
		BagliCihazinYeri=:BagliCihazinYeri,
		BagliCihazinMarkasi=:BagliCihazinMarkasi,
		BagliCihazinModeli=:BagliCihazinModeli,
		BagliCihazinMacAdresi=:BagliCihazinMacAdresi,
		BagliCihazinAdi=:BagliCihazinAdi,
		BagliCihazinPortSayi=:BagliCihazinPortSayi,
		SubnetMask=:SubnetMask,
		DefaultGateway=:DefaultGateway,
		NVR=:NVR,
		NVR_Status=:NVR_Status,
		AlarmStatusu=:AlarmStatusu,
		Alarm=:Alarm,
		MulticastIpBir=:MulticastIpBir,
		MulticastPortBir=:MulticastPortBir,
		MulticastIpIki=:MulticastIpIki,
		MulticastPortIki=:MulticastPortIki,
		UserName=:UserName,
		RAM=:RAM,
		DiskHecmi=:DiskHecmi,
		Processor=:Processor,
		IstifadeyeVerildiyiTarix=:IstifadeyeVerildiyiTarix,
		KameraTipi=:KameraTipi,
		Qeyd=:Qeyd
		WHERE ID=$ID");
	$update=$kaydet->execute(array(
		'IstifadeMeksediID'        => $IstifadeMeksediID,
		'IdareAD'        => $IdareAD,
		'BagliCihazinYeri'        => $BagliCihazinYeri,
		'BagliCihazinMarkasi'        => $BagliCihazinMarkasi,
		'BagliCihazinModeli'        => $BagliCihazinModeli,
		'BagliCihazinMacAdresi'        => $BagliCihazinMacAdresi,
		'BagliCihazinAdi'        => $BagliCihazinAdi,
		'BagliCihazinPortSayi'        => $BagliCihazinPortSayi,
		'SubnetMask'        => $SubnetMask,
		'DefaultGateway'        => $DefaultGateway,
		'NVR'        => $NVR,
		'NVR_Status'        => $NVR_Status,
		'AlarmStatusu'        => $AlarmStatusu,
		'Alarm'        => $Alarm,
		'MulticastIpBir'        => $MulticastIpBir,
		'MulticastPortBir'        => $MulticastPortBir,
		'MulticastIpIki'        => $MulticastIpIki,
		'MulticastPortIki'        => $MulticastPortIki,
		'UserName'        => $UserName,
		'RAM'        => $RAM,
		'DiskHecmi'        => $DiskHecmi,
		'Processor'        => $Processor,
		'IstifadeyeVerildiyiTarix'        => $IstifadeyeVerildiyiTarix,
		'KameraTipi'        => $KameraTipi,
		'Qeyd'        => $Qeyd
	));
	if ($update) {
		header("Location:edittesdiq.php?ip=$ip&durum=ok");
	}else{
		header("Location:edit.php?ip=$ip&durum=no");
	}
}
?>