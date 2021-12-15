(function() {
    var contador = 0;
    $('body').on("click","h3",function() {
        contador++;
        var elem = "<h3>nuevo elemento h3 dinámico: "+contador+"</h3>";
        //console.log(contador);
        $('body').append(elem);
        $('h3').eq(3).bind("click",function() {
            console.log("hola");
        });
    });
})();