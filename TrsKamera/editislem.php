<?php 
require_once "../Setting/baglan.php";
require_once "../Setting/function.php";
if (isset($_POST['yelile'])) {
	$ID                              =  $_POST['ID'];
	$ip                              =  $_POST['ip'];
	$IstifadeMeksediID               =  $_POST['IstifadeMeksediID'];
	$IdareAD                         =  $_POST['IdareAD'];
	$BagliCihazinMarkasi             =  $_POST['BagliCihazinMarkasi'];
	$BagliCihazinModeli              =  $_POST['BagliCihazinModeli'];
	$BagliCihazinMacAdresi           =  $_POST['BagliCihazinMacAdresi'];
	$SubnetMask                      =  $_POST['SubnetMask'];
	$DefaultGateway                  =  $_POST['DefaultGateway'];	
	$MulticastIpBir                  =  trim($_POST['MulticastIpBir']);
	$MulticastPortBir                =  (ReqemlerXaricButunKarakterleriSil($_POST['MulticastPortBir'])>0)?ReqemlerXaricButunKarakterleriSil($_POST['MulticastPortBir']):NULL;
	$MulticastIpIki                  =  trim($_POST['MulticastIpIki']);
	$MulticastPortIki                =  (ReqemlerXaricButunKarakterleriSil($_POST['MulticastPortIki'])>0)?ReqemlerXaricButunKarakterleriSil($_POST['MulticastPortIki']):NULL;	
	$IstifadeyeVerildiyiTarix        =  ($_POST['IstifadeyeVerildiyiTarix']>0)?$_POST['IstifadeyeVerildiyiTarix']:NULL;
	$KameraTipi                      =  $_POST['KameraTipi'];
	$Qeyd                            =  $_POST['Qeyd'];

	if ($MulticastIpBir==$MulticastIpIki and $MulticastIpBir!="") {
		header("Location:../trskamera.php?ip=$ip&durum=multiipno");
		exit();
	}

	if ($MulticastPortBir==$MulticastPortIki and $MulticastPortIki!=NULL) {
		header("Location:../trskamera.php?ip=$ip&durum=multicastportberaber");
		exit();
	}

	$ToplamIPSor           = $db->prepare("SELECT * FROM ip where (MulticastIpBir=:MulticastIpBir or MulticastIpBir=:MulticastIpBiriki or MulticastIpIki=:MulticastIpIki or MulticastIpIki=:MulticastIpIkiBir or MulticastPortBir=:MulticastPortBir or MulticastPortBir=:MulticastPortBirIki     or MulticastPortIki=:MulticastPortIki or MulticastPortIki=:MulticastPortIkiBir) and ID<>:ID");
	$ToplamIPSor->execute(array(	
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
	echo $ToplamSay           = $ToplamIPSor->rowCount();	

	if ($ToplamSay>0) {
		$IPCek = $ToplamIPSor->fetch(PDO::FETCH_ASSOC);
		$ipdeolan=$IPCek['IP'];
		

		if ($IPCek['MulticastIpBir']==$MulticastIpBir and $MulticastIpBir!=NULL) {
			header("Location:../trskamera.php?ip=$ip&durum=muipbirmno&ipdeolan=$ipdeolan");
			exit();
		}

		if ($IPCek['MulticastIpIki']==$MulticastIpIki and $MulticastIpIki!=NULL) {
			header("Location:../trskamera.php?ip=$ip&durum=muipikimno&ipdeolan=$ipdeolan");
			exit();
		}

		if ($IPCek['MulticastIpIki']==$MulticastIpBir and $MulticastIpBir!=NULL) {
			header("Location:../trskamera.php?ip=$ip&durum=ipbiripikidevar&ipdeolan=$ipdeolan");
			exit();
		}

		if ($IPCek['MulticastIpBir']==$MulticastIpIki and $MulticastIpIki!=NULL) {
			header("Location:../trskamera.php?ip=$ip&durum=ipikiipbirdevar&ipdeolan=$ipdeolan");
			exit();
		}

		if ($IPCek['MulticastPortBir']==$MulticastPortBir and $MulticastPortBir!=NULL) {
			header("Location:../trskamera.php?ip=$ip&durum=muipportbirmno&ipdeolan=$ipdeolan");
			exit();
		}

		if ($IPCek['MulticastPortIki']==$MulticastPortBir and $MulticastPortBir!=NULL) {
			header("Location:../trskamera.php?ip=$ip&durum=multiportbirikidevar&ipdeolan=$ipdeolan");
			exit();
		}



		if ($IPCek['MulticastPortIki']==$MulticastPortIki and $MulticastPortIki!=NULL) {
			header("Location:../trskamera.php?ip=$ip&durum=muipportikimno&ipdeolan=$ipdeolan");
			exit();
		}

		if ($IPCek['MulticastPortBir']==$MulticastPortIki and $MulticastPortIki!=NULL) {
			header("Location:../trskamera.php?ip=$ip&durum=multiportikibirdevar&ipdeolan=$ipdeolan");
			exit();
		}
		
		
	}


	/*$ToplamIPSor           = $db->prepare("SELECT * FROM ip where (Alarm=$Alarm or MulticastIpBir='$MulticastIpBir' or MulticastPortBir='$MulticastPortBir' or MulticastIpIki='$MulticastIpIki' or MulticastPortIki='$MulticastPortIki')  and ID!=$ID");
	$ToplamIPSor->execute();
	$ToplamSay           = $ToplamIPSor->rowCount();*/
	$kaydet=$db->prepare("UPDATE ip SET 
		IstifadeMeksediID           =:IstifadeMeksediID,
		IdareAD                     =:IdareAD,
		BagliCihazinMarkasi         =:BagliCihazinMarkasi,
		BagliCihazinModeli          =:BagliCihazinModeli,
		BagliCihazinMacAdresi       =:BagliCihazinMacAdresi,
		SubnetMask                  =:SubnetMask,
		DefaultGateway              =:DefaultGateway,	
		MulticastIpBir              =:MulticastIpBir,
		MulticastPortBir            =:MulticastPortBir,
		MulticastIpIki              =:MulticastIpIki,
		MulticastPortIki            =:MulticastPortIki,		
		IstifadeyeVerildiyiTarix    =:IstifadeyeVerildiyiTarix,
		KameraTipi                  =:KameraTipi,
		Qeyd                        =:Qeyd
		WHERE ID=$ID");
	$update=$kaydet->execute(array(
		'IstifadeMeksediID'         => $IstifadeMeksediID,
		'IdareAD'                   => $IdareAD,		
		'BagliCihazinMarkasi'       => $BagliCihazinMarkasi,
		'BagliCihazinModeli'        => $BagliCihazinModeli,
		'BagliCihazinMacAdresi'     => $BagliCihazinMacAdresi,
		'SubnetMask'                => $SubnetMask,
		'DefaultGateway'            => $DefaultGateway,		
		'MulticastIpBir'            => $MulticastIpBir,
		'MulticastPortBir'          => $MulticastPortBir,
		'MulticastIpIki'            => $MulticastIpIki,
		'MulticastPortIki'          => $MulticastPortIki,		
		'IstifadeyeVerildiyiTarix'  => $IstifadeyeVerildiyiTarix,
		'KameraTipi'                => $KameraTipi,
		'Qeyd'                      => $Qeyd
	));
	if ($update) {
		header("Location:../trskamera.php?edtip=$ip&durum=ok");
	}else{
		header("Location:../trskamera.php?ip=$ip&durum=no");
	}
}
?>