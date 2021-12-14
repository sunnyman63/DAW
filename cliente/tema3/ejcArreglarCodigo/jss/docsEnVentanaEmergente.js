var texto = prompt("Ingresa un título para la nueva ventana: ");
var ventanaNueva = window.open();
ventanaNueva.document.write("<h1>" + texto + "</h1>");