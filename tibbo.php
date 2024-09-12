<?php require_once "_header.php"; ?>
<script src="Tibbo/Script.js"></script>
<div id="icerik" class="tablokapsyici">
	<?php	
	if (isset($_GET['ip'])) {
		require_once "Tibbo/edit.php"; 
	}else{
		require_once "Tibbo/tibbo.php"; 
	}
	?>	
</div>
<?php require_once '_footer.php' ?>