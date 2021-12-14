console.log("EJERCICIO 1=========================================");


function mayor(cad1,cad2){
    if(typeof cad1 !== "string" || typeof cad2 !== "string") {
        console.log("Las dos entradas deben ser strings.")
    } else if(cad1.length>cad2.length) {
        console.log("La palabra "+cad1+" es más larga que " + cad2);  
    } else {
        console.log("La palabra "+cad2+" es más larga que " + cad1)
    }
}

mayor("pato","patata");
mayor("girafa","mar");
mayor("bola",2);