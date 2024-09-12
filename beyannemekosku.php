<?php require_once "_header.php"; ?>
<script src="BeyannameKosku/Script.js"></script>
<div id="icerik" class="tablokapsyici">
	<?php	
	if (isset($_GET['ip'])) {
		require_once "BeyannameKosku/edit.php"; 
	}else{
		require_once "BeyannameKosku/BeyannameKosku.php"; 
	}
	?>	
</div>
<?php require_once '_footer.php' ?>