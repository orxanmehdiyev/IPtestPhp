<?php 
require_once "../Setting/baglan.php";
require_once "../Setting/function.php";
if (isset($_POST['yelile'])) {
	$ID                              =  $_POST['ID'];
	$ip                              =  $_POST['ip'];
	$IstifadeMeksediID               =  $_POST['IstifadeMeksediID'];
	$IdareAD                         =  $_POST['IdareAD'];
	$BagliCihazinYeri                =  $_POST['BagliCihazinYeri'];
	$BagliCihazinMarkasi             =  $_POST['BagliCihazinMarkasi'];
	$BagliCihazinModeli              =  $_POST['BagliCihazinModeli'];
	$BagliCihazinMacAdresi           =  $_POST['BagliCihazinMacAdresi'];
	$SubnetMask                      =  $_POST['SubnetMask'];
	$DefaultGateway                  =  $_POST['DefaultGateway'];		
	$IstifadeyeVerildiyiTarix        =  ($_POST['IstifadeyeVerildiyiTarix']>0)?$_POST['IstifadeyeVerildiyiTarix']:NULL;
	$Qeyd                            =  $_POST['Qeyd'];

	$kaydet=$db->prepare("UPDATE ip SET 
		IstifadeMeksediID           =:IstifadeMeksediID,
		IdareAD                     =:IdareAD,
		BagliCihazinYeri            =:BagliCihazinYeri,
		BagliCihazinMarkasi         =:BagliCihazinMarkasi,
		BagliCihazinModeli          =:BagliCihazinModeli,
		BagliCihazinMacAdresi       =:BagliCihazinMacAdresi,
		SubnetMask                  =:SubnetMask,
		DefaultGateway              =:DefaultGateway,
		IstifadeyeVerildiyiTarix    =:IstifadeyeVerildiyiTarix,		
		Qeyd                        =:Qeyd
		WHERE ID=$ID");
	$update=$kaydet->execute(array(
		'IstifadeMeksediID'         => $IstifadeMeksediID,
		'IdareAD'                   => $IdareAD,		
		'BagliCihazinYeri'          => $BagliCihazinYeri,		
		'BagliCihazinMarkasi'       => $BagliCihazinMarkasi,
		'BagliCihazinModeli'        => $BagliCihazinModeli,
		'BagliCihazinMacAdresi'     => $BagliCihazinMacAdresi,
		'SubnetMask'                => $SubnetMask,
		'DefaultGateway'            => $DefaultGateway,	
		'IstifadeyeVerildiyiTarix'  => $IstifadeyeVerildiyiTarix,
		'Qeyd'                      => $Qeyd
	));
	if ($update) {
		header("Location:../nvr.php?edtip=$ip&durum=ok");
	}else{
		header("Location:../nvr.php?ip=$ip&durum=no");
	}
}
?>