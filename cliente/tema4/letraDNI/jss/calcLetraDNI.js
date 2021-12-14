var btn = document.getElementById("boton");
var dni = document.getElementById("dni");
var letra = document.getElementById("letra");

function validar() {
    let x = document.forms["form"]["dni"].value;
    let val = parseInt(x);
    console.log(val);
    if(isNaN(val)) {
        alert("Escriba ıniciamente dıgitos del 0 al 9 en el campo 'DNI'");
        dni.value = "";
        letra.value = "";
    } else if(x.length != 8) {
        alert("Debe insertar un numero de 8 cifras!!");
        dni.value = "";
        letra.value = "";
    } else {
        calcularLetra();
    }
}

function calcularLetra() {
    let cadena="TRWAGMYFPDXBNJZSQVHLCKET";
    let posicion = dni.value%23;
    let valor = cadena.substring(posicion,posicion+1);
    letra.value = valor;
}

btn.addEventListener("click",validar);