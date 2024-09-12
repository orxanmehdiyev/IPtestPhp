	<?php 
	if (isset($_SESSION['Sirala'])) {
		$Sirala=$_SESSION['Sirala'];
	} else {
		$Sirala="IpNoktesiz ASC";
	}
	$IPSor                                      =     $db->prepare("SELECT
		ip.ID                                   AS    IP_ID,
		ip.IP                                   AS    IP_IP,	
		ip.IstifadeMeksediID                    AS    IP_IstifadeMeksediID,
		ip.IdareAD                              AS    IP_IdareAD,
		ip.BagliCihazinYeri                     AS    IP_BagliCihazinYeri,
		ip.BagliCihazinMarkasi                  AS    IP_BagliCihazinMarkasi,
		ip.BagliCihazinModeli                   AS    IP_BagliCihazinModeli,
		ip.BagliCihazinMacAdresi                AS    IP_BagliCihazinMacAdresi,
		ip.BagliCihazinAdi                      AS    IP_BagliCihazinAdi,
		ip.BagliCihazinPortSayi                 AS    IP_BagliCihazinPortSayi,
		ip.SubnetMask                           AS    IP_SubnetMask,
		ip.DefaultGateway                       AS    IP_DefaultGateway,
		ip.IstifadeyeVerildiyiTarix             AS    IstifadeyeVerildiyiTarix,
		ip.Qeyd                                 AS    IP_Qeyd,
		ip.Status                               AS    Status,
		ip.SonCavabTarixi                       AS    SonCavabTarixi,
		ip.UserName                             AS    UserName,
		istifademeksedi.IstifadeMeksediID       AS    istifademeksedi_IstifadeMeksediID,
		istifademeksedi.ItifadeYeriAd           AS    istifademeksedi_ItifadeYeriAd
		FROM
		ip
		LEFT JOIN istifademeksedi ON ip.IstifadeMeksediID  = istifademeksedi.IstifadeMeksediID where istifademeksedi.IstifadeMeksediID=:istifademeksedi_IstifadeMeksediID order by $Sirala
		");
	$IPSor->execute(array(
		'istifademeksedi_IstifadeMeksediID'=>7));
	$ToplamSay           = $IPSor->rowCount();
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
					<th class="cedvelstatusalani">Bağlı Cihazın Port Sayı</th>
					<th class="cedvelipalani">Subnet Mask</th>
					<th class="cedvelipalani">Default Gateway</th>		
					<th class="cedvelipalani">User Name</th>		
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
						<td><?php if ($IPCek['SonCavabTarixi']>0) {
							echo $IPCek['istifademeksedi_ItifadeYeriAd'];
						}else{}
						  ?></td>
						<td><?php echo $IPCek['IP_IdareAD']; ?></td>
						<td><?php echo $IPCek['IP_BagliCihazinYeri']; ?></td>
						<td><?php echo $IPCek['IP_BagliCihazinMarkasi']; ?></td>
						<td><?php echo $IPCek['IP_BagliCihazinModeli']; ?></td>
						<td class="macalaniicerik"><?php echo $IPCek['IP_BagliCihazinMacAdresi']; ?></td>
						<td><?php echo $IPCek['IP_BagliCihazinAdi']; ?></td>
						<td><?php echo ($IPCek['IP_BagliCihazinPortSayi']>0)?$IPCek['IP_BagliCihazinPortSayi']:""; ?></td>
						<td class="cedvelipalani"><?php echo $IPCek['IP_SubnetMask']; ?></td>
						<td class="cedvelipalani"><?php echo $IPCek['IP_DefaultGateway']; ?></td>
						<td class="cedvelipalani"><?php echo $IPCek['UserName']; ?></td>
						<td><?php echo $IstifadeteVerlidiyiTarix; ?></td>
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
	<?php } else {
	}
?>