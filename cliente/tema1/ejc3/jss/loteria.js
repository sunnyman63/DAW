function numerosAleatoriosUnicos() {
    let boleto = [];
    for(let i = 1; i <= 6; i++) {
        let num = 0;
        let esta = false;
        do{
            num = Math.floor(Math.random()*49)+1;
            if(boleto.length == 0) {
                esta == false;
            }
            for(let j = 0; j < boleto.length; j++){
                if(num == boleto[j]) {
                    esta = true;
                    break;
                } else {
                    esta = false;
                }
            }
        }while(esta == true);
        boleto.push(num);
    }
    return boleto;
}

function mostrarXNumerosLoteria(cantidad) {
    for(let i = 1; i <= cantidad; i++) {
        document.write("<b>Boleto "+i+":</b> "+numerosAleatoriosUnicos().join()+"<br>");
    }
}

mostrarXNumerosLoteria(50);