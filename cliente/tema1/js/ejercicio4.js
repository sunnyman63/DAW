console.log("EJERCICIO 4=========================================");

function precioFinal(nom,pre,imp) {
    var nombre;
    var precio;
    var impuesto; 

    if(typeof nom === "undefined"){
        nombre = "producto genérico";
    } else {
        nombre = String(nom);
    }
    
    if(typeof pre === "undefined"){
        precio = 100;
    } else {
        precio = Number(pre);
    }
    
    if(typeof imp === "undefined"){
        impuesto = 21;
    } else {
        impuesto = Number(imp);
    }
    
    if(isNaN(precio) || isNaN(impuesto)){
        console.log("Tanto el precio como el impuesto deben ser números.")
    } else {
        console.log(nombre+": "+ (precio+((precio*impuesto)/100)));
    }
}

var nam;
var price;
var tax;

precioFinal(nam,price,tax);

nam = "Coche";
price = "patata";
tax = 16;

precioFinal(nam,price,tax);

nam = "Coche";
price = 10000;
tax = 16;

precioFinal(nam,price,tax);

nam = "Coche";
price = 10000;
tax = "IVA";

precioFinal(nam,price,tax);

