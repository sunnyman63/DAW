window.addEventListener("load",function() {

    var container = document.getElementById("container");
    var submit = document.getElementById("submit");

    submit.addEventListener("click",function() {

        let dni = document.getElementById("dni");
        let nombre = document.getElementById("nombre");
        let correo = document.getElementById("correo");
        let contra = document.getElementById("contra");
        let contra2 = document.getElementById("contra2");

        if(contra.value == contra2.value) {
            let xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function() { 
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.response);
                    if(this.response == 1) {
                        document.location.href = "./login.php";
                    }
                    if(this.response == 2) {
                        let error = document.createElement("p");
                        error.innerText = "Ya existe un usuario registrado con ese DNI.";
                        container.insertBefore(error,container.firstElementChild);
                    }
                }
            }
    
            xhttp.open("POST","php/register.php");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("dni="+dni.value + 
                       "&nombre="+nombre.value +
                       "&correo="+ correo.value +
                       "&contra="+contra.value);
        } else {
            let error = document.createElement("p");
            error.innerText = "Las contraseñas deben coincidir.";
            container.insertBefore(error,container.firstElementChild);
        }

    });

});