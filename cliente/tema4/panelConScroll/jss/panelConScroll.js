var container = document.getElementById("container");
var boton = document.getElementById("boton");

function apboton() {
    if(container.scrollTop + container.offsetHeight >= container.scrollHeight-1){
        if(container.value == 1) {
            boton.style.display = "none";
            console.log("hola");
        } else {
            boton.style.display = "inline";
        }
    } else {
        boton.style.display = "none";
    }
}

container.addEventListener("scroll",apboton);
boton.addEventListener("click",function(){
    container.style.display = "none";
});
