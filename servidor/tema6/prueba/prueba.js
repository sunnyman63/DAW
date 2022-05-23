window.addEventListener("load",function() {

    var div = document.getElementById("div");
    var current = new Date();
    current.setHours(02);
    current.setMinutes(00);
    current.setSeconds(00);
    current.setMilliseconds(00);

    var fechaDada = new Date("2022-05-23");

    comprobarTiempo(fechaDada);

    div.innerText = fechaDada.getTime() - current.getTime();

    function getFechaMax() {
        
        let months = [31,28,31,30,31,30,31,31,30,31,30,31];
        let mes = current.getMonth();
        let dia = current.getDate();

        for(let i = 1; i<16; i++) {
            if(dia < months[mes]) {
                dia++;
            } else {
                mes += 1;
                dia = 1;
            }
        }

        let fechaMax = new Date(current.getFullYear()+"-"+0+(mes+1)+"-"+0+dia);

        return fechaMax;
    }

    function fechaValida(fecha) {

        let fechaDada = fecha;
        let fechaMax = getFechaMax();
        let fechaSuperiorAHoy = fechaDada.getTime() >= current.getTime();
        let fechaInferiorAMax = fechaDada.getTime() <= fechaMax.getTime();

        if(fechaSuperiorAHoy && fechaInferiorAMax) {
            return true;
        }

        return false;
    }

    function comprobarTiempo(fecha) {
        if(fechaValida(fecha)) {
            fetch('https://api.weatherbit.io/v2.0/forecast/daily?postal_code=46185&key=e53b832e64a347d3a9f2138657758b37&lang=es')
            .then(response => response.json())
            .then((response) => {
                let dia = (fecha.getTime()-current.getTime())/86400000;
                console.log(response.data[dia].weather);
            });
        } else {
            console.log("tonto");
        }
    }

});