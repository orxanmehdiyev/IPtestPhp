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
				<label class="ModalLabel">Bağlı cihazın yeri:</label>
				<input type="text" id="BagliCihazinYeri" tabindex="3" class="ModalInput" value="<?php echo $Cek['BagliCihazinYeri'] ?>">
			</div>
		</div>

		<div class="ModalIciSetirAlani">
			<div class="ModalInputKapsayici">
				<label class="ModalLabel">Bağlı cihazın markası:</label>
				<input type="text" id="BagliCihazinMarkasi" tabindex="4" class="ModalInput" value="<?php echo $Cek['BagliCihazinMarkasi'] ?>">
			</div>
			<div class="ModalInputKapsayici">
				<label class="ModalLabel">Bağlı cihazın modeli:</label>
				<input type="text" id="BagliCihazinModeli" tabindex="5" class="ModalInput" value="<?php echo $Cek['BagliCihazinModeli'] ?>">
			</div>
		</div>

		<div class="ModalIciSetirAlani">
			<div class="ModalInputKapsayici">
				<label class="ModalLabel">Bağlı cihazın adı:</label>
				<input type="text" id="BagliCihazinAdi" tabindex="6" class="ModalInput" value="<?php echo $Cek['BagliCihazinAdi'] ?>">
			</div>

			<div class="ModalInputKapsayici">
				<label class="ModalLabel">User Name:</label>
				<input type="text" id="UserName" tabindex="7" class="ModalInput" value="<?php echo $Cek['UserName'] ?>">
			</div>			
		</div> 

		<div class="ModalIciSetirAlani">
			<div class="ModalInputKapsayici">
				<label class="ModalLabel">Bağlı cihazın port sayı:</label>
				<input type="number" min="0" max="56" id="BagliCihazinPortSayi" tabindex="8" class="ModalInput" value="<?php echo $Cek['BagliCihazinPortSayi']>0?$Cek['BagliCihazinPortSayi']:"" ?>">
			</div>
			<div class="ModalInputKapsayici">
				<label class="ModalLabel">Subnet Mask:</label>
				<input type="text" id="SubnetMask" tabindex="9" class="ModalInput" value="<?php echo $Cek['SubnetMask'] ?>">
			</div>
		</div> 

		<div class="ModalIciSetirAlani">
			<div class="ModalInputKapsayici">
				<label class="ModalLabel">Default Gateway:</label>
				<input type="text" id="DefaultGateway" tabindex="10" class="ModalInput" value="<?php echo $Cek['DefaultGateway'] ?>">
			</div>

			<div class="ModalInputKapsayici">
				<label class="ModalLabel">İstifadəyə verildiyi tarix:</label>
				<input type="date" id="IstifadeyeVerildiyiTarix" tabindex="11" class="ModalInput" value="<?php echo $Cek['IstifadeyeVerildiyiTarix'] ?>">
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
				<button type="button" class="ButtonEdit" tabindex="13" onClick="SwichEdit(<?php echo $Cek['ID']; ?>, this.form)">Yadda Saxla</button>
			</div>	

			<div class="ModalButtonKapsayici">
				<button type="button" class="ButtonCancel" tabindex="14" onClick="Close()">İmtina Et</button>
			</div>	
		</div> 
</form>
	<?php }else{
		echo "sayno";
	}

}else{
	echo "postno";
} ?>

