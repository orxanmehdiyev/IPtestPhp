<?php 
if ($_POST['edit'] && $_POST['id']) {
	require_once "../Setting/baglan.php"; 
	require_once "../Setting/function.php";
	$Sor=$db->prepare("SELECT * FROM ip where ID=:ID LIMIT 1");
	$Sor->execute(array(
		'ID'=>$_POST['id']));
	if ($Sor->rowCount()===1) {	
		$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
		?>
		<form>
			<div class="ModalIciSetirAlani">
				<div class="ModalInputKapsayici">
					<label class="ModalLabel">IP:</label>
					<input type="text" name="" class="ModalInput" value="<?php echo $Cek['IP'] ?>" disabled >
				</div>
				<div class="ModalInputKapsayici">
					<label class="ModalLabel">İstifadə məksədi:</label>
					<select class="ModalInput" id="IstifadeMeksediID" tabindex="2">
						<?php 
						$IstifadeMeksediSor=$db->prepare("SELECT * FROM istifademeksedi order by ItifadeYeriAd ASC");
						$IstifadeMeksediSor->execute();
						while ($IstifadeMeksediCek=$IstifadeMeksediSor->fetch(PDO::FETCH_ASSOC)) {	?>
							<option
							<?php if ($IstifadeMeksediCek['IstifadeMeksediID']==$Cek['IstifadeMeksediID']) {
								echo "selected";
							} ?>
							value="<?php echo $IstifadeMeksediCek['IstifadeMeksediID']  ?>"> <?php echo $IstifadeMeksediCek['ItifadeYeriAd'] ?></option>;
						<?php }	?>
					</select>
				</div>
			</div>


			<div class="ModalIciSetirAlani">
				<div class="ModalInputKapsayici">
					<label class="ModalLabel">İdarə adı:</label>
					<input type="text" id="IdareAD" tabindex="1" class="ModalInput" value="<?php echo $Cek['IdareAD'] ?>">
				</div>
				<div class="ModalInputKapsayici">
					<label class="ModalLabel">Cihazın markası:</label>
					<input type="text" id="BagliCihazinMarkasi" tabindex="3" class="ModalInput" value="<?php echo $Cek['BagliCihazinMarkasi'] ?>">
				</div>
			</div>

			<div class="ModalIciSetirAlani">
				<div class="ModalInputKapsayici">
					<label class="ModalLabel">Cihazın modeli:</label>
					<input type="text" id="BagliCihazinModeli" tabindex="4" class="ModalInput" value="<?php echo $Cek['BagliCihazinModeli'] ?>">
				</div>
				<div class="ModalInputKapsayici">
					<label class="ModalLabel">Cihazın adı:</label>
					<input type="text" id="BagliCihazinAdi" tabindex="5" class="ModalInput" value="<?php echo $Cek['BagliCihazinAdi'] ?>">
				</div>
			</div>

			<div class="ModalIciSetirAlani">
				<div class="ModalInputKapsayici">
					<label class="ModalLabel">Subnet Mask:</label>
					<input type="text" id="SubnetMask" tabindex="6" class="ModalInput" value="<?php echo $Cek['SubnetMask'] ?>">
				</div>

				<div class="ModalInputKapsayici">
					<label class="ModalLabel">Default Gateway:</label>
					<input type="text" id="DefaultGateway" tabindex="7" class="ModalInput" value="<?php echo $Cek['DefaultGateway'] ?>">
				</div>			
			</div> 

			<div class="ModalIciSetirAlani">
				<div class="ModalInputKapsayici">
					<label class="ModalLabel">NVR:</label>
					<select class="ModalInput" id="NVR">
						<option value=""></option>
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
					<div class="ModalInputKapsayici">
						<label class="ModalLabel">Kamera Tipi:</label>
						<select class="ModalInput" id="KameraTipi">
							<option <?php if ($Cek['KameraTipi']==0) {echo "selected";} ?>	 value="0"></option>
							<option <?php if ($Cek['KameraTipi']==1) {echo "selected";} ?>	 value="1">Hərəkətli</option>
							<option <?php if ($Cek['KameraTipi']==2) {echo "selected";} ?>	 value="2">Sabit</option>
						</select>
					</div>
				</div> 

				<div class="ModalIciSetirAlani">
					<div class="ModalInputKapsayici">
						<label class="ModalLabel">Status reception port:</label>
						<input type="number" min="0" max="99999" id="AlarmStatusu" tabindex="10" class="ModalInput" value="<?php echo $Cek['AlarmStatusu'] ?>">
					</div>

					<div class="ModalInputKapsayici">
						<label class="ModalLabel">Reception port:</label>
						<input type="number" id="Alarm" min="0" max="99999" tabindex="11" class="ModalInput" value="<?php echo $Cek['Alarm'] ?>">
					</div>
				</div> 


				<div class="ModalIciSetirAlani">
					<div class="ModalInputKapsayici">
						<label class="ModalLabel">Multicast address 1:</label>
						<input type="text" id="MulticastIpBir" tabindex="10" class="ModalInput" value="<?php echo $Cek['MulticastIpBir'] ?>">
					</div>

					<div class="ModalInputKapsayici">
						<label class="ModalLabel">Multicast port 1:</label>
						<input type="number" min="0" max="99999" id="MulticastPortBir" tabindex="11" class="ModalInput" value="<?php echo $Cek['MulticastPortBir'] ?>">
					</div>
				</div>



				<div class="ModalIciSetirAlani">
					<div class="ModalInputKapsayici">
						<label class="ModalLabel">Multicast address 2:</label>
						<input type="text" id="MulticastIpIki" tabindex="10" class="ModalInput" value="<?php echo $Cek['MulticastIpIki'] ?>">
					</div>

					<div class="ModalInputKapsayici">
						<label class="ModalLabel">Multicast port 2:</label>
						<input type="number" min="0" max="99999" id="MulticastPortIki" tabindex="11" class="ModalInput" value="<?php echo $Cek['MulticastPortIki'] ?>">
					</div>
				</div>

				<div class="ModalIciSetirAlani">
					<div class="ModalInputKapsayici">
						<label class="ModalLabel">İstifadəyə verildiyi tarix:</label>
						<input type="date" id="IstifadeyeVerildiyiTarix" tabindex="10" class="ModalInput" value="<?php echo $Cek['IstifadeyeVerildiyiTarix'] ?>">
					</div>

					<div class="ModalInputKapsayici">
						<label class="ModalLabel">Son Düzəliş Tarixi:</label>
						<input type="text" id="SonDuzelisTarixi" tabindex="10" class="ModalInput"disabled value="<?php echo TarixSaatAz($Cek['SonDuzelisTarixi']) ?>">
					</div>


				</div>



				<div class="ModalIciSetirAlani">
					<div class="ModalInputKapsayici">
						<label class="ModalLabel">Bağlı cihazın mac adresi:</label>
						<input type="text" name="" class="ModalInput" value="<?php echo $Cek['BagliCihazinMacAdresi'] ?>" disabled>
					</div>

					<div class="ModalInputKapsayici">
						<label class="ModalLabel">Son cavab tarixi:</label>
						<input type="text" name="" class="ModalInput" disabled value="<?php echo TarixSaatAz($Cek['SonCavabTarixi']) ?>">
					</div>
				</div> 


				<div class="ModalIciSetirAlani">
					<div class="ModalInputKapsayici">
						<label class="ModalLabel">Qeyd:</label>
						<textarea id="Qeyd" tabindex="12" class="ModalTextarea" rows="auto" ><?php echo $Cek['Qeyd'] ?></textarea>
					</div>		
				</div> 

				<div class="ModalIciButtonAlani">
					<div class="ModalButtonKapsayici">
						<button type="button" class="ButtonEdit" tabindex="13" onClick="SwichEdit(<?php echo $Cek['ID']; ?>, this.form)">Qeydə Al</button>
					</div>	

					<div class="ModalButtonKapsayici">
						<button type="button" class="ButtonCancel" tabindex="14" onClick="Close()">İmtina Et</button>
					</div>	
				</div> 
				<div id="errorqeyd"></div>
			</form>
		<?php }else{
			echo "sayno";
		}

	}else{
		echo "postno";
	} ?>

