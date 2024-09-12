
</body>
</html>
<script src="Axtar/Script.js"></script>
<script type="text/javascript">
	function Axtar() {
		var Axtar_IPB = document.getElementById("Axtar_IPB");	
		var Axtar_IPS = document.getElementById("Axtar_IPS");	
		var deyer = {
			Axtar_IPB: Axtar_IPB.value,
			Axtar_IPS: Axtar_IPS.value,
		};
		var gonderilen = JSON.stringify(deyer);
		if ( Axtar_IPB.value !== '' || Axtar_IPS.value !== '' ) {
			document.getElementById("yuklemealanikapsayici").style.display = "block";
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "ButunIpiler/Axtar.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("axtar=" + gonderilen);
			xhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					var cavab = this.responseText.trim();
					document.getElementById("icerik").innerHTML = cavab;
					document.getElementById("yuklemealanikapsayici").style.display = "none"
				}
			}
		}else{
			alert("Axtarılacaq IP Yazın")
		}
	}


	document.addEventListener('DOMContentLoaded', (event) => {
		const modal = document.getElementById('Modal');
		const header = document.getElementById('ModalHeader');
		let sürüklənir = false;
		let offsetX, offsetY;
		var yukseklik=window.innerHeight;
		var genislik=window.innerWidth;
		console.log(genislik);
		header.addEventListener('mousedown', (e) => {
			e.preventDefault();
			sürüklənir = true;
			offsetX = modal.getBoundingClientRect().left;
			offsetY = modal.getBoundingClientRect().top;
			header.classList.add('active');
			document.addEventListener('mousemove', mouseHərəkəti);
			document.addEventListener('mouseup', mouseBuraxıldı);
		});
		function mouseHərəkəti(e) {
			let body=document.getElementById("body");
			body.style.cursor = 'move';

			if (sürüklənir) {
				let left = e.clientX ;
				let top = e.clientY;

				if (top < 0) {
					top = 0;
				}
				if (top > (yukseklik-60)) {
					top = yukseklik-60;
				}

				if (left > genislik) {
					left = genislik;
				}


				modal.style.left = `${left}px`;
				modal.style.top = `${top}px`;
			}
		}

		function mouseBuraxıldı() {
			sürüklənir = false;
			header.classList.remove('active');
			body.style.cursor = 'auto';
			document.removeEventListener('mousemove', mouseHərəkəti);
			document.removeEventListener('mouseup', mouseBuraxıldı);
		}
	});


</script>