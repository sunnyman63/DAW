window.addEventListener("load",function() {

    var contador = document.getElementById("contador");
    var date = new Date();
    date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));//Saca la fecha actual mas 1 dia en ms

    var r = confirm("Acepta que esta pagina use cookies?");
    if (r == true) {
        var cookies = document.cookie;
        if(!cookies) {
            document.cookie = "contador=1; expires="+date+"; secure";
        } else {
            cookies = document.cookie;
            cookies = cookies.split("=");
            let val = parseInt(cookies[1])+1;
            document.cookie = "contador="+val+"; expires="+date+"; secure";
        }

        cookies = document.cookie;
        cookies = cookies.split("=");
        contador.innerHTML = "Contador de visitas: "+cookies[1];
    } else {
        document.cookie = "contador=patata; expires=Thu, 01 Jan 1970 00:00:00 UTC; secure";
        contador.innerHTML = "No ha aceptado usar cookies :(";
    }  
});