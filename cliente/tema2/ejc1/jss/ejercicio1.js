//--1---------------------------------------------------------

function Persona(nombre,fechaNacimiento){
    this.nombre = nombre;
    //Expresion regular para una fecha en formato DD/MM/YYYY (creo)
    var regFech = RegExp(/^([0-2][0-9]||3[0-1])\/(0[0-9]||1[0-2])\/([0-9][0-9])?[0-9][0-9]$/);
    //Si el formato de la fecha pasada coincide con la expresión regular
    if(regFech.test(fechaNacimiento)){
        //Separas la fecha en un array y luego la ordenas para que el
        //formato de la fecha sea valido al meterlo en el objeto Date
        var fecha = fechaNacimiento.split("/");
        this.fechaNacimiento = new Date(fecha[1]+"/"+fecha[0]+"/"+fecha[2]);
    } else {
        console.error("no es una fecha valida");
        this.fechaNacimiento = new Date("01/01/1970");
    }
}

//Función para sacar cuantos meses faltan para que cumpla años
Persona.prototype.getCumple = function(){
    //Mes en el que cumple los años la persona
    let mes = this.fechaNacimiento.getMonth();
    //Fecha actual
    let now = new Date();
    //Si el mes de su cumpleaños es el mismo que el actual
    if(now.getMonth()==mes){
        return ""+this.nombre+" cumple años este mes<br>";
    }
    //Si el mes en el que cumple los años ya ha pasado.
    else if(mes<now.getMonth()){
        let mss = 12-(now.getMonth()-mes);
        return "A "+this.nombre+" le quedan "+mss+" meses para cumplir años.<br>";
    }
    //Si todavia no ha llegado el mes en el que cumple los años
    else{
        let mss = mes-now.getMonth();
        return "A "+this.nombre+" le quedan "+mss+" meses para cumplir años.<br>";
    }
    
}

//Función para mostrar el nombre y la fecha de cumpleaños en formato DD/MM/YYYY
Persona.prototype.toString = function() {
    var dia = this.fechaNacimiento.getDate();
    var mes = this.fechaNacimiento.getMonth()+1;
    var anyo = this.fechaNacimiento.getFullYear();

    return this.nombre+": "+dia+"/"+mes+"/"+anyo+"<br>";
}

//Creamos el array y le metemos las personas(tambien creadas)

var personas = new Array();
var p1 = new Persona("Marcos","30/09/1984");
personas.push(p1);
var p2 = new Persona("Juan","25/02/1978");
personas.push(p2);
var p3 = new Persona("Isabel","09/05/2001");
personas.push(p3);
var p4 = new Persona("Ana","12/10/1965");
personas.push(p4);
var p5 = new Persona("Pepe","15/08/1965");
personas.push(p5);
var p6 = new Persona("María","01/06/1994");
personas.push(p6);

//Ordenamos el array de personas según la fecha de cumpleaños
personas.sort((a,b)=>a.fechaNacimiento - b.fechaNacimiento);

//Mostramos los datos y lo que falta para el cumpleaños por cada
//persona del array
personas.forEach(element => {
    document.write(element.toString());
    document.write(element.getCumple());
    document.write("<br>");
});

