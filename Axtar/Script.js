
function AxtarIpSirala() {
		var Axtar_IPB = document.getElementById("Axtar_IPBGiz");	
		var Axtar_IPS = document.getElementById("Axtar_IPSGiz");	
		var deyer = {
			Axtar_IPB: Axtar_IPB.value,
			Axtar_IPS: Axtar_IPS.value,
		};
		var gonderilen = JSON.stringify(deyer);
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Axtar/Sirala.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("sirala=IpNoktesiz&axtar="+gonderilen);
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
					var cavab = this.responseText.trim();
					document.getElementById("icerik").innerHTML = cavab;
					document.getElementById("yuklemealanikapsayici").style.display = "none"
				}
	}
}

function AxtarStatusSirala() {
	var Axtar_IPB = document.getElementById("Axtar_IPBGiz");	
		var Axtar_IPS = document.getElementById("Axtar_IPSGiz");	
		var deyer = {
			Axtar_IPB: Axtar_IPB.value,
			Axtar_IPS: Axtar_IPS.value,
		};
		var gonderilen = JSON.stringify(deyer);
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Axtar/Sirala.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("sirala=StatusSirala&axtar="+gonderilen);
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab = this.responseText.trim();
			document.getElementById("icerik").innerHTML = cavab;
			document.getElementById("yuklemealanikapsayici").style.display = "none"
		}
	}
}


function AxtarSonCavabTarixiSirala() {
	var Axtar_IPB = document.getElementById("Axtar_IPBGiz");	
		var Axtar_IPS = document.getElementById("Axtar_IPSGiz");	
		var deyer = {
			Axtar_IPB: Axtar_IPB.value,
			Axtar_IPS: Axtar_IPS.value,
		};
		var gonderilen = JSON.stringify(deyer);
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Axtar/Sirala.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("sirala=SonCavabTarixiSirala&axtar="+gonderilen);
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab = this.responseText.trim();
			document.getElementById("icerik").innerHTML = cavab;
			document.getElementById("yuklemealanikapsayici").style.display = "none"
		}
	}
}


function AxtarIstifadeyeVerildiyiTarix() {
	var Axtar_IPB = document.getElementById("Axtar_IPBGiz");	
		var Axtar_IPS = document.getElementById("Axtar_IPSGiz");	
		var deyer = {
			Axtar_IPB: Axtar_IPB.value,
			Axtar_IPS: Axtar_IPS.value,
		};
		var gonderilen = JSON.stringify(deyer);
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Axtar/Sirala.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("sirala=IstifadeyeVerildiyiTarix&axtar="+gonderilen);
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab = this.responseText.trim();
			document.getElementById("icerik").innerHTML = cavab;
			document.getElementById("yuklemealanikapsayici").style.display = "none"
		}
	}
}