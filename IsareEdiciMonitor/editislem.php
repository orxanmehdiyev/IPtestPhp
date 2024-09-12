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
	$IstifadeyeVerildiyiTarix        =  (ReqemlerXaricButunKarakterleriSil($_POST['IstifadeyeVerildiyiTarix'])>0)?$_POST['IstifadeyeVerildiyiTarix']:NULL;
	$Qeyd                            =  $_POST['Qeyd'];

	$kaydet=$db->prepare("UPDATE ip SET 
		IstifadeMeksediID           =:IstifadeMeksediID,
		IdareAD                     =:IdareAD,
		BagliCihazinYeri            =:BagliCihazinYeri,
		SubnetMask                  =:SubnetMask,
		DefaultGateway              =:DefaultGateway,		
		IstifadeyeVerildiyiTarix    =:IstifadeyeVerildiyiTarix,		
		Qeyd                        =:Qeyd
		WHERE ID=$ID");
	$update=$kaydet->execute(array(
		'IstifadeMeksediID'         => $IstifadeMeksediID,
		'IdareAD'                   => $IdareAD,		
		'BagliCihazinYeri'          => $BagliCihazinYeri,
		'SubnetMask'                => $SubnetMask,
		'DefaultGateway'            => $DefaultGateway,		
		'IstifadeyeVerildiyiTarix'  => $IstifadeyeVerildiyiTarix,
		'Qeyd'                      => $Qeyd
	));
	if ($update) {
		header("Location:../isareedicimonitor.php?edtip=$ip&durum=ok");
	}else{
		header("Location:../isareedicimonitor.php?ip=$ip&durum=no");
	}
}
?>