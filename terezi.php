<?php require_once "_header.php"; ?>
<script src="Terezi/Script.js"></script>
<div id="icerik" class="tablokapsyici">
	<?php	
	if (isset($_GET['ip'])) {
		require_once "Terezi/edit.php"; 
	}else{
		require_once "Terezi/terezi.php"; 
	}
	?>	
</div>
<?php require_once '_footer.php' ?>