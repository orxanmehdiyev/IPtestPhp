function IpSirala() {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Switch/Sirala.php", true);
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
	xhttp.open("POST", "Switch/Sirala.php", true);
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
	xhttp.open("POST", "Switch/Sirala.php", true);
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
	xhttp.open("POST", "Switch/Sirala.php", true);
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


function EditFunction(id){
	document.getElementById("yuklemealanikapsayici").style.display="block";
	let xhttp=new XMLHttpRequest();
	xhttp.open("POST","Switch/edit.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("edit=edit&id="+id);
	xhttp.onreadystatechange=function(){
		if (this.readyState===4 && this.status===200) {
			let cavab=this.responseText.trim();
			if (cavab==="sayno" || cavab==="postno") {
				document.getElementById("yuklemealanikapsayici").style.display = "none";
				document.getElementById("ModalFormAlani").innerHTML = "";
				document.getElementById("Modal").style.display = "none";
				document.getElementById("ModalAlani").style.display = "none";
			}else{
				document.getElementById("yuklemealanikapsayici").style.display = "none";
				document.getElementById("ModalFormAlani").innerHTML = cavab;
				document.getElementById("Modal").style.display = "block";
				document.getElementById("ModalAlani").style.display = "block";
			}			
		}
	}
}


function SwichEdit(id, form) {
	let inputs = form.querySelectorAll("input:not([disabled]), select:not([disabled]), textarea:not([disabled])");
	let deyer = {};
	inputs.forEach(input => {
		deyer[input.id] = input.value;
	});
	deyer["ID"] = id;
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	let gonderilen = JSON.stringify(deyer);
	let xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Switch/editislem.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			let response = JSON.parse(this.responseText);
			if (response.status && response.status === "error") {
				alert(response.message);
				return;
			}
			document.getElementById("Modal").style.display = "none";
			document.getElementById("ModalAlani").style.display = "none";
			let tr = document.getElementById("daimiseneddouble_" + id);
			if (tr.cells[3].innerText === response.IstifadeYeriAd) {
				tr.cells[0].innerText = response.IP_IP;
				tr.cells[1].innerText = response.Status;
				tr.cells[2].innerText = response.SonCavabTarixi;
				tr.cells[3].innerText = response.IstifadeYeriAd;
				tr.cells[4].innerText = response.IdareAD;
				tr.cells[5].innerText = response.BagliCihazinYeri;
				tr.cells[6].innerText = response.BagliCihazinMarkasi;
				tr.cells[7].innerText = response.BagliCihazinModeli;
				tr.cells[8].innerText = response.BagliCihazinMacAdresi;
				tr.cells[9].innerText = response.BagliCihazinAdi;
				tr.cells[10].innerText = response.BagliCihazinPortSayi;
				tr.cells[11].innerText = response.SubnetMask;
				tr.cells[12].innerText = response.DefaultGateway;
				tr.cells[13].innerText = response.UserName;
				tr.cells[14].innerText = response.IstifadeyeVerildiyiTarix;
				tr.cells[15].innerText = response.Qeyd;
				
			} else {
				tr.style.display = "none";
			}
		}
	};
}







function Close(){
	document.getElementById("yuklemealanikapsayici").style.display = "none";
	document.getElementById("ModalFormAlani").innerHTML = "";
	document.getElementById("Modal").style.display = "none";

}