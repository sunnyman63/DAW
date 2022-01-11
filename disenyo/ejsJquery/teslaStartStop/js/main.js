var coche = {
    arrancando: false,
    ruedas: 4,
    colores: ['rojo','verde','blanco','negro'],

    arrancar:function() {
        if(coche.arrancando == false) {
            $('#msj').text('Motor Arrancado...');
            $('#msj').attr('class',this.colores[1]);
            coche.arrancando = true;
        } else {
            $('#msj').text('El motor ya esta arrancado.');
            $('#msj').attr('class',this.colores[0]);
        }
    },

    apagar:function() {
        if(coche.arrancando == true) {
            $('#msj').text('Motor Apagado...');
            $('#msj').attr('class',this.colores[1]);
            coche.arrancando = false;
        } else {
            $('#msj').text('El motor ya esta apagado.');
            $('#msj').attr('class',this.colores[0]);
        }
    }
};

$('.start').on('click',function() {
    coche.arrancar();
});
$('.stop').on('click',function() {
    coche.apagar();
});
