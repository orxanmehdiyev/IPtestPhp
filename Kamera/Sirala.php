<?php
require_once '../Setting/baglan.php';
require_once "../Setting/function.php";
if (isset($_POST['sirala'])) {	
	$Sirala=sirala($_POST['sirala']);

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
		ip.SonDuzelisTarixi                     AS 		SonDuzelisTarixi,
		istifademeksedi.IstifadeMeksediID       AS 		istifademeksedi_IstifadeMeksediID,
		istifademeksedi.ItifadeYeriAd           AS 		istifademeksedi_ItifadeYeriAd
		FROM
		ip
		LEFT JOIN istifademeksedi ON ip.IstifadeMeksediID  = istifademeksedi.IstifadeMeksediID where istifademeksedi.IstifadeMeksediID=:istifademeksedi_IstifadeMeksediID order by $Sirala 		");
	$IPSor->execute(array(
		'istifademeksedi_IstifadeMeksediID'=>3));
	$ToplamSay           = $IPSor->rowCount();
	if ($ToplamSay > 0) {
		$aktivKamera=0;
		
		?>
		<table class="table">
			<thead>
				<tr>				
					<th onclick="Sirala('IpNoktesiz')" class="cedvelipalani">IP</th>
					<th onclick="Sirala('StatusSirala')" class="cedvelstatusalani" >Status</th>
					<th onclick="Sirala('SonCavabTarixiSirala')">Son Cavab Tarixi</th>
					<th onclick="Sirala('IstifadeMeksediID')"class="cedvelistifademeksedialani">İstifadə Məqsədi</th>					
					<th onclick="Sirala('IdareAD')">İdarə</th>
					<th onclick="Sirala('BagliCihazinMarkasi')">Cihazın Markası</th>
					<th onclick="Sirala('BagliCihazinModeli')">Cihazın Modeli</th>
					<th onclick="Sirala('BagliCihazinMacAdresi')" class="macalani">MAC</th>
					<th onclick="Sirala('BagliCihazinAdi')">Cihazın Adı</th>					
					<th onclick="Sirala('KameraTipi')">Kamera Tipi</th>
					<th onclick="Sirala('SubnetMask')" class="cedvelipalani">Subnet Mask</th>
					<th onclick="Sirala('DefaultGateway')" class="cedvelipalani">Default Gateway</th>
					<th onclick="Sirala('NVR')" class="cedvelipalani">NVR</th>
					<th onclick="Sirala('AlarmStatusu')"> Status reception port</th>
					<th onclick="Sirala('Alarm')">Alarm</th>
					<th onclick="Sirala('MulticastIpBir')" class="cedvelipalani">Multicast address 1</th>
					<th onclick="Sirala('MulticastPortBir')">Multicast Port 1</th>
					<th onclick="Sirala('MulticastIpIki')" class="cedvelipalani">Multicast address 2</th>
					<th onclick="Sirala('MulticastPortIki')">Multicast Port 2</th>								
					<th onclick="Sirala('IstifadeyeVerildiyiTarix')">İstifadəyə Verildiyi tarix</th>
					<th onclick="Sirala('SonDuzelisTarixi')">Son Yenilənmə</th>
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
					<tr id="<?php echo "daimiseneddouble_" . $IPCek['IP_ID']; ?>" ondblclick="Bax(this.id)">
						<td class="cedvelipalani"><?php echo $IPCek['IP_IP']; ?></td>
						<td class="<?php echo ($Status == "A") ? "arxafonyail" : (($Status == "P" && $IPCek['SonCavabTarixi'] > 0) ? "bcred" : ""); ?>"><?php echo $Status; ?></td>
						<td><?php echo TarixSaatAz($IPCek['SonCavabTarixi']); ?></td>						
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
						<td><?php echo TarixSaatAz($IPCek['IstifadeyeVerildiyiTarix']); ?></td>
						<td><?php echo TarixSaatAz($IPCek['SonDuzelisTarixi']); ?></td>
						<td><?php echo $IPCek['IP_Qeyd']; ?></td>	
						<td>							
							<button id="<?php echo $IPCek['IP_ID'] ?>" class="cedvel_ici_button cedvel_ici_yesil_button "onclick="EditFunction(this.id)" > <span class="icon">&#9998;</span></button>
							<a href="bax.php?ip=<?php echo $IPCek['IP_IP'] ?>">
								<button class="cedvel_ici_button cedvel_ici_yesil_button" ><span class="icon">&#128065;</span></button>	
							</a>
							<!--<button class="cedvel_ici_button cedvel_ici_kirmizi_button"><span class="icon">&#10060;</span></button>-->
						</td>

						</tr>
					<?php } ?>
				</tbody>
			</table>
		<div></div>
	<?php } else {
	} ?>
	<div class="SayfalamaAlaniKapsayici">
		<div class="SayfalamaAlaniIciMetinAlaniKapsayicisi">
			<?php echo" Aktiv ". $aktivKamera; ?>
		</div>

	</div>
<?php } else {
} ?>