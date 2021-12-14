window.addEventListener("load",function() {

    let xhttp = new XMLHttpRequest(); 
    xhttp.onreadystatechange = function() { 
        if (this.readyState == 4 && this.status == 200) {
            let resp = JSON.parse(this.response);
            if(resp["resp"] == "0") {
                window.location = "pagina.html";
            }
        }  
    };
    xhttp.open("GET","php/comprobarSesion.php",true);
    xhttp.send();

    var btnReg = document.getElementById("register");
    var form = document.getElementById("form");

    btnReg.addEventListener("click", function() {
        let dni = document.getElementById("dni").value;
        let nombre = document.getElementById("nombre").value;
        let correo = document.getElementById("correo").value;
        let contra = document.getElementById("contra").value;
        let contra2 = document.getElementById("contra2").value;
        console.log("holi");
        if(dni!="" && nombre!="" && correo!="" && contra!="" && contra2!="") {
            let xhttp = new XMLHttpRequest(); 
            xhttp.onreadystatechange = function() { 
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.response);
                    if(this.response == "0") {
                        window.location = "pagina.html";
                    } else {
                        if(this.response == "usu existe") {
                            let p = document.createElement("p");
                            p.innerText = "Ya existe un usuario con ese nombre.";
                            form.appendChild(p);
                        }
                        if(this.response == "contras desiguales") {
                            let p = document.createElement("p");
                            p.innerText = "Las contraseñas no coinciden.";
                            form.appendChild(p);
                        }
                        if(search(this.response,"PRIMARY")!=-1) {
                            let p = document.createElement("p");
                            p.innerText = "Ya existe alguien con ese DNI.";
                            form.appendChild(p);
                        }
                    }
                } 
            };
            xhttp.open("POST","php/register.php",true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("dni="+dni+"&nombre="+nombre+"&correo="+correo+"&contra="+contra+"&contra2="+contra2);
        } else {
            let p = document.createElement("p");
            p.innerText = "Debe rellenar todos los campos.";
            form.appendChild(p);
        }
    });
});