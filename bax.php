<?php require_once "_header.php"; ?>
<script src="ButunIpiler/Script.js"></script>
<div id="icerik" class="tablokapsyici">
	<div class="baxipicerik">
		<?php 
		if (isset($_GET['ip'])) {	

			$PingSor           = $db->prepare("SELECT * FROM ping where IP=:IP order by PingTarix DESC");
			$PingSor->execute(array(
				'IP'=>$_GET['ip']));
			while ($PingCek = $PingSor->fetch(PDO::FETCH_ASSOC)) {
				?>

				<div class="ipalanikapsayici" > 
					<div class="ipaalani"><?php echo $PingCek['IP']?></div>
					<div><?php echo TarixSaatAz($PingCek['PingTarix'])?></div>
					<div class=" <?php if ($PingCek['Statusu']==1) {
					echo " arxafonmavi";
				}else{
					echo " arxafonqirmizi";
				} ?>"><?php if ($PingCek['Statusu']==1) {
						echo "OK";
					}else{
						echo "NO";
					} ?></div>
				</div>
			<?php }   }else{
				header("Location:index.php");
			}
			?>

		</div>
	</div>
	<?php require_once '_footer.php' ?>