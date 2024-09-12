	<?php
	if (isset($_GET['kamerabaxip'])) {
			if (isset($_SESSION['Sirala'])) {
		$Sirala=$_SESSION['Sirala'];
	} else {
		$Sirala="IpNoktesiz ASC";
	}

	$IPSor                    = $db->prepare("SELECT
		ip.ID                                   AS 		IP_ID,
		ip.IP                                   AS 		IP_IP,
		ip.IpNoktesiz                           AS 		IpNoktesiz,
		ip.IstifadeMeksediID                    AS 		IP_IstifadeMeksediID,
		ip.IdareAD                              AS 		IP_IdareAD,
		ip.BagliCihazinYeri                     AS 		IP_BagliCihazinYeri,
		ip.BagliCihazinMarkasi                  AS 		IP_BagliCihazinMarkasi,
		ip.BagliCihazinModeli                   AS 		IP_BagliCihazinModeli,
		ip.BagliCihazinMacAdresi                AS 		IP_BagliCihazinMacAdresi,
		ip.BagliCihazinAdi                      AS 		IP_BagliCihazinAdi,		
		ip.SubnetMask                           AS 		IP_SubnetMask,
		ip.DefaultGateway                       AS 		IP_DefaultGateway,
		ip.NVR                                  AS 		IP_NVR,		
		ip.AlarmStatusu                         AS 		IP_AlarmStatusu,
		ip.Alarm                                AS 		IP_Alarm,
		ip.MulticastIpBir                       AS 		IP_MulticastIpBir,
		ip.MulticastPortBir                     AS 		IP_MulticastPortBir,
		ip.MulticastIpIki                       AS 		IP_MulticastIpIki,
		ip.MulticastPortIki                     AS 		IP_MulticastPortIki,
		ip.IstifadeyeVerildiyiTarix             AS 		IstifadeyeVerildiyiTarix,
		ip.KameraTipi                           AS 		KameraTipi,
		ip.Qeyd                                 AS 		IP_Qeyd,
		ip.Status                               AS 		Status,
		ip.SonCavabTarixi                       AS 		SonCavabTarixi,
		istifademeksedi.IstifadeMeksediID       AS 		istifademeksedi_IstifadeMeksediID,
		istifademeksedi.ItifadeYeriAd           AS 		istifademeksedi_ItifadeYeriAd
		FROM
		ip
		LEFT JOIN istifademeksedi ON ip.IstifadeMeksediID  = istifademeksedi.IstifadeMeksediID where istifademeksedi.IstifadeMeksediID=:istifademeksedi_IstifadeMeksediID and ip.NVR=:IP_NVR order by $Sirala
		");
	$IPSor->execute(array(
		'istifademeksedi_IstifadeMeksediID'=>3,
		'IP_NVR'=>$_GET['kamerabaxip']
	));
	$ToplamSay           = $IPSor->rowCount();
	if ($ToplamSay > 0) {
		$aktivKamera=0;
		?>
		<table class="table">
			<thead>
				<tr>				
					<th onclick="IpSirala()" class="cedvelipalani">IP</th>
					<th onclick="StatusSirala()" class="cedvelstatusalani" >Status</th>
					<th onclick="SonCavabTarixiSirala()" class="soncavabtarixialani">Son Cavab Tarixi</th>
					<th class="cedvelistifademeksedialani">İstifadə Məqsədi</th>					
					<th>İdarə</th>
					<th>Cihazın Markası</th>
					<th>Cihazın Modeli</th>
					<th class="macalani">MAC</th>
					<th>Cihazın Adı</th>					
					<th>Kamera Tipi</th>
					<th class="cedvelipalani">Subnet Mask</th>
					<th class="cedvelipalani">Default Gateway</th>
					<th class="cedvelipalani">NVR</th>
					<th> Status reception port</th>
					<th>Alarm</th>
					<th class="cedvelipalani">Multicast address 1</th>
					<th>Multicast Port 1</th>
					<th class="cedvelipalani">Multicast address 2</th>
					<th>Multicast Port 2</th>								
					<th  onclick="IstifadeyeVerildiyiTarix()">İstifadəyə Verildiyi tarix</th>
					<th>Qeyd</th>
					<th class="cedvelbuttonalani"></th>
				</tr>
			</thead>
			<tbody>
				<?php while ($IPCek = $IPSor->fetch(PDO::FETCH_ASSOC)) {
					if ($IPCek['Status']==1) {						
						$Status="A";	
						$aktivKamera++;						
					}else{
						$Status="P";						
					}

					?>
					<tr>
						<td class="cedvelipalani"><?php echo $IPCek['IP_IP']; ?></td>
						<td class="<?php echo ($Status == "A") ? "arxafonyail" : (($Status == "P" && $IPCek['SonCavabTarixi'] > 0) ? "bcred" : ""); ?>"><?php echo $Status; ?></td>
						<td class="soncavabtarixialani"><?php echo TarixSaatAz($IPCek['SonCavabTarixi']); ?></td>
						<td><?php echo $IPCek['istifademeksedi_ItifadeYeriAd']; ?></td>
						<td><?php echo $IPCek['IP_IdareAD']; ?></td>
						<td><?php echo $IPCek['IP_BagliCihazinMarkasi']; ?></td>
						<td><?php echo $IPCek['IP_BagliCihazinModeli']; ?></td>
						<td class="macalaniicerik"><?php echo $IPCek['IP_BagliCihazinMacAdresi']; ?></td>
						<td><?php echo $IPCek['IP_BagliCihazinAdi']; ?></td>
						<td><?php echo ($IPCek['KameraTipi'] == 1) ? "Hərəkətli" : (($IPCek['KameraTipi'] == 2) ? "Sabit" : "") ?></td>
						<td class="cedvelipalani"><?php echo $IPCek['IP_SubnetMask']; ?></td>
						<td class="cedvelipalani"><?php echo $IPCek['IP_DefaultGateway']; ?></td>
						<td class="cedvelipalani"><?php echo $IPCek['IP_NVR']; ?></td>
						<td><?php echo $IPCek['IP_AlarmStatusu']; ?></td>
						<td><?php echo $IPCek['IP_Alarm']; ?></td>
						<td class="cedvelipalani"><?php echo $IPCek['IP_MulticastIpBir']; ?></td>
						<td><?php echo $IPCek['IP_MulticastPortBir']; ?></td>
						<td class="cedvelipalani"><?php echo $IPCek['IP_MulticastIpIki']; ?></td>
						<td><?php echo $IPCek['IP_MulticastPortIki']; ?></td>											
						<td><?php echo TarixAz($IPCek['IstifadeyeVerildiyiTarix']); ?></td>
						<td><?php echo $IPCek['IP_Qeyd']; ?></td>	
						<td>
							<a href="kamera.php?ip=<?php echo $IPCek['IP_IP'] ?>"><button class="cedvel_ici_button cedvel_ici_yesil_button" >Düzəliş</button></a>
							<a href="bax.php?ip=<?php echo $IPCek['IP_IP'] ?>"><button class="cedvel_ici_button cedvel_ici_yesil_button" >Bax</button>							
						</td>

					</tr>
				<?php } ?>
			</tbody>
		</table>
		

	<div class="SayfalamaAlaniKapsayici">
		<div class="SayfalamaAlaniIciMetinAlaniKapsayicisi">
			<?php echo" Aktiv ". $aktivKamera; ?>
		</div>

	</div>	
		<?php } else {
	} ?>		
<?php
	}else{
		header("Location:nvr.php");
	}