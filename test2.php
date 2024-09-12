<?php 
require_once "Setting/baglan.php";
/* 
	$kaydet=$db->prepare("UPDATE ip SET 
				IstifadeMeksediID=:IstifadeMeksediID
				WHERE IpNoktesiz>=2887259137 and IpNoktesiz<=2887259390");
			$update=$kaydet->execute(array(
				'IstifadeMeksediID'        => 3
			));

		172.22.20.1	2887128065
		172.22.21.254 2887128574

			$long = ip2long("172.22.20.1");
echo $long;
 
 nbtstat -a

*/



 function NameAndGroup($ipAddress) {
 	$output = shell_exec("nbtstat -a " . escapeshellarg($ipAddress));
 	$deyer=explode(" ---------------------------------------------", $output);
 	$deyeriki=explode("MAC Address", $deyer[1]);
 	$deyeruc=explode("\n", $deyeriki[0]);
 	$sondeyer=array();
 	foreach ($deyeruc as $deyer) {
 		if (strlen(trim($deyer))>0) {
 			$deyerdord=explode("<", $deyer); 	
 		}
 		if (strlen(trim($deyerdord[0]))>0) {
 			$sondeyer[]=trim($deyerdord[0]);
 		}
 	}

 	$deyerbes=implode(" ",array_unique($sondeyer));

 	$deyeralti=explode(" ",trim($deyerbes));
 	return $deyeralti;
 }

 $ip="172.22.20.23";
 $BagliCihazinMacAdresi = NameAndGroup($ip);

 
echo $deyerAdveGroup=count($BagliCihazinMacAdresi);
 echo "<pre>";
 print_r($BagliCihazinMacAdresi);
 echo "</pre>";
?>