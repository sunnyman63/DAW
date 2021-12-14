window.addEventListener("load",function() {

    var scine = document.getElementById("Scine");
    var speli = document.getElementById("Spelicula");

    let xhttp = new XMLHttpRequest(); 
    xhttp.onreadystatechange = function() { 
        if (this.readyState == 4 && this.status == 200) {
            let todo = JSON.parse(this.response);
            //console.log(todo);
            todo.forEach(dato => {
                dato.forEach(nomTit => {
                    let op = document.createElement("option");
                    if(typeof nomTit.nombre !== "undefined") {
                        op.setAttribute("value",nomTit.nombre);
                        op.innerText = nomTit.nombre;
                        scine.appendChild(op);
                    }else {
                        op.setAttribute("value",nomTit.titulo);
                        op.innerText = nomTit.titulo;
                        speli.appendChild(op);
                    } 
                });
            });
        } 
    };
    xhttp.open("GET","php/cartelera.php",false);
    xhttp.send();

    let xhttp2 = new XMLHttpRequest(); 
    xhttp2.onreadystatechange = function() { 
        if (this.readyState == 4 && this.status == 200) {
            let todo = JSON.parse(this.response);
            console.log(todo);
            let ul = document.getElementById("ul");
            let li = document.createElement("li");
            li.innerText = "Cine  /  Sala  /  Pelicula  /  Fecha";
            ul.appendChild(li);
            todo.forEach(dato => {
                let li = document.createElement("li");
                li.innerText = dato[0]+"  /  "+dato[1]+"  /  "+dato[2]+"  /  "+dato[3]; 
                ul.appendChild(li);
            });
        } 
    };
    xhttp2.open("GET","php/listarCartelera.php",true);
    xhttp2.send();
});