window.addEventListener("load",function() {

    let xhttp = new XMLHttpRequest(); 
    xhttp.onreadystatechange = function() { 
        if (this.readyState == 4 && this.status == 200) {
            if(typeof this.response !== "string") {
                let resp = JSON.parse(this.response);
            
                if(resp["resp"] == "0") {
                    window.location = "pagina.html";
                }
            }
        } 
    };
    xhttp.open("GET","php/comprobarSesion.php",true);
    xhttp.send();

    var btnLog = document.getElementById("login");
    var form = document.getElementById("form");

    btnLog.addEventListener("click", function() {
        let nombre = document.getElementById("nombre").value;
        let contra = document.getElementById("contra").value;

        if(nombre!="" && contra!="") {
            let xhttp = new XMLHttpRequest(); 
            xhttp.onreadystatechange = function() { 
                if (this.readyState == 4 && this.status == 200) {
                    if(this.response == "0") {
                        window.location = "pagina.html";
                    } else {
                        if(this.response == "no user") {
                            let p = document.createElement("p");
                            p.innerText = "Usuario no encontrado.";
                            form.appendChild(p);
                        }
                        if(this.response == "no pass") {
                            let p = document.createElement("p");
                            p.innerText = "Contraseña incorrecta.";
                            form.appendChild(p);
                        }
                    }
                } 
            };
            xhttp.open("POST","php/login.php",true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("nombre="+nombre+"&contra="+contra);
        } else {
            let p = document.createElement("p");
            p.innerText = "Debe rellenar ambos campos.";
            form.appendChild(p);
        }
    });
});