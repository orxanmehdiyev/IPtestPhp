<?php require_once "_header.php"; ?>
<script src="Server/Script.js"></script>
<div id="icerik" class="tablokapsyici">
	<?php	
	if (isset($_GET['ip'])) {
		require_once "Server/edit.php"; 
	}else{
		require_once "Server/server.php"; 
	}
	?>	
</div>
<?php require_once '_footer.php' ?>