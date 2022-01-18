(function() {

    function mover(direccion) {
        var cajaroja = $(".cajaroja");
        cajaroja.clearQueue();
        var cajaazul = $(".cajaazul");
        var tl = gsap.timeline();

        switch(direccion) {
            case "Abajo":
                $(".cajaroja").animate({
                    top: "+=50px"
                },100);
                tl.to(cajaazul, {duration: 0.1, y:"+=50"});
                break;
            case "Arriba":
                $(".cajaroja").animate({
                    top: "-=50px"
                },100);
                tl.to(cajaazul, {duration: 0.1, y:"-=50"});
                break;
            case "Izquierda":
                $(".cajaroja").animate({
                    left: "-=50px"
                },100);
                tl.to(cajaazul, {duration: 0.1, x:"-=50"});
                break;
            case "Derecha":
                $(".cajaroja").animate({
                    left: "+=50px"
                },100);
                tl.to(cajaazul, {duration: 0.1, x:"+=50"});
                break;
            case "Aumentar":
                $(".cajaroja").animate({
                    height: "+=50px",
                    width: "+=50px"
                },100);
                tl.to(cajaazul, {duration: 0.1, width:"+=50", height: "+=50"});
                break;
            case "Reset":
                $(".cajaroja").animate({
                    top: "0px",
                    left: "0px",
                    height: "50px",
                    width: "50px"
                },100);
                tl.to(cajaazul, {duration: 0.1, y:"0", x: "0", width: "50", height: "50"});
        }
    }

    $("button").on('click',function() {
        var direcc = $(this).data("direccion");
        $(".cajaroja").clearQueue();
        mover(direcc);
    });

    $(document).on('keypress', function(e) {
        var key = e.keyCode;
        $(".cajaroja").clearQueue();   
        switch(key) {
            case 119:
                mover("Arriba");
                break;
            case 115:
                mover("Abajo");
                break;
            case 97:
                mover("Izquierda");
                break;
            case 100:
                mover("Derecha");
                break;
        }
    });

})()