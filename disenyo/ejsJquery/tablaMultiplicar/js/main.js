var cont = 1;

$('button').on("click",function() {
    var tabla = $("select").val();
    var fila = "<p> "+tabla+" x "+cont+" = "+(tabla*cont)+"</p>";
    $('#tabla').append(fila);
    cont++;
});

$('select').on("change",function() {
    var tabla = $("select").val();
    $("h1 span").text(tabla);
    $('#tabla').empty();
    cont = 1;
});