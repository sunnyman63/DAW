window.addEventListener("load",function() {
    
    var btn = document.getElementById("btn");
    var usuario = document.getElementById("dni");
    var contrasenya = document.getElementById("contra");

    btn.addEventListener("click",function() {

        let xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() { 
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.response);
                let info = document.getElementById("info");
                switch(this.response) {
                    case '1': info.innerText = "Usuario normal logueado"; break;
                    case '2': info.innerText = "Usuario Admin logueado"; break;
                    case '0': info.innerText = "DNI o Contraseña incorrectos"; break;
                }
            }
        }

        xhttp.open("POST","php/login.php",true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("dni="+usuario.value+"&contra="+contrasenya.value);
    });
});