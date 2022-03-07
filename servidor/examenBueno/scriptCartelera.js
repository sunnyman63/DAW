function comprobarRegistro(){
    var cine=document.getElementById("cine").value;
    var peli=document.getElementById("peli").value;
    var dia=document.getElementById("dia").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
    }
    };
    xhttp.open("POST", "filtrarPelis.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("cine="+cine+"&peli="+peli+"&dia="+dia);
}