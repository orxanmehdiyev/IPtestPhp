<?php require_once "_header.php"; ?>
<script src="Pc/Script.js"></script>
<div id="icerik" class="tablokapsyici">
	<?php	
	if (isset($_GET['ip'])) {
		require_once "Pc/edit.php"; 
	}else{
		require_once "Pc/pc.php"; 
	}
	?>	
</div>
<?php require_once '_footer.php' ?>