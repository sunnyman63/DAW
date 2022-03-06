window.addEventListener("load",function(){


    var container = document.getElementById("container");
    var submit = document.getElementById("submit");

    submit.addEventListener("click", function() {

        let dni = document.getElementById("dni");
        let contra = document.getElementById("contra");

        let xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() { 
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.response);
                if(this.response == 1) {
                    document.location.href = "./index.php";
                }
                if(this.response == 2) {
                    let error = document.createElement("p");
                    error.innerText = "Credenciales invalidas.";
                    container.insertBefore(error,container.firstElementChild);
                }
            }
        }

        xhttp.open("POST","php/login.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("dni="+dni.value+"&contra="+contra.value);
    });
});