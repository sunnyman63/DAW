
function cambiarSlider(pos) {
    var carrousel = $(".carrousel");
    var tl = gsap.timeline();
    var posicion = "0";
    switch(pos) {
        case 1: posicion = "-600"; break;
        case 2: posicion = "-1200"; break;
        case 3: posicion = "-1800"; break;
        case 4: posicion = "0"; break;
    }
    
    console.log(posicion);

    var actual = $(".minibotones").find("div").eq(pos);
    var demas = $(".minibotones").find("div").not(actual);

    tl.to(actual, {duration: 0.1, ease: "none", backgroundColor: "#555"});
    tl.to(demas, {duration: 0.1, ease: "none", backgroundColor: "#aaa"});

    tl.to(carrousel, {
        duration: 1, ease: "elastic", x: posicion
    });
}

var clicks = 0;
$(".btnIzq").on("click",function() {
    if(clicks == 0) {
        clicks = 4;
    }
    --clicks;
    cambiarSlider(clicks);
});

$(".btnDer").on("click",function() {
    if(clicks == 4) {
        clicks = 0;
    }
    ++clicks;
    cambiarSlider(clicks);
});

$(".miniboton").on("click",function() {
    var num = $(this).data();
    clicks = num.posicion-1;

    cambiarSlider(num.posicion-1);
});