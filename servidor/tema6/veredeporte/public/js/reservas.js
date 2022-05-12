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
    });

    FechaDia.addEventListener('change', function() {
        botonSubmit.setAttribute("class","btn btn-secondary disabled");
        disponibilidad.innerHTML = '';
    });

    FechaAnyo.addEventListener('change', function() {
        botonSubmit.setAttribute("class","btn btn-secondary disabled");
        disponibilidad.innerHTML = '';
    });

    horaSelect.addEventListener('change', function() {
        botonSubmit.setAttribute("class","btn btn-secondary disabled");
        disponibilidad.innerHTML = '';
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

});