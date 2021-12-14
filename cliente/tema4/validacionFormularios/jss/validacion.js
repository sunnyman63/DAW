window.addEventListener("load",function() {

    var img = document.getElementById("img");
    var select = document.getElementById("incidencia");
    var cod = document.getElementById("inputNumSerie");
    var labelCod = document.getElementById("labelNumSerie");

    switch(select.selectedIndex) {
        case 0: img.src = "imgs/distribucion.jpg";break;
        case 1: img.src = "imgs/oficina.webp";break;
        case 2: img.src = "imgs/produccion.webp";break;
    }

    select.addEventListener("change",function(){
        switch(select.selectedIndex) {
            case 0: img.src = "imgs/distribucion.jpg";break;
            case 1: img.src = "imgs/oficina.webp";break;
            case 2: img.src = "imgs/produccion.webp";break;
        }
    });

    desc.addEventListener("click",function() {
        document.getElementById("desc").style.display = "none";
        document.getElementById("descEsc").style.display = "block";
    });

    function codigoNoValido() {
        labelCod.style.border = "1px red solid";
        cod.style.borderColor = "red";
        document.getElementById("error").style.display = "block";
    }

    document.addEventListener("submit",function(e) {
        let x = cod.value;
        let parte1 = x.substring(0,3);
        let parte2 = x.substring(3,7);
        let parte3 = x.substring(7);
        if(!isNaN(parseInt(parte1))){
            if(isNaN(parseInt(parte2)) && parte2 === parte2.toUpperCase()) {
                if(parte3 == 1 || parte3 == 2 || parte3 == "A") {
                    document.getElementById("res").innerHTML = "Bien hecho!!";
                    e.preventDefault();//Para que no se produzca el submit
                } else {
                    codigoNoValido();
                    e.preventDefault();
                }
            } else {
                codigoNoValido();
                e.preventDefault();
            }
        } else {
            codigoNoValido();
            e.preventDefault();
        }
    });

    cod.addEventListener("click",function() {
        cod.style.borderColor = "lightgrey";
        labelCod.style.border = "none";
        document.getElementById("error").style.display = "none";
        document.getElementById("res").innerHTML = "";
    });

});