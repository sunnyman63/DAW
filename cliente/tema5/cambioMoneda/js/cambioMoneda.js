async function cargarTipos(select) {
    const res = await fetch(
        "http://api.exchangeratesapi.io/v1/latest?access_key=7c2fd0edd5964cb9f9e1d9d5f88ea328&format=1"
    );

    let lista = await res.json();
    let rates = Object.keys(lista.rates);
    
    for(let i = 0; i < rates.length; i++) {
        let op = document.createElement("option");
        op.setAttribute("value",rates[i]);
        if(rates[i]=="EUR") {
            op.setAttribute("selected","true");
        }
        op.innerText = rates[i];
        select.appendChild(op);
    }
}

async function conversor(base,monedaBase,monedaConvertir,resultado) {
    
    if(monedaBase == monedaConvertir) {
    
        resultado.innerText = base;
    
    } else if(monedaBase == "EUR") {
    
        const EURaOTRO = await fetch(
            "http://api.exchangeratesapi.io/v1/latest?access_key=7c2fd0edd5964cb9f9e1d9d5f88ea328&format=1&symbols="+
            monedaConvertir
        );
        let lista = await EURaOTRO.json();
        let res = Object.values(lista.rates);
    
        resultado.innerText = res[0] * base;

    } else {

        const OTROaOTRO = await fetch(
            "http://api.exchangeratesapi.io/v1/latest?access_key=7c2fd0edd5964cb9f9e1d9d5f88ea328&format=1&symbols="+
            monedaBase+","+monedaConvertir
        );

        let lista = await OTROaOTRO.json();
        let res = Object.values(lista.rates);

        let BASEaEUR = base/res[0];
        let EURaCONV = BASEaEUR * res[1];

        resultado.innerText = EURaCONV;
    }
}

window.addEventListener("load",function() {

    var form = document.getElementById("form");
    var cantBase = document.getElementById("cantidadBase");
    cantBase.value = 1;
    var monedaBase = document.getElementById("monedaBase");
    var monedaConvertir = document.getElementById("monedaConvertir");
    var btnConvertir = document.getElementById("btnConvertir");
    var resultado = document.getElementById("resultado");
    cargarTipos(monedaBase);
    cargarTipos(monedaConvertir);

    btnConvertir.addEventListener("click",function() {
        setTimeout(() => {
            conversor(cantBase.value,monedaBase.value,monedaConvertir.value,resultado);    
        }, 100);
    });

    form.addEventListener("click",function() {
        resultado.innerText = "";
    });
});