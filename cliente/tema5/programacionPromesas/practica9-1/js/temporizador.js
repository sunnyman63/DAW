function temporizador(tiempo) {
    var promesa = new Promise((resolver, rechazar)=> {
        var temp = setTimeout(()=> {
            clearTimeout(temp2);
            resolver("Tiempo concluido");
        },tiempo);
        var temp2 = setTimeout(()=> {
            rechazar("El tiempo no va bien");
        },tiempo+2);
    });
    return promesa;
}

temporizador(5000).then((texto)=>{
    document.body.innerHTML = "<p>"+texto+"</p>";
}).catch((mensaje)=> {
    document.body.textContent = mensaje;
});