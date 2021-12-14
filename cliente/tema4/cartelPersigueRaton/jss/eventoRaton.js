function moverHola(e) {
	var x = e.clientX;
	var y = e.clientY;
    document.getElementById("hola").style.visibility = "visible";
    document.getElementById("hola").style.left = x+"px";
    document.getElementById("hola").style.top = y+"px"; 
}

document.body.addEventListener("mousemove",moverHola);