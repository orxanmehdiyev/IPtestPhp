<?php require_once "_header.php"; ?>
<script src="IsareEdiciMonitor/Script.js"></script>
<div id="icerik" class="tablokapsyici">
	<?php	
	if (isset($_GET['ip'])) {
		require_once "IsareEdiciMonitor/edit.php"; 
	}else{
		require_once "IsareEdiciMonitor/isareedicimonitor.php"; 
	}
	?>	
</div>
<?php require_once '_footer.php' ?>