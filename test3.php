<?php /*
require_once "Setting/baglan.php";
;
$Sor=$db->prepare("SELECT * FROM ip where IpNoktesiz>=2887128065 and IpNoktesiz<=2887128574 and IstifadeMeksediID=3");
$Sor->execute();
$deyer=0;
while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {	
	$ip=$Cek['IP'];
	$PingSor           = $db->prepare("SELECT * FROM ping where IP=:IP and Statusu=:Statusu order by PingID DESC");
	$PingSor->execute(array(
		'IP'=>$Cek['IP'],
		'Statusu'=>1
	));
	$PingSay           = $PingSor->rowCount();
	if ($PingSay>0) {
		$deyer++;
	}else{
		
	}

}
echo $deyer;

$Qeyd="";
	$kaydet=$db->prepare("UPDATE ip SET 
		Qeyd=:Qeyd
		WHERE IstifadeMeksediID=3");
	$update=$kaydet->execute(array(
		'Qeyd'        => $Qeyd
	));

	$ip = "172.20.21.24";
$result = shell_exec("/bin/ping -c 1 $ip");

	function MacAddress($ipAddress) {
		$command = "arp -a | grep $ipAddress";
		$output = [];
		$return_var = 0;
		exec($command, $output, $return_var);
		$pattern = "/([0-9A-Fa-f]{2}[:-]){5}[0-9A-Fa-f]{2}/";
		if (preg_match($pattern, $output[0], $matches)) {
			return $matches[0];
		} else {
			return false;
		}
	}

	function NameAndGroup($ip) {
    // Nmblookup komutunu çalıştır
		$output = shell_exec("nmblookup -A " . escapeshellarg($ip));

       // Ad ve grupları içeren dizi
		$namesAndGroups = [];

    // Cevabı satır satır işle
		$lines = explode(PHP_EOL, $output);
		foreach ($lines as $line) {
        // Her satırdan MAC Address bilgisini kaldır
			$cleanedLine = str_replace("MAC Address = ", "", $line);

        // Satırı parçala ve temizle
			$elements = array_map('trim', explode(" ", $cleanedLine));

        // İlk elemanı ad olarak, sonraki elemanları grup olarak kabul et
			$name = array_shift($elements);
			$groups = $elements;

        // Eğer ad ve gruplar varsa diziye ekle
			if (!empty($name) && !empty($groups)) {
				$namesAndGroups[$name] = $groups;
			}
		}
		$newArray = array_combine(array_keys($namesAndGroups), array_keys($namesAndGroups));
		$originalArray = array_values($newArray);
		return $originalArray[2];
	}





 



	$deyers=  NameAndGroup($ip);
	echo "<pre>";
	print_r($deyers);
	echo "</pre>";
	*/

	date_default_timezone_set('Asia/Baku');
$ZamanDamgasi         =   time();
echo $TarixSaat            =   date("Y-m-d H:i:s", $ZamanDamgasi);


?>