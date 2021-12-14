window.addEventListener("load",function() {

    var esAdmin = false;
    var div = document.getElementById("menu");
    console.log(esAdmin);
    let xhttp = new XMLHttpRequest(); 
    xhttp.onreadystatechange = function() { 
        if (this.readyState == 4 && this.status == 200) {
            if(typeof this.response !== "string") {
                let resp = JSON.parse(this.response);
            
                if(resp["resp"] == "0") {
                    if(resp["esAdmin"] == true) {
                        esAdmin = true;
                    } else {
                        esAdmin = false;
                    }
                }
            }
            
        }  
    };
    xhttp.open("GET","php/comprobarSesion.php",true);
    xhttp.send();

    var br = document.createElement("br");

    if(esAdmin == false) {
        let cartelera = document.createElement("a");
        cartelera.setAttribute("href","cartelera.html");
        cartelera.innerText = "Cartelera";
        div.appendChild(cartelera);
        div.appendChild(br.cloneNode());

        let entradas = document.createElement("a");
        entradas.setAttribute("href","entradas.html");
        entradas.innerText = "Comprar Entradas";
        div.appendChild(entradas);
        div.appendChild(br.cloneNode());

        let historico = document.createElement("a");
        historico.setAttribute("href","historico.html");
        historico.innerText = "Histórico";
        div.appendChild(historico);
        div.appendChild(br.cloneNode());
    } else {
        let cartelera = document.createElement("a");
        cartelera.setAttribute("href","cartelera.html");
        cartelera.innerText = "Cartelera";
        div.appendChild(cartelera);
        div.appendChild(br.cloneNode());

        let sesion = document.createElement("a");
        sesion.setAttribute("href","sesion.html");
        sesion.innerText = "Crear Sesión";
        div.appendChild(sesion);
        div.appendChild(br.cloneNode());
    }

    let cerrar = document.createElement("a");
    cerrar.setAttribute("href","php/cerrarSesion.php");
    cerrar.innerText = "Cerrar Sesión";
    div.appendChild(cerrar);
});