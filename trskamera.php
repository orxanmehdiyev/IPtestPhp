<?php require_once "_header.php"; ?>
<script src="TrsKamera/Script.js"></script>
<div id="icerik" class="tablokapsyici">
	<?php	
	if (isset($_GET['ip'])) {
		require_once "TrsKamera/edit.php"; 
	}else{
		require_once "TrsKamera/trskamera.php"; 
	}
	?>	
</div>
<?php require_once '_footer.php' ?>