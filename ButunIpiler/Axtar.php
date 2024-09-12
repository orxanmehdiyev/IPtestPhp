
<?php 
require_once '../Setting/baglan.php';
require_once "../Setting/function.php"; 
if (isset($_POST['axtar'])) {
	$deyer               			= json_decode($_POST['axtar'], true);
	$Axtar_IPB=ip2long($deyer['Axtar_IPB']);
	$Axtar_IPS=ip2long($deyer['Axtar_IPS']);

	if (isset($_SESSION['Sirala'])) {
		$Sirala=$_SESSION['Sirala'];
	} else {
		$Sirala="IpNoktesiz ASC";
	}

	if ($Axtar_IPB>0 and $Axtar_IPS>0) {
		$AxtarisDeyer="LEFT JOIN istifademeksedi ON ip.IstifadeMeksediID  = istifademeksedi.IstifadeMeksediID where IpNoktesiz>=$Axtar_IPB and IpNoktesiz<=$Axtar_IPS order by $Sirala";
	}else if ($Axtar_IPB>0) {
		$AxtarisDeyer="LEFT JOIN istifademeksedi ON ip.IstifadeMeksediID  = istifademeksedi.IstifadeMeksediID where IpNoktesiz=$Axtar_IPB order by $Sirala";
	}else if ($Axtar_IPS>0) {
		$AxtarisDeyer="LEFT JOIN istifademeksedi ON ip.IstifadeMeksediID  = istifademeksedi.IstifadeMeksediID where IpNoktesiz=$Axtar_IPB order by $Sirala";
		$AxtarsiFitri="'Axtar_IPS'=>$Axtar_IPS";
	}else{
		header("Location:index.php");
	}
	if (isset($_REQUEST['Sayfalama'])) {
		$GelenSayfalama=$_REQUEST['Sayfalama'];
	}else{
		$GelenSayfalama=1;
	}		
	$IPSor                    = $db->prepare("SELECT
		ip.ID 							    	AS 		IP_ID,
		ip.IP 									AS 		IP_IP,
		ip.IpNoktesiz 							AS 		IpNoktesiz,
		ip.IstifadeMeksediID 				    AS 		IP_IstifadeMeksediID,
		ip.IdareAD 								AS 		IP_IdareAD,
		ip.Teyinati 							AS 		Teyinati,
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
		$AxtarisDeyer
		");
	$IPSor->execute();
	if ($IPSor->rowCount() > 0) {
		?>
		<input type="hidden" name="" id="Axtar_IPBGiz" value="<?php echo $deyer['Axtar_IPB'] ?>">
		<input type="hidden" name="" id="Axtar_IPSGiz" value="<?php echo $deyer['Axtar_IPS'] ?>">

		<table class="table">
			<thead>
				<tr>				
					<th onclick="AxtarIpSirala()" class="cedvelipalani">IP</th>
					<th onclick="AxtarStatusSirala()" class="cedvelstatusalani" >Status</th>
					<th onclick="AxtarSonCavabTarixiSirala()" class="soncavabtarixialani">Son Cavab Tarixi</th>
					<th class="cedvelistifademeksedialani">İstifadə Məksədi</th>					
					<th>İdarə</th>
					<th>Təyinatı</th>
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
					<th  onclick="AxtarIstifadeyeVerildiyiTarix()">İstifadəyə Verildiyi tarix</th>
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
						<td><?php echo $IPCek['Teyinati']; ?></td>
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
								<?php 
								if ($IPCek['istifademeksedi_IstifadeMeksediID']==3) {
									$link="kamera.php?ip=";
								}else if($IPCek['istifademeksedi_IstifadeMeksediID']==7){
									$link="switch.php?ip=";
								}
								else{
									$link="edit.php?ip=";
								}

								?>
								<a href="<?php echo $link.$IPCek['IP_IP'] ?>"><button class="cedvel_ici_button cedvel_ici_yesil_button" >Düzəliş</button></a>
								<a href="bax.php?ip=<?php echo $IPCek['IP_IP'] ?>"><button class="cedvel_ici_button cedvel_ici_yesil_button" >Bax</button></a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			
		<?php }else{} ?>
		
	<?php }else{

	} ?>
