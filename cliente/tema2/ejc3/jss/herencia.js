function Ordenador(marca,modelo,ram = 4,discoD = 512,pulgadas = 17) {
    this.marca = marca;
    this.modelo = modelo;
    this.ram = ram+" GB";
    this.discoD = discoD+" GB";
    this.pulgadas = pulgadas+" pulgadas";
}

Ordenador.prototype.toString = function() {
    let detalles = 
    "<b>Marca: </b>"+String(this.marca) + "<br>"+
    "<b>Modelo: </b>"+String(this.modelo) + "<br>" +
    "<b>Memoria RAM: </b>"+String(this.ram) + "<br>" +
    "<b>Disco Duro: </b>"+String(this.discoD) + "<br>" +
    "<b>Pulgadas: </b>"+String(this.pulgadas) + "<br>";
    if(typeof this.autonomia !== "undefined") {
        detalles += "<b>Autonomia: </b>"+String(this.autonomia)+"<br>";
    }
    return detalles;
}

function Portatil(marca,modelo,ram,discoD = 256,pulgadas = 12,autonomia = 4) {
    Ordenador.call(this,marca,modelo,ram,discoD,pulgadas);
    this.autonomia = autonomia+" horas";
}

Portatil.prototype = Object.create(Ordenador.prototype);

var o1 = new Ordenador("Alienware","z570",16,2048,21);
document.write("Ordenador 1: <br>");
document.write(o1.toString()+"<br>");

var o2 = new Ordenador("Asus","M56P2");
document.write("Ordenador 2: <br>");
document.write(o2.toString()+"<br>");

var p1 = new Portatil("Alienware","p3783");
document.write("Portatil 1: <br>");
document.write(p1.toString()+"<br>");

var p2 = new Portatil("Toshiba","x028P4",6,1024,18,10);
document.write("Portatil 2: <br>");
document.write(p2.toString()+"<br>");