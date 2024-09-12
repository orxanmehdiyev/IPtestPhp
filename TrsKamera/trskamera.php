	<?php
	if (isset($_SESSION['Sirala'])) {
		$Sirala=$_SESSION['Sirala'];
	} else {
		$Sirala="IpNoktesiz ASC";
	}
	if (isset($_GET['durum'])) {
		if ($_GET['durum']=='ok') {
			echo '<div class="cavabok">Yenilənmə uğurlu</div>';
		}
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
		LEFT JOIN istifademeksedi ON ip.IstifadeMeksediID  = istifademeksedi.IstifadeMeksediID where istifademeksedi.IstifadeMeksediID=:istifademeksedi_IstifadeMeksediID order by $Sirala
		");
	$IPSor->execute(array(
		'istifademeksedi_IstifadeMeksediID'=>8));
	$ToplamSay           = $IPSor->rowCount();
	if ($ToplamSay > 0) {
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
					<th>Kamera Tipi</th>
					<th class="cedvelipalani">Subnet Mask</th>
					<th class="cedvelipalani">Default Gateway</th>					
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
						<td><?php echo $IPCek['IP_BagliCihazinMarkasi']; ?></td>
						<td><?php echo $IPCek['IP_BagliCihazinModeli']; ?></td>
						<td class="macalaniicerik"><?php echo $IPCek['IP_BagliCihazinMacAdresi']; ?></td>
						<td><?php echo $KameraTipi ?></td>
						<td class="cedvelipalani"><?php echo $IPCek['IP_SubnetMask']; ?></td>
						<td class="cedvelipalani"><?php echo $IPCek['IP_DefaultGateway']; ?></td>
						<td class="cedvelipalani"><?php echo $IPCek['IP_MulticastIpBir']; ?></td>
						<td><?php echo $IPCek['IP_MulticastPortBir']; ?></td>
						<td class="cedvelipalani"><?php echo $IPCek['IP_MulticastIpIki']; ?></td>
						<td><?php echo $IPCek['IP_MulticastPortIki']; ?></td>											
						<td><?php echo $IstifadeteVerlidiyiTarix; ?></td>
						<td><?php echo $IPCek['IP_Qeyd']; ?></td>	
						<td>
							<a href="trskamera.php?ip=<?php echo $IPCek['IP_IP'] ?>"><button class="cedvel_ici_button cedvel_ici_yesil_button" ><span class="icon">&#9998;</span></button></a>
							<a href="bax.php?ip=<?php echo $IPCek['IP_IP'] ?>"><button class="cedvel_ici_button cedvel_ici_yesil_button" ><span class="icon">&#128065;</span></button></a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		
	<?php } else {
	} ?>			

