var numSecret =  Math.floor((Math.random() * 100) + 1);
var intentos = 0;
var num = 0;

function alarma(tipoAlarma) {
    switch(tipoAlarma){
        case 0: 
            document.write("Acertaste, es el numero "+numSecret+"!!<br>Número total de intentos: "+intentos);break;
        case 1:
            document.write("Se a cancelado el juego<br>Número correcto: "+numSecret+"<br>Número total de intentos: "+intentos);break;
        case 2:
            alert("Lo ingresado debe ser un numero (Sin decimales).");break;
        case 3:
            alert("Debe insertar un número (Sin decimales)");break;
        case 4:
            if(num>numSecret){
                alert("El numero secreto es MENOR al que has escrito.");
            } else {
                alert("El numero secreto es MAYOR al que has escrito.");
            }break;
    }
}

function confirmacion() {
    var quest = confirm("Quieres seguir jugando?");
    if(quest){
        pregunta();
    } else {
        alarma(1);
    }
}

function pregunta() {
    var nume = prompt("Porfavor ingrese un número (Sin decimales)","");
    
    if (nume != null) {
        if(nume == "") {
            alarma(3);
            pregunta();
        } else {
            num = Number(nume);
            if(isNaN(num)){
                alarma(2);
                pregunta();
            }else{
                intentos += 1;
    
                if(num==numSecret) {
                    alarma(0);
                }else{
                    alarma(4);
                    confirmacion(); 
                }
            } 
        } 
    } else {
        alarma(1);
    }     
}
console.log(numSecret);
pregunta();