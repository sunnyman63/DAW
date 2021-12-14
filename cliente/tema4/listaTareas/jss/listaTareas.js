window.addEventListener("load",function() {

    var agregar = document.getElementById("anyadir");
    var nueva = document.getElementById("nueva");
    var lista = document.getElementById("lista");
    var date = new Date();
    date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));//Saca la fecha actual más 1 año en ms
    nueva.value = "";

    if(document.cookie) {
        let cookies = document.cookie;
        cookies = cookies.split("=");
        let cucas = cookies[1].split("-");
        cucas.forEach(cuca => {
            anyadirLi(cuca);
        });
    }

    function presionarBoton(e) {
        e.target.style.backgroundColor = "#500000";
    }

    function soltarBoton(e) {
        e.target.style.backgroundColor = "#9c0000";
    }

    function moverTarea(e) {
        let li = e.target.parentNode;
        if(li.parentNode.childNodes.length != 1) {
            let copia = li.cloneNode(true);
            li.parentNode.insertBefore(copia,li.parentNode.firstChild);

            li.parentNode.firstChild.firstChild.addEventListener("click",moverTarea);
            li.parentNode.firstChild.lastChild.addEventListener("click",eliminarTarea);
            li.parentNode.firstChild.lastChild.addEventListener("mousedown",presionarBoton);
            li.parentNode.firstChild.lastChild.addEventListener("mouseup",presionarBoton);
            
            let cookies = document.cookie;
            cookies = cookies.split("=");

            let val = cookies[1].split("-");
            console.log(e.target.innerText);
            val.splice(val.indexOf(e.target.innerText),1);

            let cookie = e.target.innerText +"-"+ val.join("-");
            document.cookie = "lista="+cookie+"; expires="+date+"; secure";
            li.parentNode.removeChild(li);
        }
    }

    function eliminarTarea(e) {
        let li = e.target.parentNode;
        let cookies = document.cookie;
        cookies = cookies.split("=");
        let val = cookies[1].split("-");
        if(val.length != 1){
            val.splice(val.indexOf(li.innerText),1);
            let cookie = val.join("-");
            document.cookie = "lista="+cookie+"; expires="+date+"; secure";
        } else {
            document.cookie = "lista=adios; expires=Thu, 01 Jan 1970 00:00:00 UTC; secure";
        }
        li.parentNode.removeChild(li);
    }

    function anyadirLi(dato) {
        let node = document.createElement("li");
        let nodeLabel = document.createElement("label");
        nodeLabel.innerHTML = dato;

        nodeLabel.addEventListener("click",moverTarea);

        let nodeBtn = document.createElement("input");
        nodeBtn.setAttribute("type","button");
        nodeBtn.setAttribute("value","quitar");
        nodeBtn.setAttribute("class","delete");
        nodeBtn.setAttribute("id","delete");

        nodeBtn.addEventListener("click",eliminarTarea);
        nodeBtn.addEventListener("mousedown",presionarBoton);
        nodeBtn.addEventListener("mouseup",presionarBoton);

        node.appendChild(nodeLabel);
        node.appendChild(nodeBtn);
        lista.appendChild(node);       
    }
    
    agregar.addEventListener("click",function(e) {
        if(nueva.value == "") {
            e.preventDefault();
        } else {
            let cookies = document.cookie;
            if(!cookies) {
                document.cookie = "lista="+nueva.value+"; expires="+date+"; secure";
                anyadirLi(nueva.value);
            } else {
                cookies = document.cookie;
                cookies = cookies.split("=");
                let val = cookies[1] + "-" + nueva.value;
                document.cookie = "lista="+val+"; expires="+date+"; secure";
                anyadirLi(nueva.value);
            }
            nueva.value = "";          
        }
    });

    agregar.addEventListener("mousedown",presionarBoton);
    agregar.addEventListener("mouseup",soltarBoton);
});