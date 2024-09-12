<?php 
date_default_timezone_set('Asia/Baku');

$ZamanDamgasi         =   time();
$TarixSaat            =   date("Y-m-d H:i:s", $ZamanDamgasi);
$Tarix                =   date("Y-m-d", $ZamanDamgasi);
$Saat                 =   date("H:i:s", $ZamanDamgasi);



function zamanDamgasi($timezone = 'Asia/Baku') {
	try {
		$now = new DateTime('now', new DateTimeZone($timezone));
		return $now->getTimestamp();
	} catch (Exception $e) {
        // Xəta baş verdikdə, məsələn, yanlış bir zaman dilimi adı verildikdə
		return 'Yanlış zaman dilimi';
	}
}




function TarixSaat($timezone = 'Asia/Baku') {
	try {
		$now = new DateTime('now', new DateTimeZone($timezone));
		return $now->format('Y-m-d H:i:s');
	} catch (Exception $e) {
        // Xəta baş verdikdə, məsələn, yanlış bir zaman dilimi adı verildikdə
		return 'Yanlış zaman dilimi';
	}
}


function Tarix($timezone = 'Asia/Baku') {
	try {
		$now = new DateTime('now', new DateTimeZone($timezone));
		return $now->format('Y-m-d');
	} catch (Exception $e) {
        // Xəta baş verdikdə, məsələn, yanlış bir zaman dilimi adı verildikdə
		return 'Yanlış zaman dilimi';
	}
}



function Saat($timezone = 'Asia/Baku') {
	try {
		$now = new DateTime('now', new DateTimeZone($timezone));
		return $now->format('H:i:s');
	} catch (Exception $e) {
        // Xəta baş verdikdə, məsələn, yanlış bir zaman dilimi adı verildikdə
		return 'Yanlış zaman dilimi';
	}
}


function TarixSaatAz($deyer) {
	if ($deyer == NULL || strlen(trim($deyer)) <= 10) {
		return "";
	}
	try {
		$dateTime = new DateTime($deyer);
		return $dateTime->format('d.m.Y H:i:s');
	} catch (Exception $e) {
        // Yanlış tarix formatı daxil edildikdə
		return "";
	}
}


function TarixAz($deyer) {
    // $deyer değeri null ise veya boş bir dize ise boş bir dize döndür
	if ($deyer === null || strlen(trim($deyer)) == 0) {
		return "";
	}
	try {
		$dateTime = new DateTime($deyer);
		return $dateTime->format('d.m.Y');
	} catch (Exception $e) {
        // Yanlış tarih formatı girildiğinde
		return "";
	}
}


function ReqemlerXaricButunKarakterleriSil($Deyer)
{
	$Filtrele   =   preg_replace("/[^0-9]/", "", $Deyer);
	$Sonuc      =   $Filtrele;
	return $Sonuc;
}

/*
Windous ucun bu variyat isleyir
function MacAddress($ipAddress) {
    $output = shell_exec("arp -a " . escapeshellarg($ipAddress));
    $pattern = "/([0-9A-Fa-f]{2}[:-]){5}[0-9A-Fa-f]{2}/";
    if (preg_match($pattern, $output, $matches)) {
        return $matches[0];
    } else {
        return false;
    }
}

*/


function sirala($dəyər) {
    if (!isset($_SESSION['Sirala'])) {
        $_SESSION['Sirala'] = '';
    }    
    // Sıralama variantları üçün xəritə
    $sıralamaVariantları = [
        "IpNoktesiz" => "IpNoktesiz",
        "StatusSirala" => "Status",
        "SonCavabTarixiSirala" => "SonCavabTarixi",
        "IstifadeyeVerildiyiTarix" => "IstifadeyeVerildiyiTarix",
        "IdareAD" => "IdareAD",
        "BagliCihazinMarkasi" => "BagliCihazinMarkasi",
        "BagliCihazinModeli" => "BagliCihazinModeli",
        "BagliCihazinMacAdresi" => "BagliCihazinMacAdresi",
        "BagliCihazinAdi" => "BagliCihazinAdi",
        "KameraTipi" => "KameraTipi",
        "SubnetMask" => "SubnetMask",
        "DefaultGateway" => "DefaultGateway",
        "NVR" => "NVR",
        "AlarmStatusu" => "AlarmStatusu",
        "Alarm" => "Alarm",
        "MulticastIpBir" => "MulticastIpBir",
        "MulticastPortBir" => "MulticastPortBir",
        "MulticastIpIki" => "MulticastIpIki",
        "MulticastPortIki" => "MulticastPortIki",
        "SonDuzelisTarixi" => "SonDuzelisTarixi"
    ];
    if (array_key_exists($dəyər, $sıralamaVariantları)) {
        $sütunAdı = $sıralamaVariantları[$dəyər];
        $_SESSION['Sirala'] = toggleSortOrder($_SESSION['Sirala'], "$sütunAdı ASC", "$sütunAdı DESC");
    }
    return $_SESSION['Sirala'];
}


function toggleSortOrder($currentOrder, $ascOrder, $descOrder) {
	if ($currentOrder == $ascOrder) {
		return $descOrder;
	} else {
		return $ascOrder;
	}
}

function MacAddress($ipAddress) {
    // Komutu çalıştır ve çıktıyı al
    $command = "arp -a | grep " . escapeshellarg($ipAddress);
    $output = [];
    $return_var = 0;
    exec($command, $output, $return_var);

    // Eğer komut başarılı bir sonuç döndürmemişse false döndür
    if ($return_var !== 0 || empty($output)) {
        return false;
    }

    // MAC adresi desenini tanımla
    $pattern = "/([0-9A-Fa-f]{2}[:-]){5}[0-9A-Fa-f]{2}/";

    // Çıktıda MAC adresi araması yap
    if (preg_match($pattern, $output[0], $matches)) {
        return $matches[0];
    } else {
        return false;
    }
}



//Widousda bu isleyir
function NameAndGroupWin($ipAddress) {
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
	$deyeralti=explode(" ",$deyerbes);
	return $deyeralti;
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
        $elements = array_values(array_filter(array_map('trim', explode(" ", $cleanedLine))));

        // Eğer dizi boşsa veya sadece bir eleman içeriyorsa geç
        if (count($elements) < 2) {
            continue;
        }

        // İlk elemanı ad olarak, sonraki elemanları grup olarak kabul et
        $name = array_shift($elements);
        $groups = $elements;

        // Eğer ad ve gruplar varsa diziye ekle
        if (!empty($name) && !empty($groups)) {
            $namesAndGroups[$name] = $groups;
        }
    }

    // Eğer dizi boşsa veya yeterince eleman içermiyorsa hata mesajı döndür
    if (count($namesAndGroups) < 3) {
        return "";
    }

    // Yeni diziyi oluştur ve ikinci elemanı döndür
    $newArray = array_combine(array_keys($namesAndGroups), array_keys($namesAndGroups));
    $originalArray = array_values($newArray);

    return $originalArray[2];
}




function TarixFerqiIl($tarih1, $tarih2) {
    // DateTime nesneleri oluştur
    $date1 = new DateTime($tarih1);
    $date2 = new DateTime($tarih2);

    // İki tarih arasındaki farkı hesapla
    $interval = $date1->diff($date2);

    // Yıl farkını döndür
    return $interval->y;
}



function pingWithTimeout($ip, $timeout = 2) {
    // Ping komutunu zaman aşımı süresi ile çalıştır
    $command = "/bin/ping -c 1 -W $timeout " . escapeshellarg($ip);
    $result = shell_exec($command);

    // Eğer sonuç boşsa veya "1 packets transmitted, 0 received" ifadesi varsa boş döndür
    if (empty($result) || strpos($result, '1 packets transmitted, 0 received') !== false) {
        return 0;
    }

    return 1;
}



?>