$('#selector').on('change', function () {
    $('#coche').attr('src','../imgs/modelS-'+$(this).val()+'.jpg');
});