var contador = document.getElementById("velocimetro");
contador.value = 0;

function editarVelocimetro(e) {
    let tecla = e.key;
    let valor = parseInt(contador.value);
    if(tecla == "ArrowUp") {
        if(valor < 120){
            valor += 1;
            contador.value = valor;
        }
    }
    if(tecla == "ArrowDown") {
        if(valor > 0) {
            valor -= 1;
            contador.value = valor;
        }
    }
}

window.addEventListener("keyup",editarVelocimetro);