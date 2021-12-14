window.addEventListener("load",function() {
    var carga = document.getElementById("carga");
    carga.style.animationName = "animacion";
    carga.style.animationDuration = "0.5s";

    setTimeout(function() {
        carga.style.display = "none";
    },500);
    
});