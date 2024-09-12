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
	<form method="POST" action="BeyannameKosku/editislem.php">	
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
					<label class="editlabel">İstifadə olunduğu yer:</label>
					<input class="editinput" type="text" name="BagliCihazinYeri" value="<?php echo $Cek['BagliCihazinYeri'] ?>">
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
					<label class="editlabel">RAM (GB):</label>
					<input class="editinput" type="number" name="RAM" value="<?php echo $Cek['RAM'] ?>">
				</div>

				<div class="editsetiralani">
					<label class="editlabel">Disk Həcmi (GB):</label>
					<input class="editinput" type="number" name="DiskHecmi" value="<?php echo $Cek['DiskHecmi'] ?>">
				</div>

				<div class="editsetiralani">
					<label class="editlabel">Disk Tipi:</label>
					<input class="editinput" type="text" name="Disk_Tipi" value="<?php echo $Cek['Disk_Tipi'] ?>">
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
					<label class="editlabel">Telefon No:</label>
					<input class="editinput" type="number" name="TelefonNo" value="<?php echo $Cek['TelefonNo'] ?>">
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