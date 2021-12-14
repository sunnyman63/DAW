window.addEventListener("load",function() {

    var main = document.getElementById("main");
    var contenedor = document.getElementById("div_form");
    var divErrores = document.getElementById("div_err");
    var btnLogin = document.getElementById("btn_login");
    var btnRegister = document.getElementById("btn_register");
    var botonForm = document.querySelector(".boton");


    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() { 
        if (this.readyState == 4 && this.status == 200) { 
            if(this.response == true){
                menujuego();
            } 
        }    
    };
    xhttp.open("POST", "php/comprobarOCerrarSesion.php", false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("tipo=comprobar");

    function crearForm(e) {

        contenedor.removeChild(document.getElementById("form"));

        let div = e.target.value;
        let form = document.createElement("form");
        form.setAttribute("action","#");
        form.setAttribute("method","POST");
        form.setAttribute("id","form");
        form.setAttribute("name","form");
        form.setAttribute("autocomplete","off");
        let labelNom = document.createElement("label");
        labelNom.innerText = "Nombre: ";
        let inputNom = document.createElement("input");
        inputNom.setAttribute("type","text");
        inputNom.setAttribute("name","user");
        inputNom.setAttribute("id","usu");
        inputNom.setAttribute("required","required");
        let labelContra = document.createElement("label");
        labelContra.innerText = "Contraseña: ";
        let inputContra = document.createElement("input");
        inputContra.setAttribute("type","password");
        inputContra.setAttribute("name","contrasenya");
        inputContra.setAttribute("id","contra");
        inputContra.setAttribute("required","required");
        let btn = document.createElement("input");
        btn.setAttribute("class","boton");
        btn.setAttribute("type","button");
        btn.setAttribute("name","submit");
        btn.addEventListener("click",eventDispatch);

        form.appendChild(labelNom);
        form.appendChild(inputNom);

        if(div == "register") {
            let labelMail = document.createElement("label");
            labelMail.innerText = "Correo: ";
            let inputMail = document.createElement("input");
            inputMail.setAttribute("type","email");
            inputMail.setAttribute("name","mail");
            inputMail.setAttribute("id","correo");
            inputMail.setAttribute("required","required");
            form.appendChild(labelMail);
            form.appendChild(inputMail);
            btn.setAttribute("value","register");
        } else  {
            btn.setAttribute("value","login");
        }

        form.appendChild(labelContra);
        form.appendChild(inputContra);
        if(div == "register") {
            let labelContra2 = document.createElement("label");
            labelContra2.innerText = "Repetir Contraseña: ";
            let inputContra2 = document.createElement("input");
            inputContra2.setAttribute("type","password");
            inputContra2.setAttribute("name","contrasenya2");
            inputContra2.setAttribute("id","contra2");
            inputContra2.setAttribute("required","required");
            form.appendChild(labelContra2);
            form.appendChild(inputContra2);
        }
        form.appendChild(btn);
        contenedor.appendChild(form);
    }

    function eventDispatch(e) {
        let valor = botonForm.getAttribute("value");
        let nom = document.forms["form"]["user"].value;
        let correo;
        let contra = document.forms["form"]["contrasenya"].value;
        let contra2;
        if(valor == "register") {
            contra2 = document.forms["form"]["contrasenya2"].value;
            correo = document.forms["form"]["correo"].value;
        }
        let xhttp = new XMLHttpRequest(); 
        // código que gestiona la respuesta asíncrona cuando llegue 
        xhttp.onreadystatechange = function() { 
            if (this.readyState == 4 && this.status == 200) { 
                if(this.response == "0") {
                    menujuego();
                } else {
                    e.preventDefault();
                    let error = document.createElement("p");
                    if((this.response.search("PRIMARY"))!=-1) {
                        error.innerHTML = "*Ese nombre de usuario ya existe.";
                    } else if(this.response == "Contraseña incorrecta.") {
                        error.innerHTML = "*"+this.response;
                    } else if(this.response == "Usuario no Encontrado.") {
                        error.innerHTML = "*"+this.response;
                    } else {
                        console.log(this.response);
                        error.innerHTML = "*Error del servidor."; 
                    }
                    divErrores.appendChild(error);
                }  
            }
            
        };  
        if(valor == "login") {
            if(nom != "" && contra!= "") {
                e.preventDefault();
                xhttp.open("POST", "php/login.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("nombre="+nom+"&contra="+contra);
            }
        } else if(valor == "register") {
            if(nom != "" && correo != "" && contra!= "" && contra2 != "") {
                e.preventDefault();
                if(contra == contra2) {
                    xhttp.open("POST", "php/register.php", true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send("nombre="+nom+"&correo="+correo+"&contra="+contra);
                } else {
                    let error = document.createElement("p");
                    error.innerHTML = "*Las contraseñas no coinciden.";
                    divErrores.appendChild(error);
                }
            }
        }
    }

    function menujuego(fin) {
        clearInterval(cronometro);
        if(fin == "final") {
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() { 
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.response);
                }
            }
            xhttp.open("GET", "php/anyadirClasificacion.php", true);
            xhttp.send();
        }

        while(main.firstChild) {
            main.removeChild(main.firstChild);
        }

        let divMenu = document.createElement("div");
        divMenu.setAttribute("class","menuJuego");

        let botonjugar = document.createElement("input");
        botonjugar.setAttribute("class","botonMenu");
        botonjugar.setAttribute("type","button");
        if(fin == "final") {
            botonjugar.setAttribute("value","VOLVER A JUGAR");
        } else {
            botonjugar.setAttribute("value","JUGAR");
        }
        botonjugar.addEventListener("click",function() {
            juego(0,1);
        });

        let botonanyadirpreg = document.createElement("input");
        botonanyadirpreg.setAttribute("class","botonMenu");
        botonanyadirpreg.setAttribute("type","button");
        botonanyadirpreg.setAttribute("value","AÑADIR PREGUNTA");
        botonanyadirpreg.addEventListener("click",function() {
            anyadirPregunta();
        });

        let botonclasificacion = document.createElement("input");
        botonclasificacion.setAttribute("class","botonMenu");
        botonclasificacion.setAttribute("type","button");
        botonclasificacion.setAttribute("value","CLASIFICACIÓN");
        botonclasificacion.addEventListener("click",function() {
            clasificacion();
        });

        let botonsalir = document.createElement("input");
        botonsalir.setAttribute("class","botonMenu");
        botonsalir.setAttribute("type","button");
        botonsalir.setAttribute("value","CERRAR SESIÓN");
        botonsalir.addEventListener("click",function() {
            let xhttp = new XMLHttpRequest(); 
            // código que gestiona la respuesta asíncrona cuando llegue 
            xhttp.onreadystatechange = function() { 
                if (this.readyState == 4 && this.status == 200) {
                    if(this.response == false){
                        location.replace("index.html");
                    }
                }
            }
            xhttp.open("POST", "php/comprobarOCerrarSesion.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("tipo=cerrar");
        });

        divMenu.appendChild(botonjugar);
        divMenu.appendChild(botonanyadirpreg);
        divMenu.appendChild(botonclasificacion);
        divMenu.appendChild(botonsalir);
        main.appendChild(divMenu);
    }

    var cronometro;

    function juego(tema,empieza) {

        let tmp = 60;
 
        while(main.firstChild) {
            main.removeChild(main.firstChild);
        }

        let btnPress = function(btn) {
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() { 
                if (this.readyState == 4 && this.status == 200) {
                    let correcta = document.getElementById(this.response);
                    correcta.style.backgroundColor = "#0F0";
                    if(btn.id!=this.response) {
                        btn.style.backgroundColor = "#F00";
                    }
                    clearInterval(cronometro);
                    setTimeout(function() {
                        juego(0);
                    },2000);
                }
            };
            xhttp.open("POST", "php/comprobarPregunta.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("respMarcada="+btn.id);    
        }

        let divContenedor = document.createElement("div");
        divContenedor.setAttribute("class","contenedorPreg");

        let punt = document.createElement("div");
        punt.setAttribute("class","puntuacion");

        let temp = document.createElement("div");
        temp.setAttribute("class","temporizador");
        temp.innerText = tmp;

        let numpreg = document.createElement("div");
        numpreg.setAttribute("class","contPreg");
        numpreg.setAttribute("id","contPreg");

        let preg = document.createElement("div");
        preg.setAttribute("class","pregunta");

        let resp1 = document.createElement("div");
        resp1.setAttribute("class","respuesta");
        resp1.setAttribute("id","respuesta1");
        resp1.addEventListener("click",function(e) {
            btnPress(e.target);
        })

        let resp2 = document.createElement("div");
        resp2.setAttribute("class","respuesta");
        resp2.setAttribute("id","respuesta2");
        resp2.addEventListener("click",function(e) {
            btnPress(e.target);
        })

        let resp3 = document.createElement("div");
        resp3.setAttribute("class","respuesta");
        resp3.setAttribute("id","respuesta3");
        resp3.addEventListener("click",function(e) {
            btnPress(e.target);
        })

        let resp4 = document.createElement("div");
        resp4.setAttribute("class","respuesta");
        resp4.setAttribute("id","respuesta4");
        resp4.addEventListener("click",function(e) {
            btnPress(e.target);
        })

        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() { 
            if (this.readyState == 4 && this.status == 200) {
                if(this.response!="elegir") {
                    console.log(this.response);
                    let pregunta = JSON.parse(this.response);
                    numpreg.innerText = pregunta.numPreg+"/"+15;
                    if(pregunta.numPreg>"15") {
                        clearInterval(cronometro);
                        menujuego("final");
                    }
                    preg.innerText = pregunta.pregunta;
                    resp1.innerText = pregunta.resp1;
                    resp2.innerText = pregunta.resp2;
                    resp3.innerText = pregunta.resp3;
                    resp4.innerText = pregunta.resp4;
                    punt.innerText = pregunta.puntuacion + "pts";

                } else {
                    let num = document.querySelector(".contPreg");
                    if(num.innerText.split("/")[0]>"15") {
                        clearInterval(cronometro);
                        menujuego("final");
                    } else {
                        console.log(this.response);
                        clearInterval(cronometro);
                        elegirMejora();
                    }
                }
            }    
        };

        xhttp.open("POST", "php/pedirPregunta.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        if(empieza==1) {
            xhttp.send("empieza="+empieza);
        } else if(typeof tema === "string" && typeof tema !== "undefined") {
            xhttp.send("tema="+tema);
        } else {
            xhttp.send();
        }

        divContenedor.appendChild(punt);
        divContenedor.appendChild(temp);
        divContenedor.appendChild(numpreg);
        divContenedor.appendChild(preg);
        divContenedor.appendChild(resp1);
        divContenedor.appendChild(resp2);
        divContenedor.appendChild(resp3);
        divContenedor.appendChild(resp4);
        main.appendChild(divContenedor);

        let crono = document.querySelector(".temporizador");

        cronometro = setInterval(function() {
            if(tmp==0) {
                clearInterval(cronometro);
                if(numpreg.innerText.split("/")[0]=="15") {
                    menujuego("final");
                } else {
                    juego(0);
                }
            }
            tmp--;
            crono.innerText = tmp;
        },1000);

    }

    function elegirMejora() {

        while(main.firstChild) {
            main.removeChild(main.firstChild);
        }

        let btntema = document.createElement("input");
        btntema.setAttribute("class","boton");
        btntema.setAttribute("type","button");
        btntema.setAttribute("name","continuar");
        btntema.setAttribute("value","Tema");
        btntema.addEventListener("click",function() {
            elegirTema();
        });

        let btnopcion = document.createElement("input");
        btnopcion.setAttribute("class","boton");
        btnopcion.setAttribute("type","button");
        btnopcion.setAttribute("name","continuar");
        btnopcion.setAttribute("value","Opción -");
        btnopcion.addEventListener("click",function() {
            juego(0);
        });

        main.appendChild(btntema);
        main.appendChild(btnopcion);
    }

    function elegirTema() {
        clearInterval(cronometro);
        while(main.firstChild) {
            main.removeChild(main.firstChild);
        }

        let div = document.createElement("div");
        div.setAttribute("id","div_form");

        let form = document.createElement("form");
        form.setAttribute("action","#");
        form.setAttribute("method","POST");
        form.setAttribute("id","form");
        form.setAttribute("name","form");
        form.setAttribute("autocomplete","off");

        let temaLabel = document.createElement("label");
        temaLabel.innerText = "Elija el tema de la siguiente pregunta: ";
        let selectTema = document.createElement("select");
        selectTema.setAttribute("id","tema");
        let opTema1 = document.createElement("option");
        opTema1.setAttribute("value","Arte");
        opTema1.innerText = "Arte";
        let opTema2 = document.createElement("option");
        opTema2.setAttribute("value","Ciencia");
        opTema2.innerText = "Ciencia";
        let opTema3 = document.createElement("option");
        opTema3.setAttribute("value","Deporte");
        opTema3.innerText = "Deporte";
        let opTema4 = document.createElement("option");
        opTema4.setAttribute("value","Entretenimiento");
        opTema4.innerText = "Entretenimiento";
        let opTema5 = document.createElement("option");
        opTema5.setAttribute("value","Historia");
        opTema5.innerText = "Historia";
        selectTema.appendChild(opTema1);
        selectTema.appendChild(opTema2);
        selectTema.appendChild(opTema3);
        selectTema.appendChild(opTema4);
        selectTema.appendChild(opTema5);

        let btn = document.createElement("input");
        btn.setAttribute("class","boton");
        btn.setAttribute("type","button");
        btn.setAttribute("name","continuar");
        btn.setAttribute("value","CONTINUAR");
        btn.addEventListener("click",function() {
            let tema = document.getElementById("tema").value;
            juego(tema);
        });

        form.appendChild(temaLabel);
        form.appendChild(selectTema);
        form.appendChild(btn);
        div.appendChild(form);
        main.appendChild(div);

    }

    function anyadirPregunta() {
        while(main.firstChild) {
            main.removeChild(main.firstChild);
        }

        let divErr = document.createElement("div");
        divErr.setAttribute("id","div_err");
        main.appendChild(divErr);

        let divForm = document.createElement("div");
        divForm.setAttribute("id","div_form");

        let form = document.createElement("form");
        form.setAttribute("action","#");
        form.setAttribute("method","POST");
        form.setAttribute("id","form");
        form.setAttribute("name","form");
        form.setAttribute("autocomplete","off");

        let labelPregunta = document.createElement("label");
        labelPregunta.innerText = "Pregunta: ";
        let inputPregunta = document.createElement("input");
        inputPregunta.setAttribute("type","text");
        inputPregunta.setAttribute("name","preg");
        inputPregunta.setAttribute("id","preg");
        inputPregunta.setAttribute("required","required");

        let labelRes1 = document.createElement("label");
        labelRes1.innerText = "1ª Respuesta: ";
        let inputRes1 = document.createElement("input");
        inputRes1.setAttribute("type","text");
        inputRes1.setAttribute("name","res1");
        inputRes1.setAttribute("id","res1");
        inputRes1.setAttribute("required","required");

        let labelRes2 = document.createElement("label");
        labelRes2.innerText = "2ª Respuesta: ";
        let inputRes2 = document.createElement("input");
        inputRes2.setAttribute("type","text");
        inputRes2.setAttribute("name","res2");
        inputRes2.setAttribute("id","res2");
        inputRes2.setAttribute("required","required");

        let labelRes3 = document.createElement("label");
        labelRes3.innerText = "3ª Respuesta: ";
        let inputRes3 = document.createElement("input");
        inputRes3.setAttribute("type","text");
        inputRes3.setAttribute("name","res3");
        inputRes3.setAttribute("id","res3");
        inputRes3.setAttribute("required","required");

        let labelRes4 = document.createElement("label");
        labelRes4.innerText = "4ª Respuesta: ";
        let inputRes4 = document.createElement("input");
        inputRes4.setAttribute("type","text");
        inputRes4.setAttribute("name","res4");
        inputRes4.setAttribute("id","res4");
        inputRes4.setAttribute("required","required");

        let labelResCo = document.createElement("label");
        labelResCo.innerText = "Respuesta Correcta: ";
        let selectResCo = document.createElement("select");
        selectResCo.setAttribute("id","resCorrecta");
        let opResCo1 = document.createElement("option");
        opResCo1.setAttribute("value","respuesta1");
        opResCo1.innerText = "Respuesta 1";
        let opResCo2 = document.createElement("option");
        opResCo2.setAttribute("value","respuesta2");
        opResCo2.innerText = "Respuesta 2";
        let opResCo3 = document.createElement("option");
        opResCo3.setAttribute("value","respuesta3");
        opResCo3.innerText = "Respuesta 3";
        let opResCo4 = document.createElement("option");
        opResCo4.setAttribute("value","respuesta4");
        opResCo4.innerText = "Respuesta 4";
        selectResCo.appendChild(opResCo1);
        selectResCo.appendChild(opResCo2);
        selectResCo.appendChild(opResCo3);
        selectResCo.appendChild(opResCo4);

        let labelTema = document.createElement("label");
        labelTema.innerText = "Tema: ";
        let selectTema = document.createElement("select");
        selectTema.setAttribute("id","tema");
        let opTema1 = document.createElement("option");
        opTema1.setAttribute("value","Arte");
        opTema1.innerText = "Arte";
        let opTema2 = document.createElement("option");
        opTema2.setAttribute("value","Ciencia");
        opTema2.innerText = "Ciencia";
        let opTema3 = document.createElement("option");
        opTema3.setAttribute("value","Deporte");
        opTema3.innerText = "Deporte";
        let opTema4 = document.createElement("option");
        opTema4.setAttribute("value","Entretenimiento");
        opTema4.innerText = "Entretenimiento";
        let opTema5 = document.createElement("option");
        opTema5.setAttribute("value","Historia");
        opTema5.innerText = "Historia";
        selectTema.appendChild(opTema1);
        selectTema.appendChild(opTema2);
        selectTema.appendChild(opTema3);
        selectTema.appendChild(opTema4);
        selectTema.appendChild(opTema5);

        let btn = document.createElement("input");
        btn.setAttribute("class","boton");
        btn.setAttribute("type","button");
        btn.setAttribute("name","submit");
        btn.setAttribute("value","ENVIAR");
        btn.addEventListener("click",function() {
            let xhttp = new XMLHttpRequest(); 
            // código que gestiona la respuesta asíncrona cuando llegue 
            xhttp.onreadystatechange = function() { 
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.response);
                    let error = document.getElementById("div_err");
                    if(this.response != "") {
                        error.style.color = "#F00";
                        error.innerText = "*Error del servidor";
                    } else {
                        error.style.color = "#AAA";
                        error.innerText = "Pregunta añadida."
                    }
                }
            }
            xhttp.open("POST", "php/anyadirPregunta.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            let preg = document.getElementById("preg").value;
            let res1 = document.getElementById("res1").value;
            let res2 = document.getElementById("res2").value;
            let res3 = document.getElementById("res3").value;
            let res4 = document.getElementById("res4").value;
            let resCo = document.getElementById("resCorrecta").value;
            let tema = document.getElementById("tema").value;
            xhttp.send("pregunta="+preg+"&resp1="+res1+"&resp2="+res2+"&resp3="+res3+"&resp4="+res4+"&respCorrecta="+resCo+"&cat="+tema);
        });

        let btnVolver = document.createElement("input");
        btnVolver.setAttribute("class","boton");
        btnVolver.setAttribute("type","button");
        btnVolver.setAttribute("name","volver");
        btnVolver.setAttribute("value","VOLVER");
        btnVolver.addEventListener("click",function() {
            menujuego();
        });

        form.appendChild(labelPregunta);
        form.appendChild(inputPregunta);
        form.appendChild(labelRes1);
        form.appendChild(inputRes1);
        form.appendChild(labelRes2);
        form.appendChild(inputRes2);
        form.appendChild(labelRes3);
        form.appendChild(inputRes3);
        form.appendChild(labelRes4);
        form.appendChild(inputRes4);
        form.appendChild(labelResCo);
        form.appendChild(selectResCo);
        form.appendChild(labelTema);
        form.appendChild(selectTema);
        form.appendChild(btn);
        form.appendChild(btnVolver);

        divForm.appendChild(form);
        main.appendChild(divForm);
    }

    function clasificacion(){
        while(main.firstChild) {
            main.removeChild(main.firstChild);
        }

        let rotulo = document.createElement("h1");
        rotulo.setAttribute("class","rotuloClasi");
        rotulo.innerText = "Clasificación";

        main.appendChild(rotulo);

        let xhttp = new XMLHttpRequest(); 
        // código que gestiona la respuesta asíncrona cuando llegue 
        xhttp.onreadystatechange = function() { 
            if (this.readyState == 4 && this.status == 200) {
                let clasificacion = JSON.parse(this.response);
                console.log(clasificacion);

                let tabla = document.createElement("table");
                tabla.setAttribute("class","clasificacion");

                let titulos = document.createElement("tr");
                titulos.setAttribute("class","clasiTitulos");

                let nomT = document.createElement("td");
                nomT.innerText = "Usuario";

                let puntT = document.createElement("td");
                puntT.innerText = "Puntuación";

                let fechaT = document.createElement("td");
                fechaT.innerText = "Fecha";

                titulos.appendChild(nomT);
                titulos.appendChild(puntT);
                titulos.appendChild(fechaT);

                tabla.appendChild(titulos);

                clasificacion.forEach(puesto => {

                    let fila = document.createElement("tr");

                    let nom = document.createElement("td");
                    nom.innerText = puesto.nombreUsu;

                    let punt = document.createElement("td");
                    punt.innerText = puesto.puntuacion;

                    let fecha = document.createElement("td");
                    fecha.innerText = puesto.fecha;

                    fila.appendChild(nom);
                    fila.appendChild(punt);
                    fila.appendChild(fecha);

                    tabla.appendChild(fila);
                });

                main.appendChild(tabla);

                let atras = document.createElement("input");
                atras.setAttribute("class","botonMenu");
                atras.setAttribute("type","button");
                atras.setAttribute("value","Atrás");
                atras.addEventListener("click",function() {
                    menujuego();
                });

                main.appendChild(atras);
            }
        }
        xhttp.open("GET", "php/mostrarClasificacion.php", true);
        xhttp.send();
    }

    btnLogin.addEventListener("click",crearForm);
    btnRegister.addEventListener("click",crearForm);
    botonForm.addEventListener("click",eventDispatch);
});