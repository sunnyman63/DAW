window.addEventListener('load',function() {

    var container = document.getElementById('container');
    var carta = document.querySelector('#carta');
    var recibidos = document.getElementById('recibidos');

    function borrarContenido(element) {
        while(element.firstChild) {
            element.removeChild(element.firstChild);
        }
    }

    carta.addEventListener('click',function() {
        borrarContenido(container);

        let lista = document.createElement("div");
        lista.setAttribute("class","listaRegalos");
        lista.setAttribute("id","listaRegalos");

        let h1 = document.createElement("h1");
        h1.innerText = "Lista de deseos:";

        let btn = document.createElement("button");
        btn.setAttribute("class","btnLista");
        btn.setAttribute("id","btnLista");
        btn.innerText = "Finalizar";
        btn.addEventListener('click',function() {
            
        });

        lista.appendChild(h1);
        lista.appendChild(btn);
        container.appendChild(lista);

        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() { 
            if (this.readyState == 4 && this.status == 200) { 
                let resp = JSON.parse(this.response);
                console.log(resp);
                for(let i = 0; i<resp.length;i++) {
                    let div = document.createElement("div");
                    div.setAttribute("class","regalo");
                    div.setAttribute("id","regalo"+(i+1));
                    div.addEventListener('click',function(e) {
                        let target = e.target;
                        if(target.localName == "img" || target.localName == "p") {
                            target = target.parentNode;
                        }
                        let p = document.createElement("p");
                        p.innerText = "-"+target.children[1].innerText;
                        let lista = document.getElementById("listaRegalos");
                        lista.insertBefore(p,document.getElementById("btnLista"));
                    });

                    let img = document.createElement("img");
                    img.setAttribute("class","imgRegalo");
                    img.setAttribute("src","data:image/jpeg;base64,"+resp[i].img);

                    let nombre = document.createElement("p");
                    nombre.setAttribute("class","nombreRegalo");
                    nombre.innerText = resp[i].nombre;

                    div.appendChild(img);
                    div.appendChild(nombre);
                    container.appendChild(div);
                }
            }    
        };
        xhttp.open("POST", "./controlador.php", false);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("razon=regalos");
    });  
});