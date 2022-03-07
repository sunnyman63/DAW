window.addEventListener("load",function() {

    let xhttp = new XMLHttpRequest();
    let selectCines = document.getElementById("cine");
    let selectPelis = document.getElementById("pelicula");
    let selectDias = document.getElementById("dia");

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            $aux = JSON.parse(this.response);
            console.log($aux);
            if($aux.tipo == "listarCines") {               
                $aux.cines.forEach(cine => {
                    let op = document.createElement("option");
                    op.setAttribute("value",cine[0]);
                    op.innerText = cine[1];

                    selectCines.appendChild(op);
                });
           }
        }
    }

    xhttp.open("POST","php/filtrarCartelera.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("tipo=listarCines");

    selectCines.addEventListener("change",function() {
        console.log(this.options[this.selectedIndex].value);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                $aux = JSON.parse(this.response);
                console.log($aux);

                while(selectPelis.firstChild) {
                    selectPelis.removeChild(selectPelis.firstChild);
                }
               
                $aux.pelis.forEach(peli => {
                    let op = document.createElement("option");
                    op.setAttribute("value",peli[0]);
                    op.innerText = peli[1];

                    selectPelis.appendChild(op);
                });
                selectPelis.disabled = false;
            }
        }
    
        xhttp.open("POST","php/filtrarCartelera.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("tipo=listarPelis&cine="+this.options[this.selectedIndex].value);
    });
});