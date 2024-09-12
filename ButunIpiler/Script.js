function HamisiniGoster() {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "ButunIpiler/HamisiSenedSorgula.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("yeni=yeni");
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab = this.responseText.trim();
			document.getElementById("icerik").innerHTML = cavab;
			document.getElementById("yuklemealanikapsayici").style.display = "none"
		}
	}
}

function NormalGoster() {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "ButunIpiler/NormalSenedSorgula.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("yeni=yeni");
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab = this.responseText.trim();
			document.getElementById("icerik").innerHTML = cavab;
			document.getElementById("yuklemealanikapsayici").style.display = "none"
		}
	}
}

function Seyfeleme(id) {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "ButunIpiler/Seyfeleme.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("yeni=yeni&Sayfalama=" + id);
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab = this.responseText.trim();
			document.getElementById("icerik").innerHTML = cavab;
			document.getElementById("yuklemealanikapsayici").style.display = "none"
		}
	}
}
function IpSirala() {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "ButunIpiler/Sirala.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("sirala=IpNoktesiz");
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab = this.responseText.trim();
			document.getElementById("icerik").innerHTML = cavab;
			document.getElementById("yuklemealanikapsayici").style.display = "none"
		}
	}
}

function StatusSirala() {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "ButunIpiler/Sirala.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("sirala=StatusSirala");
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab = this.responseText.trim();
			document.getElementById("icerik").innerHTML = cavab;
			document.getElementById("yuklemealanikapsayici").style.display = "none"
		}
	}
}


function SonCavabTarixiSirala() {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "ButunIpiler/Sirala.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("sirala=SonCavabTarixiSirala");
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab = this.responseText.trim();
			document.getElementById("icerik").innerHTML = cavab;
			document.getElementById("yuklemealanikapsayici").style.display = "none"
		}
	}
}


function IstifadeyeVerildiyiTarix() {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "ButunIpiler/Sirala.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("sirala=IstifadeyeVerildiyiTarix");
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab = this.responseText.trim();
			document.getElementById("icerik").innerHTML = cavab;
			document.getElementById("yuklemealanikapsayici").style.display = "none"
		}
	}
}