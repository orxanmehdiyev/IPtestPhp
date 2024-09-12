<?php require_once "_header.php"; ?>
<script src="KameraPc/Script.js"></script>
<div id="icerik" class="tablokapsyici">
	<?php	
	if (isset($_GET['ip'])) {
		require_once "KameraPc/edit.php"; 
	}else{
		require_once "KameraPc/kamerapc.php"; 
	}
	?>	
</div>
<?php require_once '_footer.php' ?>