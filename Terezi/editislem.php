<?php 
require_once "../Setting/baglan.php";
require_once "../Setting/function.php";
if (isset($_POST['yelile'])) {
	$ID                              =  $_POST['ID'];
	$ip                              =  $_POST['ip'];
	$IstifadeMeksediID               =  $_POST['IstifadeMeksediID'];
	$IdareAD                         =  $_POST['IdareAD'];
	$BagliCihazinYeri                =  $_POST['BagliCihazinYeri'];
	$SubnetMask                      =  $_POST['SubnetMask'];
	$DefaultGateway                  =  $_POST['DefaultGateway'];
	$RAM                             =  (ReqemlerXaricButunKarakterleriSil($_POST['RAM'])>0)?ReqemlerXaricButunKarakterleriSil($_POST['RAM']):NULL;
	$DiskHecmi                       =  (ReqemlerXaricButunKarakterleriSil($_POST['DiskHecmi'])>0)?ReqemlerXaricButunKarakterleriSil($_POST['DiskHecmi']):NULL;
	$Disk_Tipi                       =  $_POST['Disk_Tipi'];
	$Processor                       =  $_POST['Processor'];
	$IstifadeyeVerildiyiTarix        =  (ReqemlerXaricButunKarakterleriSil($_POST['IstifadeyeVerildiyiTarix'])>0)?$_POST['IstifadeyeVerildiyiTarix']:NULL;
	$Qeyd                            =  $_POST['Qeyd'];

	$kaydet=$db->prepare("UPDATE ip SET 
		IstifadeMeksediID           =:IstifadeMeksediID,
		IdareAD                     =:IdareAD,
		BagliCihazinYeri            =:BagliCihazinYeri,
		SubnetMask                  =:SubnetMask,
		DefaultGateway              =:DefaultGateway,
		RAM                         =:RAM,
		DiskHecmi                   =:DiskHecmi,
		Disk_Tipi                   =:Disk_Tipi,
		Processor                   =:Processor,
		IstifadeyeVerildiyiTarix    =:IstifadeyeVerildiyiTarix,		
		Qeyd                        =:Qeyd
		WHERE ID=$ID");
	$update=$kaydet->execute(array(
		'IstifadeMeksediID'         => $IstifadeMeksediID,
		'IdareAD'                   => $IdareAD,		
		'BagliCihazinYeri'          => $BagliCihazinYeri,
		'SubnetMask'                => $SubnetMask,
		'DefaultGateway'            => $DefaultGateway,
		'RAM'                       => $RAM,
		'DiskHecmi'                 => $DiskHecmi,
		'Disk_Tipi'                 => $Disk_Tipi,
		'Processor'                 => $Processor,		
		'IstifadeyeVerildiyiTarix'  => $IstifadeyeVerildiyiTarix,
		'Qeyd'                      => $Qeyd
	));
	if ($update) {
		header("Location:../terezi.php?edtip=$ip&durum=ok");
	}else{
		header("Location:../terezi.php?ip=$ip&durum=no");
	}
}
?>