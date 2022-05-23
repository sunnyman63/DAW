window.addEventListener("load",function(){

    var toast = document.getElementById("liveToast");
    var FechaMes = document.getElementById('fechaMesSelect');
    var FechaDia = document.getElementById("fechaDiaSelect");
    var FechaAnyo = document.getElementById("fechaAnyoSelect");
    var horaSelect = document.getElementById("horaSelect");
    var disponibilidad = document.getElementById("disponibilidadCheck");
    var campoSelect = document.getElementById("campoSelect");
    var botonCheck = document.getElementById("botonCheck");
    var botonSubmit = document.getElementById("submit");
    var fechaSeleccionada = document.getElementById("diaSelecionado");
    var imgTiempo = document.getElementById("imgTiempo");
    var textoTiempo = document.getElementById("textoTiempo");

    var current = new Date();
    current.setHours(02);
    current.setMinutes(00);
    current.setSeconds(00);
    current.setMilliseconds(00);

    function toastGone() {
        toast.style.display = "none";
    }

    if(toast != null) {
        this.setTimeout(toastGone,10000);

        document.getElementById("botonToast").addEventListener("click",function() {
            toastGone();
        });
    }

    function cargarDiasMes(FechaDia, max) {

        while(FechaDia.firstElementChild) {
            FechaDia.removeChild(FechaDia.firstElementChild);
        }
        for(let i=1;i<=max;i++) {
            let op = document.createElement("option");
            if(i<10) {
                op.setAttribute("value","0"+i);
            } else {
                op.setAttribute("value",i);
            }
            op.innerText = i;
            
            if(i == 1) {
                op.setAttribute("selected","selected");
            }
            

            FechaDia.appendChild(op);
        }
    }

    campoSelect.addEventListener('change', function() {
        botonSubmit.setAttribute("class","btn btn-secondary disabled");
        disponibilidad.innerHTML = '';
    });
    
    FechaMes.addEventListener('change', function() {
        let selected = FechaMes.options[FechaMes.selectedIndex].text;
        botonSubmit.setAttribute("class","btn btn-secondary disabled");
        disponibilidad.innerHTML = '';
        if(selected == "Feb") {
            cargarDiasMes(FechaDia, 28);
        } else if(["Jan","Mar","May","Jul","Aug","Oct","Dec"].indexOf(selected) !== -1) {
            cargarDiasMes(FechaDia, 31);
        } else {
            cargarDiasMes(FechaDia, 30);
        }
        comprobarTiempo();
    });

    FechaDia.addEventListener('change', function() {
        botonSubmit.setAttribute("class","btn btn-secondary disabled");
        disponibilidad.innerHTML = '';
        comprobarTiempo();
    });

    FechaAnyo.addEventListener('change', function() {
        botonSubmit.setAttribute("class","btn btn-secondary disabled");
        disponibilidad.innerHTML = '';
        comprobarTiempo();
    });

    horaSelect.addEventListener('change', function() {
        botonSubmit.setAttribute("class","btn btn-secondary disabled");
        disponibilidad.innerHTML = '';
        comprobarTiempo();
    });
    
    let months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
    let currentDate = new Date();
    let currentYear = currentDate.getFullYear();
    let currentDay = currentDate.getDate();
    let currentMonth = currentDate.getMonth();

    for (let i = 1; i < 13; i++) {
        let option = document.createElement("option");
        if(i<10) {
            option.setAttribute("value","0"+i);
        } else {
            option.setAttribute("value",i);
        }
        
        option.setAttribute("selected","selected");
        option.innerText = months[i-1];
        FechaMes.append(option);  
    }

    FechaMes.selectedIndex = currentMonth;

    for (let i = 1; i < 32; i++) {
        let option = document.createElement("option");
        if(i<10) {
            option.setAttribute("value","0"+i);
        } else {
            option.setAttribute("value",i);
        }
        option.setAttribute("selected","selected");
        option.innerText = i;
        FechaDia.append(option);  
    }

    FechaDia.selectedIndex = currentDay;
    
    for (let i = 0; i < 2; i++) {
        let option = document.createElement("option");
        option.setAttribute("value",currentYear+i);
        option.setAttribute("selected","selected");
        option.innerText = currentYear+i;
        FechaAnyo.append(option);  
    }

    FechaAnyo.selectedIndex = currentYear-currentYear;

    let horas = ["16:00:00","17:40:00","19:20:00"];
    for (let i = 0; i < 3; i++) {
        let option = document.createElement("option");
        option.setAttribute("value",horas[i]);
        option.setAttribute("selected","selected");
        option.innerText = horas[i];
        horaSelect.append(option);  
    }

    horaSelect.selectedIndex = 0;

    comprobarTiempo();
    

    function comprobarReserva(campo,fecha,hora) {
        disponibilidad.innerHTML = 
        '<div class="spinner-border text-secondary" role="status">'+
            '<span class="visually-hidden">Loading...</span>'+
        '</div>';
        fetch("http://127.0.0.1:8000/reservas/disponibilidad?campo="+campo+"&fecha="+fecha+"&hora="+hora)
        .then(response => response.json())
        .then(commits => {
            console.log(commits.ok);
            if(commits.ok == true) {
                disponibilidad.innerHTML = '<i class="bi bi-check h1 text-success"></i>';
                botonSubmit.setAttribute("class","btn btn-outline-success");
            } else if(commits.ok == "error"){
                disponibilidad.innerHTML = '<span class="text-danger">*Error del servidor</span>';
                botonSubmit.setAttribute("class","btn btn-secondary disabled");
            } else if(commits.ok == "not_allowed") {
                disponibilidad.innerHTML = '<span class="text-danger">*Solo se puede reservar de lunes a viernes.</span>';
                botonSubmit.setAttribute("class","btn btn-secondary disabled");
            }else if(commits.ok == "dennied") {
                disponibilidad.innerHTML = '<span class="text-danger">*Solo se pueden 3 reservas por semana.</span>';
                botonSubmit.setAttribute("class","btn btn-secondary disabled");
            } else {
                disponibilidad.innerHTML = '<i class="bi bi-x h1 text-danger"></i>';
                botonSubmit.setAttribute("class","btn btn-secondary disabled");
            }
        })
    }

    botonCheck.addEventListener("click",function() {
        let campo = campoSelect.options[campoSelect.selectedIndex].value;
        let fecha = FechaAnyo.options[FechaAnyo.selectedIndex].value + "-" + 
                    FechaMes.options[FechaMes.selectedIndex].value + "-" +
                    FechaDia.options[FechaDia.selectedIndex].value;
        let hora = horaSelect.options[horaSelect.selectedIndex].value;

        comprobarReserva(campo,fecha,hora);
    });

    // Ampliación del tiempo -----------------------------------------

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

    function comprobarTiempo() {

        let selectedMes = FechaMes.options[FechaMes.selectedIndex];
        let selectedDia = FechaDia.options[FechaDia.selectedIndex];
        let selectedAnyo = FechaAnyo.options[FechaAnyo.selectedIndex];

        let fecha = new Date(selectedAnyo.value+"-"+selectedMes.value+"-"+selectedDia.value);

        fechaSeleccionada.innerText = selectedDia.value + " " + selectedMes.text + " " + selectedAnyo.value;
        imgTiempo.innerHTML = 
        '<div class="spinner-border text-secondary" role="status" style="width: 120px; height:120px;">'+
            '<span class="visually-hidden">Loading...</span>'+
        '</div>';
        if(fechaValida(fecha)) {
            fetch('https://api.weatherbit.io/v2.0/forecast/daily?postal_code=46185&key=e53b832e64a347d3a9f2138657758b37&lang=es')
            .then(response => response.json())
            .then((response) => {
                let dia = (fecha.getTime()-current.getTime())/86400000;
                let datos = response.data[dia].weather;
                imgTiempo.innerHTML = '<img src="https://www.weatherbit.io/static/img/icons/' + datos.icon + '.png" alt="Imagen del tiempo">';
                textoTiempo.innerText = datos.description;
            });
        } else {
            imgTiempo.innerHTML = "";
            textoTiempo.innerText = "Sin datos sobre el tiempo...";
        }
    }

});