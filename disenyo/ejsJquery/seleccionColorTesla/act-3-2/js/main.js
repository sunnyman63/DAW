var coloresTesla = {
    colores: ['blanco','rojo','negro','cafe','rojooscuro'],
    init:function() {
        for(var i=0;i<this.colores.length;i++) {
            var color = this.colores[i];
            var linea = '<option value="'+color+'">'+color+'</option>'
            $('#selector').append(linea);
        }
    }
};

coloresTesla.init();

$('#selector').on('change', function () {
    $('#coche').attr('src','../imgs/modelS-'+$(this).val()+'.jpg');
});