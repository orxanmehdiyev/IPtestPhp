//Səyfə yüksəkliyini hesablayiriq və footurda funksiyani cağırırıq
function ekranyukseklik() {
	var	ekran_yuksekliyi=screen.height-135;
	document.getElementById("body").style.minHeight = ekran_yuksekliyi+"px";
}
