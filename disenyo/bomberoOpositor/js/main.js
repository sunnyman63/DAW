var bombero = {
    vidas: 3,
    
    mover:function(direccion) {
        let bombero = $("#bombero");
        let position = bombero.position();
        let left = position.left;
        let tl = gsap.timeline();
        switch(direccion) {
            case "Izquierda":
                bombero.css("background-image","url('./img/bombero2.png')");
                if(left>0) {
                    if(left>=20) {
                        tl.to(bombero, {duration: 0.1, x:"-=20"});
                    } else {
                        tl.to(bombero, {duration: 0.1, x:"-="+left});
                    }
                }
                break;
            case "Derecha":
                bombero.css("background-image","url('./img/bombero.png')");
                if(left<900) {
                    if(left<=880) {
                        tl.to(bombero, {duration: 0.1, x:"+=20"});
                    } else {
                        tl.to(bombero, {duration: 0.1, x:"+="+(900-left)});
                    }
                }
                break;
        }
    },

    disparar:function(edificio) {

        let oldChorro = $(".chorro");
        if(oldChorro.length > 0) {
            oldChorro.remove();
        }

        let posBombero = $("#bombero").position();
        let chorro = '<div class=\"chorro\" style=\"left:'+ posBombero.left +'px;\">'
                            +'<img src=\"./img/agua.png\">'
                     +'</div>';
        
        edificio.append(chorro);
        let newtl = gsap.timeline({onComplete: function() {
            $(".chorro").remove();
        }});

        newtl.to($(".chorro"), {duration: 0.3, ease: "none", y:"-=630"});

    }
}

var persona = {
    imagenes: [
        './img/persona.png',
        './img/persona2.png',
        './img/persona3.png',
        './img/persona4.png',
        './img/persona5.png',
        './img/persona4.png',
        './img/persona3.png',
        './img/persona.png',
        './img/persona5.png',
        './img/persona2.png'
    ],

    crearPersona:function(edificio) {
        let aleatorio = Math.floor(Math.random() * (10 - 0)) + 0;
        let persona = '<div class=\"objeto objeto' + aleatorio + '\" data-info="persona">'
                            +'<img src=\"' + this.imagenes[aleatorio] + '\">'
                     +'</div>';
        edificio.append(persona);
        return aleatorio;
    }
}

var fuego = {
    imagen: './img/fuego.png',

    crearFuego:function(edificio) {
        let aleatorio = Math.floor(Math.random() * (10 - 0)) + 0;
        let fuego = '<div class=\"objeto objeto' + aleatorio + '\" data-info="fuego">'
                            +'<img src=\"' + this.imagen + '\">'
                     +'</div>';
        edificio.append(fuego);
        return aleatorio;
    }
}

var intervalo = 0;

function caer(objeto) {
    let cuerpo = $(objeto);
    let position = cuerpo.position();
    let top = position.top;
    let tl = gsap.timeline({onComplete: function() {
        clearInterval(intervalo);
        console.log("muelto");
        cuerpo.remove();
        if(cuerpo.data("info") == "persona") {
            let vidas = parseInt($("#numVidas").text())-1;
            if(vidas > 0) {
                $("#numVidas").text(vidas);
                juego();
            } else {
                $("#numVidas").text(vidas);
                final();
            }
        } else {
            let pts = parseInt($("#pts").text());
            pts = pts - 5;
            $("#pts").text(pts);
            juego();
        }
        
    }});
    if(top == 140) {
        tl.to(cuerpo, {duration: 3, ease: "none", y:"+=540"});
    } else {
        tl.to(cuerpo, {duration: 2, ease: "none", y:"+=285"});
    }

    intervalo = setInterval(function(){
        if(colision(cuerpo,$("#bombero"))) {
            clearInterval(intervalo);
            let pts = parseInt($("#pts").text());
            if(cuerpo.data("info") == "persona") {
                console.log("vivo");
                pts = pts + 10;
                $("#pts").text(pts);
            } else {
                pts = pts - 10;
                $("#pts").text(pts);
            }
            tl.pause();
            cuerpo.remove();
            
            if(pts >= 200) {
                final(pts);
            } else {
                juego();
            }
        }
        
        if(cuerpo.data("info") == "fuego") {
            let chorro = $(".chorro");
            if(chorro.length > 0) {
                if(colision(cuerpo,$(".chorro"))) {
                    clearInterval(intervalo);
                    let pts = parseInt($("#pts").text());
                    console.log("apagado");
                    tl.pause();
                    cuerpo.remove();
                    $(".chorro").remove();
                    pts = pts + 10;
                    $("#pts").text(pts);
    
                    if(pts >= 200) {
                        final(pts);
                    } else {
                        juego();
                    }
                }
            }       
        }
        
    },24);
}

function final(pts) {
    let msg = "";
    console.log(pts);
    if(pts >= 200) {
        msg = "Has ganadoooooooooooooo!!!";
    } else {
        msg = "Has perdido! :("
    }
    let final ='<div class="menu">' 
    + '<div class="pautas"><div>'+msg+'</div></div>'
    + '<div class="boton"><a href=".">JUGAR OTRA VEZ</a></div>'
    + '</div>'
    $(".menu").remove();
    $(".inicio").append(final);
    $(".inicio").fadeIn();
}

function colision(objeto,bombero) {
    let posObjeto = objeto.position();
    let posBombero = bombero.position();
    if(posObjeto.top >= (posBombero.top - 100)) {
        if(posObjeto.left >= (posBombero.left - 150) && posObjeto.left < (posBombero.left + 50)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function juego() {
    let aleatorio = Math.floor(Math.random() * (10 - 0)) + 0;
    let objeto = ".objeto";
    if(aleatorio <= 5) {
        objeto = objeto + persona.crearPersona($("#edificio"));
    } else {
        objeto = objeto + fuego.crearFuego($("#edificio"));
    }
    
    caer(objeto);
}

$(document).on('keydown', function(e) {
    var key = e.keyCode;  
    switch(key) {
        case 37:
            bombero.mover("Izquierda");
            break;
        case 39:
            bombero.mover("Derecha");
            break;
        case 38:
            bombero.disparar($('#edificio'))
            break;
    }
});

$("#boton").click(function (e) { 
    $(".inicio").fadeOut();
    $(".bombero").css('bottom','0px');
    juego();
});

