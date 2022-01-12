var coloresTesla = {
    colores: ['blanco','rojo','negro','cafe','rojooscuro'],
    init:function() {
        for(var i=0;i<this.colores.length;i++) {
            var color = this.colores[i];
            var linea = '<option value="'+color+'">'+color+'</option>'
            $('#selector').append(linea);
        }

        $('#selector').on('change', function () {
            $('#loader').fadeIn();
            setTimeout(function(){
                $('#coche').attr('src','http://jfajardo.ieslavereda.es/ImgTesla/modelS-'+$('#selector').val()+'.jpg');
                $('#loader').fadeOut();
            },500);
            
        });
    }
};

coloresTesla.init();