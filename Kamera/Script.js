function Sirala(value) {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Kamera/Sirala.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("sirala="+value);
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
	xhttp.open("POST","Kamera/edit.php", true);
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
	xhttp.open("POST", "Kamera/editislem.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	console.log(xhttp);
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
				tr.cells[5].innerText = response.BagliCihazinMarkasi;
				tr.cells[6].innerText = response.BagliCihazinModeli;
				tr.cells[7].innerText = response.BagliCihazinMacAdresi;
				tr.cells[8].innerText = response.BagliCihazinAdi;
				tr.cells[9].innerText = response.KameraTipi;
				tr.cells[10].innerText = response.SubnetMask;
				tr.cells[11].innerText = response.DefaultGateway;
				tr.cells[12].innerText = response.IP_NVR;
				tr.cells[13].innerText = response.IP_AlarmStatusu;
				tr.cells[14].innerText = response.IP_Alarm;
				tr.cells[15].innerText = response.IP_MulticastIpBir;				
				tr.cells[16].innerText = response.IP_MulticastPortBir;
				tr.cells[17].innerText = response.IP_MulticastIpIki;
				tr.cells[18].innerText = response.IP_MulticastPortIki;
				tr.cells[19].innerText = response.IstifadeyeVerildiyiTarix;
				tr.cells[20].innerText = response.SonDuzelisTarixi;
				tr.cells[21].innerText = response.Qeyd;
				
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

