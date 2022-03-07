function comprobarLogin(){
    var pass=document.getElementById("pass").value;
    var nombre=document.getElementById("nombre").value;
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.response==2){
                location.href="indexUsu.php";
            }else if(this.response==1){
                location.href="indexAdmin.php";
            }else{
                var p=document.createElement("p");
                var form=document.getElementById("form");
                p.innerHTML="login incorrecto";
                form.appendChild(p);
            }
            
    }
    };
    xhttp.open("POST", "comprobarLogin.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("pass="+pass+"&nombre="+nombre);
}