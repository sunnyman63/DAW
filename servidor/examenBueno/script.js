function comprobarRegistro(){
    var dni=document.getElementById("dni").value;
    var pass=document.getElementById("pass").value;
    var email=document.getElementById("email").value;
    var nombre=document.getElementById("nombre").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.response==0){
                alert("ya existe ese usuario");
            }else{
                alert("se guardo usuario");
            }
    }
    };
    xhttp.open("POST", "comprobarRegistro.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("dni="+dni+"&pass="+pass+"&email="+email+"&nombre="+nombre);
}