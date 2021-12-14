window.addEventListener("load",function() {

    //Variables objetos DOM
    var menuPersonaje = document.getElementById("menuPersonaje");
    var selectorPersonaje = document.getElementById("selectorPersonaje");
    var personaje = document.getElementById("personaje");
    var jueguito = document.getElementById("juego");
    var hoyos = document.getElementById("hoyos");
    var selectorTamanyo = document.getElementById("tamanyoTablero");
    var btnJugar = document.getElementById("btnJugar");
    var puntos = document.getElementById("pts");
    var tiempo = document.getElementById("tmp");
    var pts = 0;
    var tmp = 60;
    
    //Inicializaciones de escenario

    //Tamaños de pantalla
    var altoDivJuego = jueguito.clientHeight;
    jueguito.style.minWidth = altoDivJuego + "px";
    hoyos.style.width = (altoDivJuego/10)*4 + "px";
    selectorTamanyo.selectedIndex = 0;
    puntos.innerText = pts + "pts";
    tiempo.innerText = tmp;

    //Creacion de terreno
    for(let i=1;i<=16;i++) {
        let hoyito = document.createElement("div");
        hoyito.setAttribute("id","hoyo"+i);
        hoyito.setAttribute("class","hoyo");
        hoyos.style.width = (altoDivJuego/10)*4 + "px"; 
        hoyito.style.width = "25%";
                
        hoyos.appendChild(hoyito);
    }

    //Evento para elegir personaje
    menuPersonaje.addEventListener("click",function() {
        selectorPersonaje.style.display = "flex";
        selectorPersonaje.addEventListener("mouseleave",function() {
            selectorPersonaje.style.display = "none";
        });
    });

    for(let i = 1;i<=5;i++) {
        let id = "p"+i;
        let perso = document.getElementById(id);
        perso.addEventListener("click",function() {
            personaje.setAttribute("src",perso.getAttribute("src"));
        });
    }

    //Evento para seleccionar tamaños de terreno
    selectorTamanyo.addEventListener("change",function() {
        let tamanyo = selectorTamanyo.value;
        while(hoyos.firstChild) {
            hoyos.removeChild(hoyos.firstChild);
        }
        for(let i=1;i<=tamanyo*tamanyo;i++) {
            let hoyito = document.createElement("div");
            hoyito.setAttribute("id","hoyo"+i);
            hoyito.setAttribute("class","hoyo");
            switch(tamanyo) {
                case "4":
                    hoyos.style.width = (altoDivJuego/10)*4 + "px"; 
                    hoyito.style.width = "25%";
                    break;
                case "5": 
                    hoyos.style.width = (altoDivJuego/10)*5 + "px";
                    hoyito.style.width = "20%"; 
                    break;
                case "6": 
                    hoyos.style.width = (altoDivJuego/10)*6 + "px";
                    hoyito.style.width = "16%"; 
                    break;
            }
            hoyos.appendChild(hoyito);
        }
    });

    //Evento para empezar juego
    btnJugar.addEventListener("click",function() {
        let cortinaJuego = document.getElementById("cortinaJugar");
        cortinaJuego.style.display = "none";

        selectorPersonaje.style.display = "none";

        let cortinaMenu = document.getElementById("cortinaMenu");
        cortinaMenu.style.display = "block";
        juego();
    });

    var cronometro;

    //Funcionalidad del juego
    function juego() {

        let tamanyo = hoyos.childNodes.length;
        let rand = Math.floor(Math.random()*tamanyo) + 1;
        let start = Date.now();
        let hueco = document.getElementById("hoyo"+rand);
        let topo = document.createElement("img");
        topo.setAttribute("src",personaje.getAttribute("src"));
        topo.setAttribute("id","imgTopo");
        topo.setAttribute("class","imgTopo");
        hueco.appendChild(topo);

        let topito = document.getElementById("imgTopo");
        topito.addEventListener("click",function() {
            pts += 1;
            puntos.innerText = pts+"pts";
            topito.style.display = "none";
        });



        cronometro = setInterval(function() {

            let timepassed = Date.now() - start;
            

            if(timepassed <= 250) {
                topito.style.top = 100-(timepassed/2.5) + "%";
            }
            if(timepassed >= 750) {
                topito.style.top = (timepassed/2.5)-300 + "%";
            }
            if(timepassed>=1000) {
                tmp -= 1;
                clearInterval(cronometro);
                hueco.removeChild(hueco.firstChild);
                if(tmp<0) {
                    let cortinaJuego = document.getElementById("cortinaJugar");
                    cortinaJuego.style.display = "flex";
                    cortinaJuego.removeChild(btnJugar);

                    let divFinal = document.createElement("div");
                    divFinal.setAttribute("class","marcadorFinal");
                    divFinal.innerText = "Conseguiste un total de "+pts+" puntos!!";
                    let btnVolverAJugar = document.createElement("input");
                    btnVolverAJugar.setAttribute("type","button");
                    btnVolverAJugar.setAttribute("value","Volver a Jugar");
                    btnVolverAJugar.setAttribute("class","volverAJugar");
                    btnVolverAJugar.addEventListener("click",function() {
                        window.location.href = "index.html";
                    });
                    divFinal.appendChild(btnVolverAJugar);
                    cortinaJuego.appendChild(divFinal);
                } else {
                    tiempo.innerText = tmp;
                    juego();
                }   
            } 
        },24);
    }
});