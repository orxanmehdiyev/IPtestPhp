<?php require_once "_header.php"; ?>
<script src="ButunIpiler/Script.js"></script>

<?php  if (isset($_REQUEST['ip']) and isset($_REQUEST['durum']) ) {
	if (isset($_REQUEST['durum'])=="ok") {
		$ip=$_REQUEST['ip'];
		?>




	<?php	}
} ?>
<div id="icerik" class="tablokapsyici">
	<?php 
	if (isset($_GET['durum'])) {
		if ($_GET['durum']=='ok') {?>
			<div class="cavabok">Yenilənmə uğurlu</div>
		<?php 	}
	} ?>

	<?php	
	if (isset($_REQUEST['Sayfalama'])) {
		$GelenSayfalama = $_REQUEST['Sayfalama'];
	} else {
		$GelenSayfalama = 1;
	}
	if (isset($_SESSION['SayfaBasinaGosterilecekKayidSayisi'])) {
		$SayfaBasinaGosterilecekKayidSayisi = $_SESSION['SayfaBasinaGosterilecekKayidSayisi'];
	} else {
		$SayfaBasinaGosterilecekKayidSayisi = 20;
	}

	if (isset($_SESSION['Sirala'])) {
		$Sirala=$_SESSION['Sirala'];
	} else {
		$Sirala="IpNoktesiz ASC";
	}
	$SayfalamaSolVeSagButtonSayisi = 5;
	$ToplamIPSor           = $db->prepare("SELECT * FROM ip");
	$ToplamIPSor->execute();
	$ToplamSay           = $ToplamIPSor->rowCount();
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
		ip.BagliCihazinAdi 						AS 		IP_BagliCihazinAdi,
		ip.BagliCihazinPortSayi 				AS 		IP_BagliCihazinPortSayi,
		ip.SubnetMask 							AS 		IP_SubnetMask,
		ip.DefaultGateway 						AS 		IP_DefaultGateway,
		ip.NVR 									AS 		IP_NVR,
		ip.NVR_Status 							AS 		IP_NVR_Status,
		ip.AlarmStatusu 						AS 		IP_AlarmStatusu,
		ip.Alarm 								AS 		IP_Alarm,
		ip.MulticastIpBir 						AS 		IP_MulticastIpBir,
		ip.MulticastPortBir 					AS 		IP_MulticastPortBir,
		ip.MulticastIpIki 						AS 		IP_MulticastIpIki,
		ip.MulticastPortIki 					AS 		IP_MulticastPortIki,
		ip.UserName 							AS 		IP_UserName,
		ip.RAM 									AS 		IP_RAM,
		ip.DiskHecmi 							AS 		IP_DiskHecmi,
		ip.Processor 							AS 		IP_Processor,
		ip.IstifadeyeVerildiyiTarix 			AS 		IstifadeyeVerildiyiTarix,
		ip.KameraTipi 							AS 		KameraTipi,
		ip.Qeyd 								AS 		IP_Qeyd,
		ip.Status 								AS 		Status,
		ip.SonCavabTarixi 						AS 		SonCavabTarixi,
		istifademeksedi.IstifadeMeksediID 		AS 		istifademeksedi_IstifadeMeksediID,
		istifademeksedi.ItifadeYeriAd 			AS 		istifademeksedi_ItifadeYeriAd
		FROM
		ip
		LEFT JOIN istifademeksedi ON ip.IstifadeMeksediID  = istifademeksedi.IstifadeMeksediID where ip.IP=:IP_IP order by $Sirala LIMIT $SayfalamagaBaslanacaqKayidSayisi, $SayfaBasinaGosterilecekKayidSayisi
		");
	$IPSor->execute(array(
		'IP_IP'=>$ip));
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
					<th>Bağlı Cihazın Adı</th>
					<th>Bağlı Cihazın Port Sayı</th>
					<th>Kamera Tipi</th>
					<th class="cedvelipalani">Subnet MAsk</th>
					<th class="cedvelipalani">Default Gateway</th>
					<th class="cedvelipalani">NVR</th>
					<th>NVR Status</th>
					<th>Alarm Status</th>
					<th>Alarm</th>
					<th class="cedvelipalani">Multicast Ip 1</th>
					<th>Multicast Port 1</th>
					<th class="cedvelipalani">Multicast Ip 2</th>
					<th>Multicast Port 2</th>
					<th>İstifadəçi adı</th>
					<th>RAM</th>
					<th>Disk Həcmi</th>
					<th>Processor</th>
					<th  onclick="IstifadeyeVerildiyiTarix()">İstifadəyə Verildiyi tarix</th>
					<th>Qeyd</th>
					<th class="cedvelbuttonalani"></th>
				</tr>
			</thead>
			<tbody>
				<?php while ($IPCek = $IPSor->fetch(PDO::FETCH_ASSOC)) {
					if ($IPCek['Status']==1) {						
						$Status="A";						
					}else{
						$Status="P";						
					}

					if ($IPCek['KameraTipi']==1) { 
						$KameraTipi= "Hərəkətli";
					}else if ($IPCek['KameraTipi']==2) {
						$KameraTipi= "Sabit";
					}else{
						$KameraTipi="";
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
						<td><?php echo $IPCek['IP_BagliCihazinAdi']; ?></td>
						<td><?php echo $IPCek['IP_BagliCihazinPortSayi']; ?></td>
						<td><?php echo $KameraTipi ?></td>
						<td class="cedvelipalani"><?php echo $IPCek['IP_SubnetMask']; ?></td>
						<td class="cedvelipalani"><?php echo $IPCek['IP_DefaultGateway']; ?></td>
						<td class="cedvelipalani"><?php echo $IPCek['IP_NVR']; ?></td>
						<td class=" <?php if ($IPCek['IP_NVR_Status']==1) {
							echo "arxafonyail";
						} ?>"><?php if ($IPCek['IP_NVR_Status']==1) {
							echo "Yazır";
						}else{
							echo "Boş";}; ?></td>
							<td><?php echo $IPCek['IP_AlarmStatusu']; ?></td>
							<td><?php echo $IPCek['IP_Alarm']; ?></td>
							<td class="cedvelipalani"><?php echo $IPCek['IP_MulticastIpBir']; ?></td>
							<td><?php echo $IPCek['IP_MulticastPortBir']; ?></td>
							<td class="cedvelipalani"><?php echo $IPCek['IP_MulticastIpIki']; ?></td>
							<td><?php echo $IPCek['IP_MulticastPortIki']; ?></td>
							<td><?php echo $IPCek['IP_UserName']; ?></td>
							<td><?php echo $IPCek['IP_RAM']; ?></td>
							<td><?php echo $IPCek['IP_DiskHecmi']; ?></td>
							<td><?php echo $IPCek['IP_Processor']; ?></td>
							<td><?php echo $IstifadeteVerlidiyiTarix; ?></td>
							<td><?php echo $IPCek['IP_Qeyd']; ?></td>	
							<td>
								<a href="edit.php?ip=<?php echo $IPCek['IP_IP'] ?>"><button class="cedvel_ici_button cedvel_ici_yesil_button" >Düzəliş</button></a>
								<a href="bax.php?ip=<?php echo $IPCek['IP_IP'] ?>"><button class="cedvel_ici_button cedvel_ici_yesil_button" >Bax</button></a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>

			<?php } require_once '_footer.php' ?>