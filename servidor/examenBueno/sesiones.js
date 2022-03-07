function crearSesion(){
    var sala=document.getElementById("sala").value;
    var peli=document.getElementById("peli").value;
    var cine=document.getElementById("cine").value;
    var dia=document.getElementById("dia").value;
    var hora=document.getElementById("hora").value;
    var datetime=dia+" "+hora+":00";
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
    }
    };
    xhttp.open("POST", "crearSesion.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("sala="+sala+"&peli="+peli+"&datetime="+datetime+"&cine="+cine);
}