function animacion() {
    var intervalo = setInterval(function(){
        var pos = $(".personaje").position();
        if(pos.left > -400) {
            $(".personaje").css("left",(pos.left-100)+"px");
        } else if(pos.left == -400) {
            $(".personaje").css("left","0px");
        }
    },150);
}

animacion();