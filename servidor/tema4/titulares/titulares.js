function loadDoc() { 
    var xhttp = new XMLHttpRequest(); 
    xhttp.onreadystatechange = function() { 
        if (this.readyState == 4 && this.status == 200) {
            let li = document.createElement("li");
            li.innerHTML = this.responseText;
            let lista = document.getElementById("lista");
            lista.insertBefore(li,lista.firstChild);
        } 
    }; 
    xhttp.open("GET", "titulares.php", true); 
    xhttp.send(); 
    return false; 
} 
setInterval(loadDoc, 5000);