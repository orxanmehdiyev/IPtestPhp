	<?php 
	if (isset($_GET['durum'])) {
		if (isset($_GET['ipdeolan'])) {
			$ipdeolan=$_GET['ipdeolan']." nömrəli IP də verdiyiniz";
		}else{
			$ipdeolan="";
		}

		if ($_GET['durum']=='no') {
			echo "<div class='cavabno'>Yenilənmə uğursuz!</div>";
		}else if($_GET['durum']=='alarmno'){
			echo "<div class='cavabno'>Yenilənmə uğursuz! ".$ipdeolan." alarm mövcutdur</div>";
		}else if($_GET['durum']=='muipbirmno'){
			echo "<div class='cavabno'>Yenilənmə uğursuz! ".$ipdeolan." multicast IP bir mövcutdur</div>";
		}else if($_GET['durum']=='muipikimno'){
			echo "<div class='cavabno'>Yenilənmə uğursuz! ".$ipdeolan." multicast IP iki mövcutdur</div>";
		}else if($_GET['durum']=='muipportbirmno'){
			echo "<div class='cavabno'>Yenilənmə uğursuz! ".$ipdeolan." multicast port bir mövcutdur</div>";
		}else if($_GET['durum']=='muipportikimno'){
			echo "<div class='cavabno'>Yenilənmə uğursuz! ".$ipdeolan." multicast port iki mövcutdur</div>";
		}else if($_GET['durum']=='alarmststusno'){
			echo "<div class='cavabno'>Yenilənmə uğursuz! ".$ipdeolan." alarm status mövcutdur</div>";
		}else if($_GET['durum']=='multiipno'){
			echo "<div class='cavabno'>Yenilənmə uğursuz! Multicast IP-lər bərabərdir</div>";
		}else if($_GET['durum']=='ipbiripikidevar'){
			echo "<div class='cavabno'>Yenilənmə uğursuz! ".$ipdeolan." multicast IP bir Multicast IP ikidə var </div>";
		}else if($_GET['durum']=='ipikiipbirdevar'){
			echo "<div class='cavabno'>Yenilənmə uğursuz! ".$ipdeolan." multicast IP iki Multicast IP birdə var </div>";
		}else if($_GET['durum']=='multiportbirikidevar'){
			echo "<div class='cavabno'>Yenilənmə uğursuz! ".$ipdeolan." multicast port bir multicast port ikidə var </div>";
		}else if($_GET['durum']=='multicastportberaber'){
			echo "<div class='cavabno'>Yenilənmə uğursuz! Multicast portlar bərabər ola bilməz </div>";
		}else if($_GET['durum']=='multiportikibirdevar'){
			echo "<div class='cavabno'>Yenilənmə uğursuz! ".$ipdeolan." multicast port iki multicast port birdə var </div>";
		}
	} ?>
	<form method="POST" action="TrsKamera/editislem.php">	
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
					<label class="editlabel">İstifadə məqsədi:</label>
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
					<label class="editlabel">Cihazın markası:</label>
					<input class="editinput" type="text" name="BagliCihazinMarkasi" value="<?php echo $Cek['BagliCihazinMarkasi'] ?>">
				</div>

				<div class="editsetiralani">
					<label class="editlabel">Cihazın modeli:</label>
					<input class="editinput" type="text" name="BagliCihazinModeli" value="<?php echo $Cek['BagliCihazinModeli'] ?>">
				</div>


				<div class="editsetiralani">
					<label class="editlabel">Cihazın mac adresi:</label>
					<input class="editinput" type="text" name="BagliCihazinMacAdresi" value="<?php echo $Cek['BagliCihazinMacAdresi'] ?>">
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
					<label class="editlabel">Kamera Tipi:</label>
					<select class="editinput" name="KameraTipi">
						<option <?php if ($Cek['KameraTipi']==0) {echo "selected";} ?>	 value="0"></option>
						<option <?php if ($Cek['KameraTipi']==1) {echo "selected";} ?>	 value="1">Hərəkətli</option>
						<option <?php if ($Cek['KameraTipi']==2) {echo "selected";} ?>	 value="2">Sabit</option>
					</select>
				</div>

				<div class="editsetiralani">
					<label class="editlabel">Multicast address 1:</label>
					<input class="editinput" type="text" name="MulticastIpBir" value="<?php echo $Cek['MulticastIpBir'] ?>">
				</div>


				<div class="editsetiralani">
					<label class="editlabel">Multicast port 1:</label>
					<input class="editinput" type="number" name="MulticastPortBir" value="<?php echo $Cek['MulticastPortBir'] ?>">
				</div>


				<div class="editsetiralani">
					<label class="editlabel">Multicast address 2:</label>
					<input class="editinput" type="text" name="MulticastIpIki" value="<?php echo $Cek['MulticastIpIki'] ?>">
				</div>


				<div class="editsetiralani">
					<label class="editlabel">Multicast port 2:</label>
					<input class="editinput" type="number" name="MulticastPortIki" value="<?php echo $Cek['MulticastPortIki'] ?>">
				</div>



				<div class="editsetiralani">
					<label class="editlabel">İstifadəyə verildiyi tarix:</label>
					<input class="editinput" type="date" name="IstifadeyeVerildiyiTarix" value="<?php echo $Cek['IstifadeyeVerildiyiTarix'] ?>">
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