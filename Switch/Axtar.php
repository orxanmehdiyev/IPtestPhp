<?php 
require_once '../Setting/baglan.php';
require_once "../Setting/function.php"; 
if (isset($_POST['axtar'])) {
	$deyer               			= json_decode($_POST['axtar'], true);
	$AxtarilanIP=$deyer['Axtar_IP'];
	if (isset($_REQUEST['Sayfalama'])) {
		$GelenSayfalama=$_REQUEST['Sayfalama'];
	}else{
		$GelenSayfalama=1;
	}	
	if (isset($_SESSION['SayfaBasinaGosterilecekKayidSayisi'])) {
		$SayfaBasinaGosterilecekKayidSayisi=$_SESSION['SayfaBasinaGosterilecekKayidSayisi'];
	}else{
		$SayfaBasinaGosterilecekKayidSayisi=20;
	}
	$SayfalamaSolVeSagButtonSayisi=5;	
	$ToplamIPSor           = $db->prepare("SELECT * FROM ip where IP=:IP");
	$ToplamIPSor->execute(array(
		'IP'=>$AxtarilanIP));
	$ToplamSay           = $ToplamIPSor->rowCount();
	$BulunanSayafaSayisi=ceil($ToplamSay/$SayfaBasinaGosterilecekKayidSayisi);
	if ($GelenSayfalama>$BulunanSayafaSayisi ) {
		$GelenSayfalama=$BulunanSayafaSayisi;
	}
	if ($GelenSayfalama<=0 ) {
		$GelenSayfalama=1;
	}
	$SayfalamagaBaslanacaqKayidSayisi=($GelenSayfalama*$SayfaBasinaGosterilecekKayidSayisi)-$SayfaBasinaGosterilecekKayidSayisi;
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
		LEFT JOIN istifademeksedi ON ip.IstifadeMeksediID  = istifademeksedi.IstifadeMeksediID where IP=:IP order by ID ASC LIMIT $SayfalamagaBaslanacaqKayidSayisi, $SayfaBasinaGosterilecekKayidSayisi
		");
	$IPSor->execute(array(
		'IP'=>$AxtarilanIP));
	if ($ToplamSay > 0) {
		echo $AxtarilanIP
		?>

		<table class="table">
			<thead>
				<tr>					
					<th>IP</th>
					<th>Status</th>
					<th class="yuziyirmiyeddi">Son Cavab Tarixi</th>
					<th>İstifadə Məksədi</th>					
					<th>İdarə</th>
					<th>İstifadə Olunduğu Yer</th>
					<th>Bağlı Cihazın Markası</th>
					<th>Bağlı Cihazın Modeli</th>
					<th>Bağlı Cihazın MAC Adresi</th>
					<th>Bağlı Cihazın Adı</th>
					<th>Bağlı Cihazın Port Sayı</th>
					<th>Subnet MAsk</th>
					<th>Default Gateway</th>
					<th>NVR</th>
					<th>NVR Status</th>
					<th>Alarm Status</th>
					<th>Alarm</th>
					<th>Multicast Ip 1</th>
					<th>Multicast Port 1</th>
					<th>Multicast Ip 2</th>
					<th>Multicast Port 2</th>
					<th>RAM</th>
					<th>Disk Həcmi</th>
					<th>Processor</th>
					<th>Qeyd</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php while ($IPCek = $IPSor->fetch(PDO::FETCH_ASSOC)) {
					if ($IPCek['Status']==1) {						
						$Status="OK";						
					}else{
						$Status="NO";						
					}?>
					<tr id="<?php echo "daimiseneddouble_" . $IPCek['IP_ID']; ?>" ondblclick="Bax(this.id)">
						<td><?php echo $IPCek['IP_IP']; ?></td>
						<td class=" <?php if ($Status=="OK") {
							echo "arxafonyail";
						} ?>"><?php echo $Status; ?></td>
						<td><?php echo $Soncavab; ?></td>
						<td><?php echo $IPCek['istifademeksedi_ItifadeYeriAd']; ?></td>
						<td><?php echo $IPCek['IP_IdareAD']; ?></td>
						<td><?php echo $IPCek['IP_BagliCihazinYeri']; ?></td>
						<td><?php echo $IPCek['IP_BagliCihazinMarkasi']; ?></td>
						<td><?php echo $IPCek['IP_BagliCihazinModeli']; ?></td>
						<td><?php echo $IPCek['IP_BagliCihazinMacAdresi']; ?></td>
						<td><?php echo $IPCek['IP_BagliCihazinAdi']; ?></td>
						<td><?php echo ($IPCek['IP_BagliCihazinPortSayi']>0)?$IPCek['IP_BagliCihazinPortSayi']:""; ?></td>
						<td><?php echo $IPCek['IP_SubnetMask']; ?></td>
						<td><?php echo $IPCek['IP_DefaultGateway']; ?></td>
						<td><?php echo $IPCek['IP_NVR']; ?></td>
						<td class=" <?php if ($IPCek['IP_NVR_Status']==1) {
							echo "arxafonyail";
						} ?>"><?php if ($IPCek['IP_NVR_Status']==1) {
							echo "Yazır";
						}else{
							echo "Boş";}; ?></td>
							<td><?php echo $IPCek['IP_AlarmStatusu']; ?></td>
							<td><?php echo $IPCek['IP_Alarm']; ?></td>
							<td><?php echo $IPCek['IP_MulticastIpBir']; ?></td>
							<td><?php echo $IPCek['IP_MulticastPortBir']; ?></td>
							<td><?php echo $IPCek['IP_MulticastIpIki']; ?></td>
							<td><?php echo $IPCek['IP_MulticastPortIki']; ?></td>
							<td><?php echo $IPCek['IP_RAM']; ?></td>
							<td><?php echo $IPCek['IP_DiskHecmi']; ?></td>
							<td><?php echo $IPCek['IP_Processor']; ?></td>
							<td><?php echo $IPCek['IP_Qeyd']; ?></td>	
							<td style="text-align: right;width: 50px;">
								<a href="bax.php?ip=<?php echo $IPCek['IP_IP'] ?>"><button class="cedvel_ici_button cedvel_ici_yesil_button" >Bax</button>
								</a>
								<a href="edit.php?ip=<?php echo $IPCek['IP_IP'] ?>"><button class="cedvel_ici_button cedvel_ici_yesil_button" >Düzəliş</button></a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<div>

				<?php if ($SayfaBasinaGosterilecekKayidSayisi==10) {?>
					<img class="hamisigoster" onclick="HamisiniGoster()" src="img/asagiox.jpg">
				<?php }else{?>
					<img class="hamisigoster" onclick="NormalGoster()" src="img/yuxariox.jpg">
				<?php } ?>
			</div>
		<?php }else{} ?>
		<div class="SayfalamaAlaniKapsayici">
			<div class="SayfalamaAlaniIciMetinAlaniKapsayicisi">
				Cəmi: <?php echo $BulunanSayafaSayisi; ?> səyfədə, <?php echo $ToplamSay; ?> ədəd sənəd var
			</div>
			<?php if ($BulunanSayafaSayisi>1) {
				?>
				<div class="SayfalamaAlaniIciNumaralandirmaKapsayicisi">
					<?php 
					if ($GelenSayfalama>1) { 
						$SayfalamaIciSayfaDeyeriBirGeriAl=$GelenSayfalama-1;
						?>
						<span class='Passif' onclick="Seyfeleme(1)"><<</span>
						<span class='Passif' onclick="Seyfeleme(<?php echo $SayfalamaIciSayfaDeyeriBirGeriAl; ?>)"> < </span>
					<?php }	 
					for ($SayfalamaIcinSayfaIndexDeyeri=$GelenSayfalama-$SayfalamaSolVeSagButtonSayisi; $SayfalamaIcinSayfaIndexDeyeri<=$GelenSayfalama+$SayfalamaSolVeSagButtonSayisi ; $SayfalamaIcinSayfaIndexDeyeri++) { 
						if ($SayfalamaIcinSayfaIndexDeyeri>0 and $SayfalamaIcinSayfaIndexDeyeri<=$BulunanSayafaSayisi) {
							if ($SayfalamaIcinSayfaIndexDeyeri==$GelenSayfalama) {?>
								<span class='Aktive'><?php 	echo $SayfalamaIcinSayfaIndexDeyeri." "; ?></span>						
							<?php }else{?>						
								<span class='Passif' onclick="Seyfeleme(<?php echo $SayfalamaIcinSayfaIndexDeyeri; ?>)"> <?php 	echo $SayfalamaIcinSayfaIndexDeyeri." "; ?></span>
							<?php }
						}				
					}		
					if ($GelenSayfalama<$BulunanSayafaSayisi  ) {
						$SayfalamaIciSayfaDeyeriBirIleriAl=$GelenSayfalama+1;
						?>				
						<span class='Passif'  onclick="Seyfeleme(<?php echo $SayfalamaIciSayfaDeyeriBirIleriAl; ?>)"> ></span>
						<span class='Passif' onclick="Seyfeleme(<?php echo $BulunanSayafaSayisi; ?>)"> >> </span>

					<?php } ?>
				</div>
			<?php } ?>
		</div>
	<?php }else{

	} ?>
