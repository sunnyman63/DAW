var bombero = {
    vidas: 3,
    
    mover:function(direccion) {
        let bombero = $("#bombero");
        let position = bombero.position();
        let left = position.left;
        let tl = gsap.timeline();
        switch(direccion) {
            case "Izquierda":
                if(left>0) {
                    if(left>=20) {
                        tl.to(bombero, {duration: 0.1, x:"-=20"});
                    } else {
                        tl.to(bombero, {duration: 0.1, x:"-="+left});
                    }
                }
                break;
            case "Derecha":
                if(left<900) {
                    if(left<=880) {
                        tl.to(bombero, {duration: 0.1, x:"+=20"});
                    } else {
                        tl.to(bombero, {duration: 0.1, x:"+="+(900-left)});
                    }
                }
                break;
        }
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
        let persona = '<div class=\"persona persona' + aleatorio + '\">'
                            +'<img src=\"' + this.imagenes[aleatorio] + '\">'
                     +'</div>';
        edificio.append(persona);
        return aleatorio;
    }
}

var intervalo = 0;

function caer(objeto) {
    let persona = $(objeto);
    let position = persona.offset();
    let top = position.top;
    let tl = gsap.timeline({onComplete: function() {
        persona.remove();
        clearInterval(intervalo);
        let vidas = parseInt($("#numVidas").text())-1;
        if(vidas > 0) {
            $("#numVidas").text(vidas);
            console.log("muelto");
            juego();
        } else {
            let final ='<div class="menu">' 
                        + '<div class="pautas"><div>Has perdido!!</div></div>'
                        + '<div class="boton"><a href=".">JUGAR OTRA VEZ</a></div>'
                     + '</div>'
            $(".menu").remove();
            $(".inicio").append(final);
            $(".inicio").fadeIn();
        }
    }});
    if(top == 140) {
        tl.to(persona, {duration: 4, ease: "none", y:"+=535"});
        intervalo = setInterval(function(){
            if(colision(persona,$("#bombero"))) {
                tl.pause();
                persona.remove();
                clearInterval(intervalo);
                console.log("vivo");
                juego();
            }
        },24);
    } else {
        tl.to(persona, {duration: 3, ease: "none", y:"+=285"});
        intervalo = setInterval(function(){
            if(colision(persona,$("#bombero"))) {
                tl.pause();
                persona.remove();
                clearInterval(intervalo);
                console.log("vivo");
                juego();
            }
        },24);
    }
}

function colision(objeto,bombero) {
    let posObjeto = objeto.position();
    let posBombero = bombero.position();
    if(posObjeto.top >= (posBombero.top - 100)) {
        if(posObjeto.left >= (posBombero.left - 150) && posObjeto.left < (posBombero.left + 50)) {
            //console.log("posObj -> "+ posObjeto.left + ", posBomb -> " + posBombero.left);
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function juego() {
    let person = ".persona" + persona.crearPersona($("#edificio"));
    caer(person);
}

$(document).on('keypress', function(e) {
    var key = e.keyCode;  
    switch(key) {
        case 97:
            bombero.mover("Izquierda");
            break;
        case 100:
            bombero.mover("Derecha");
            break;
    }
});

$("#boton").click(function (e) { 
    $(".inicio").fadeOut();
    juego();
});

