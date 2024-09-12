<?php require_once "_header.php"; ?>
<script src="Nvr/Script.js"></script>
<div id="icerik" class="tablokapsyici">
	<?php	
	if (isset($_GET['ip'])) {
		require_once "Nvr/edit.php"; 
	}else if(isset($_GET['kamerabaxip'])){
		require_once "Nvr/kamerabaxip.php"; 
	}
	else{
		require_once "Nvr/nvr.php"; 
	}
	?>	
</div>
<?php require_once '_footer.php' ?>