<?php
require_once '../Setting/baglan.php';
require_once "../Setting/function.php";
if (isset($_POST['sirala'])) {
	if (isset($_REQUEST['Sayfalama'])) {
		$GelenSayfalama = $_REQUEST['Sayfalama'];
	} else {
		$GelenSayfalama = 1;
	}
	$ToplamIPSor           = $db->prepare("SELECT * FROM ip");
	$ToplamIPSor->execute();
	$ToplamSay           = $ToplamIPSor->rowCount();	
	if (isset($_SESSION['SayfaBasinaGosterilecekKayidSayisi'])) {
		$SayfaBasinaGosterilecekKayidSayisi = $_SESSION['SayfaBasinaGosterilecekKayidSayisi'];
	} else {
		$SayfaBasinaGosterilecekKayidSayisi = 10;
	}
	$SayfalamaSolVeSagButtonSayisi = 5;
	
	$Sirala=sirala($_POST['sirala']);



	$BulunanSayafaSayisi = ceil($ToplamSay / $SayfaBasinaGosterilecekKayidSayisi);
	if ($GelenSayfalama > $BulunanSayafaSayisi) {
		$GelenSayfalama = $BulunanSayafaSayisi;
	}
	if ($GelenSayfalama <= 0) {
		$GelenSayfalama = 1;
	}
	$SayfalamagaBaslanacaqKayidSayisi = ($GelenSayfalama * $SayfaBasinaGosterilecekKayidSayisi) - $SayfaBasinaGosterilecekKayidSayisi;
	$IPSor                    = $db->prepare("SELECT
		ip.ID 							    	AS 		IP_ID,
		ip.IP 									AS 		IP_IP,
		ip.IpNoktesiz 							AS 		IpNoktesiz,
		ip.IstifadeMeksediID 				    AS 		IP_IstifadeMeksediID,
		ip.IdareAD 								AS 		IP_IdareAD,
		ip.BagliCihazinYeri 					AS 		IP_BagliCihazinYeri,
		ip.BagliCihazinMarkasi 					AS 		IP_BagliCihazinMarkasi,
		ip.BagliCihazinModeli 					AS 		IP_BagliCihazinModeli,
		ip.BagliCihazinMacAdresi 				AS 		IP_BagliCihazinMacAdresi,
		ip.SubnetMask 							AS 		IP_SubnetMask,
		ip.DefaultGateway 						AS 		IP_DefaultGateway,	
		ip.DiskHecmi 							AS 		IP_DiskHecmi,	
		ip.IstifadeyeVerildiyiTarix 			AS 		IstifadeyeVerildiyiTarix,
		ip.Qeyd 								AS 		IP_Qeyd,
		ip.Status 								AS 		Status,
		ip.SonCavabTarixi 						AS 		SonCavabTarixi,
		istifademeksedi.IstifadeMeksediID 		AS 		istifademeksedi_IstifadeMeksediID,
		istifademeksedi.ItifadeYeriAd 			AS 		istifademeksedi_ItifadeYeriAd
		FROM
		ip
		LEFT JOIN istifademeksedi ON ip.IstifadeMeksediID  = istifademeksedi.IstifadeMeksediID where istifademeksedi.IstifadeMeksediID=:istifademeksedi_IstifadeMeksediID order by $Sirala		
		");
	$IPSor->execute(array(
		'istifademeksedi_IstifadeMeksediID'=>6));
	if ($ToplamSay > 0) {
		?>
		<table class="table">
			<thead>
				<tr>				
					<th onclick="IpSirala()" class="cedvelipalani">IP</th>
					<th onclick="StatusSirala()" class="cedvelstatusalani" >Status</th>
					<th onclick="SonCavabTarixiSirala()" class="soncavabtarixialani">Son Cavab Tarixi</th>
					<th class="cedvelistifademeksedialani">İstifadə Məksədi</th>					
					<th>İdarə</th>
					<th>İstifadə Olunduğu Yer</th>
					<th>Bağlı Cihazın Markası</th>
					<th>Bağlı Cihazın Modeli</th>
					<th class="macalani">MAC</th>
					<th class="cedvelipalani">Subnet MAsk</th>
					<th class="cedvelipalani">Default Gateway</th>		
					<th>Disk həcmi</th>
					<th>Kamera Sayı</th>					
					<th  onclick="IstifadeyeVerildiyiTarix()">İstifadəyə Verildiyi tarix</th>
					<th>Qeyd</th>
					<th class="cedvelbuttonalani"></th>
				</tr>
			</thead>
			<tbody>
				<?php while ($IPCek = $IPSor->fetch(PDO::FETCH_ASSOC)) {
					$NvrKam                    = $db->prepare("SELECT * FROM ip where NVR=:NVR");
					$NvrKam->execute(array(
						'NVR'=>$IPCek['IP_IP']));
					$NvrKamSay           = $NvrKam->rowCount();

					if ($IPCek['Status']==1) {						
						$Status="A";						
					}else{
						$Status="P";						
					}			

					if ($IPCek['IstifadeyeVerildiyiTarix']>0) {
						$IstifadeteVerlidiyiTarix=TarixAz($IPCek['IstifadeyeVerildiyiTarix']);
					}else{
						$IstifadeteVerlidiyiTarix="";
					}
					?>
					<tr id="<?php echo "daimiseneddouble_" . $IPCek['IP_ID']; ?>" ondblclick="Bax(this.id)">
						<td class="cedvelipalani"><?php echo $IPCek['IP_IP']; ?></td>
						<td class=" <?php if ($Status=="A") {
							echo "arxafonyail";
						} ?>"><?php echo $Status; ?></td>
						<td class="soncavabtarixialani"><?php echo TarixSaatAz($IPCek['SonCavabTarixi']); ?></td>
						<td><?php echo $IPCek['istifademeksedi_ItifadeYeriAd']; ?></td>
						<td><?php echo $IPCek['IP_IdareAD']; ?></td>
						<td><?php echo $IPCek['IP_BagliCihazinYeri']; ?></td>
						<td><?php echo $IPCek['IP_BagliCihazinMarkasi']; ?></td>
						<td><?php echo $IPCek['IP_BagliCihazinModeli']; ?></td>
						<td class="macalaniicerik"><?php echo $IPCek['IP_BagliCihazinMacAdresi']; ?></td>
						<td class="cedvelipalani"><?php echo $IPCek['IP_SubnetMask']; ?></td>
						<td class="cedvelipalani"><?php echo $IPCek['IP_DefaultGateway']; ?></td>							
						<td><?php echo $IPCek['IP_DiskHecmi']; ?></td>
						<td>
							<a href="nvr.php?kamerabaxip=<?php echo $IPCek['IP_IP'] ?>"><?php echo $NvrKamSay; ?></a>
						</td>
						<td><?php echo $IstifadeteVerlidiyiTarix; ?></td>
						<td><?php echo $IPCek['IP_Qeyd']; ?></td>	
						<td>
							<a href="nvr.php?ip=<?php echo $IPCek['IP_IP'] ?>"><button class="cedvel_ici_button cedvel_ici_yesil_button" ><span class="icon">&#9998;</span></button></a>
							<a href="bax.php?ip=<?php echo $IPCek['IP_IP'] ?>"><button class="cedvel_ici_button cedvel_ici_yesil_button" ><span class="icon">&#128065;</span></button></a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>	
	<?php } else {
	} ?>
<?php } else {
} ?>