var capa = document.getElementById("container");

function colores(e) {
    switch(e.type) {
        case "mouseover": capa.style.backgroundColor = "green";break;
        case "mouseout": capa.style.backgroundColor = "unset";break;
        case "mouseup": capa.style.backgroundColor = "green";break;
        case "mousedown": 
            if(e.button == 0) {
                capa.style.backgroundColor = "red";
            }
            if(e.button == 2) {
                capa.style.backgroundColor = "blue";
            }
    }
}

capa.addEventListener("mouseover",colores);
capa.addEventListener("mouseout",colores);
capa.addEventListener("mousedown",colores);
capa.addEventListener("mouseup",colores);