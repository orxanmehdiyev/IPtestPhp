<?php require_once "_header.php"; ?>
<script src="MelumatLovhesi/Script.js"></script>
<div id="icerik" class="tablokapsyici">
	<?php	
	if (isset($_GET['ip'])) {
		require_once "MelumatLovhesi/edit.php"; 
	}else{
		require_once "MelumatLovhesi/melumatlovhesi.php"; 
	}
	?>	
</div>
<?php require_once '_footer.php' ?>