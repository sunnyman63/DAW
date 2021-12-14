window.addEventListener("load",function() {
    var h1 = document.querySelector(".h1");
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() { 
        if (this.readyState == 4 && this.status == 200) { 
            h1.innerHTML = this.response;  
        }    
    };
    xhttp.open("GET", "prueba1.php", false);
    xhttp.send();
});