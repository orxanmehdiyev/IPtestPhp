<?php require_once "_header.php"; ?>
<script src="Switch/Script.js"></script>
<div id="icerik" class="tablokapsyici">	
	<?php 
	if (isset($_GET['durum'])) {
		if ($_GET['durum']=='no') {?>
			<div class="cavabno">Yenilənmə uğursuz</div>
		<?php 	}
	} ?>
	<form method="POST" action="editislem.php">	
		<?php 
		if (isset($_GET['ip'])) {	
			$Sor=$db->prepare("SELECT * FROM ip where IP=:IP LIMIT 1");
			$Sor->execute(array(
				'IP'=>$_GET['ip']));
			$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
			?>
			<input type="hidden" name="ID" value="<?php echo $Cek['ID'] ?>">
			<input type="hidden" name="ip" value="<?php echo $Cek['IP'] ?>">
			<div  class="editkapsayici">
				<div class="editsetiralani">
					<label class="editlabel">IP:</label>
					<input class="editinput" type="" name="" value="<?php echo $Cek['IP'] ?>" disabled >	
				</div>
				<div class="editsetiralani">
					<label class="editlabel">İstifadə məksədi:</label>
					<select class="editinput" name="IstifadeMeksediID">
						<?php 
						$IstifadeMeksediSor=$db->prepare("SELECT * FROM istifademeksedi order by ItifadeYeriAd ASC");
						$IstifadeMeksediSor->execute();
						while ($IstifadeMeksediCek=$IstifadeMeksediSor->fetch(PDO::FETCH_ASSOC)) {	?>
							<option
							<?php if ($IstifadeMeksediCek['IstifadeMeksediID']==$Cek['IstifadeMeksediID']) {
								echo "selected";
							} ?>
							value="<?php echo $IstifadeMeksediCek['IstifadeMeksediID']  ?>"> <?php echo $IstifadeMeksediCek['ItifadeYeriAd'] ?></option>;
						<?php }
						?>
					</select>
				</div>
				<div class="editsetiralani">
					<label class="editlabel">İdarə adı:</label>
					<input class="editinput" type="text" name="IdareAD"  value="<?php echo $Cek['IdareAD'] ?>">
				</div>

				<div class="editsetiralani">
					<label class="editlabel">Bağlı cihazın yeri:</label>
					<input class="editinput" type="text" name="BagliCihazinYeri" value="<?php echo $Cek['BagliCihazinYeri'] ?>">
				</div>

				<div class="editsetiralani">
					<label class="editlabel">Bağlı cihazın markası:</label>
					<input class="editinput" type="text" name="BagliCihazinMarkasi" value="<?php echo $Cek['BagliCihazinMarkasi'] ?>">
				</div>

				<div class="editsetiralani">
					<label class="editlabel">Bağlı cihazın modeli:</label>
					<input class="editinput" type="text" name="BagliCihazinModeli" value="<?php echo $Cek['BagliCihazinModeli'] ?>">
				</div>


				<div class="editsetiralani">
					<label class="editlabel">Bağlı cihazın mac adresi:</label>
					<input class="editinput" type="text" name="BagliCihazinMacAdresi" value="<?php echo $Cek['BagliCihazinMacAdresi'] ?>">
				</div>


				<div class="editsetiralani">
					<label class="editlabel">Bağlı cihazın adı:</label>
					<input class="editinput" type="text" name="BagliCihazinAdi" value="<?php echo $Cek['BagliCihazinAdi'] ?>">
				</div>


				<div class="editsetiralani">
					<label class="editlabel">Bağlı cihazın port sayı:</label>
					<input class="editinput" type="text" name="BagliCihazinPortSayi" value="<?php echo $Cek['BagliCihazinPortSayi'] ?>">
				</div>

				<div class="editsetiralani">
					<label class="editlabel">Subnet Mask:</label>
					<input class="editinput" type="text" name="SubnetMask" value="<?php echo $Cek['SubnetMask'] ?>">
				</div>


				<div class="editsetiralani">
					<label class="editlabel">Default Gateway:</label>
					<input class="editinput" type="text" name="DefaultGateway" value="<?php echo $Cek['DefaultGateway'] ?>">
				</div>

				<div class="editsetiralani">
					<label class="editlabel">NVR:</label>
					<select class="editinput" name="NVR">
						<option value="0"></option>
						<?php 
						$nvrsor=$db->prepare("SELECT * FROM ip where IstifadeMeksediID=:IstifadeMeksediID");
						$nvrsor->execute(array(
							'IstifadeMeksediID'=>6));
							while($nvrcek=$nvrsor->fetch(PDO::FETCH_ASSOC)){?>
								<option <?php if ($nvrcek['IP']==$Cek['NVR']) {echo "selected";} ?>	 value="<?php echo $nvrcek['IP'];?>"><?php echo $nvrcek['IP'];?></option>
							<?php }
							?>
						</select>
					</div>

					<div class="editsetiralani">
						<label class="editlabel">NVR status:</label>
						<select class="editinput" name="NVR_Status">
							<option <?php if ($Cek['NVR_Status']==0) {echo "selected";} ?>	 value="0">Boş</option>
							<option <?php if ($Cek['NVR_Status']==1) {echo "selected";} ?>	 value="1">Yazır</option>
							<option <?php if ($Cek['NVR_Status']==2) {echo "selected";} ?>	 value="2">Yazmır</option>
						</select>
					</div>

						<div class="editsetiralani">
						<label class="editlabel">Kamera Tipi:</label>
						<select class="editinput" name="KameraTipi">
							<option <?php if ($Cek['KameraTipi']==0) {echo "selected";} ?>	 value="0"></option>
							<option <?php if ($Cek['KameraTipi']==1) {echo "selected";} ?>	 value="1">Hərəkətli</option>
							<option <?php if ($Cek['KameraTipi']==2) {echo "selected";} ?>	 value="2">Sabit</option>
						</select>
					</div>



					<div class="editsetiralani">
						<label class="editlabel">Alarm status:</label>
						<input class="editinput" type="text" name="AlarmStatusu" value="<?php echo $Cek['AlarmStatusu'] ?>">
					</div>


					<div class="editsetiralani">
						<label class="editlabel">Alarm:</label>
						<input class="editinput" type="text" name="Alarm" value="<?php echo $Cek['Alarm'] ?>">
					</div>

					<div class="editsetiralani">
						<label class="editlabel">Multicast IP bir:</label>
						<input class="editinput" type="text" name="MulticastIpBir" value="<?php echo $Cek['MulticastIpBir'] ?>">
					</div>


					<div class="editsetiralani">
						<label class="editlabel">Multicast port bir:</label>
						<input class="editinput" type="text" name="MulticastPortBir" value="<?php echo $Cek['MulticastPortBir'] ?>">
					</div>


					<div class="editsetiralani">
						<label class="editlabel">Multicast IP iki:</label>
						<input class="editinput" type="text" name="MulticastIpIki" value="<?php echo $Cek['MulticastIpIki'] ?>">
					</div>


					<div class="editsetiralani">
						<label class="editlabel">Multicast port iki:</label>
						<input class="editinput" type="text" name="MulticastPortIki" value="<?php echo $Cek['MulticastPortIki'] ?>">
					</div>


					<div class="editsetiralani">
						<label class="editlabel">İstifadəci adı (User name):</label>
						<input class="editinput" type="text" name="UserName" value="<?php echo $Cek['UserName'] ?>">
					</div>


					<div class="editsetiralani">
						<label class="editlabel">RAM:</label>
						<input class="editinput" type="text" name="RAM" value="<?php echo $Cek['RAM'] ?>">
					</div>


					<div class="editsetiralani">
						<label class="editlabel">Disk həcmi:</label>
						<input class="editinput" type="text" name="DiskHecmi" value="<?php echo $Cek['DiskHecmi'] ?>">
					</div>

					<div class="editsetiralani">
						<label class="editlabel">Processor:</label>
						<input class="editinput" type="text" name="Processor" value="<?php echo $Cek['Processor'] ?>">
					</div>

					<div class="editsetiralani">
						<label class="editlabel">İstifadəyə verildiyi tarix:</label>
						<input class="editinput" type="date" name="IstifadeyeVerildiyiTarix" value="<?php echo $Cek['IstifadeyeVerildiyiTarix'] ?>">
					</div>

					<div class="editsetiralani">
						<label class="editlabel">Son cavab tarixi:</label>
						<input class="editinput" type="text" name="" disabled value="<?php echo $Cek['SonCavabTarixi'] ?>">
					</div>

					

					<div class="editsetiralani editqeydalani">
						<label class="editlabel ">Qeyd:</label>
						<textarea name="Qeyd" class="edittextarea " rows="auto" ><?php echo $Cek['Qeyd'] ?></textarea>
					</div>




					<div class="editsetiralani editqeydalani">
						<button name="yelile">Yenilə</button>
					</div>





				</div>



				<?php 
			}else{
				header("Location:index.php");
			}
			?>



		</form>
	</div>
	<?php require_once '_footer.php' ?>