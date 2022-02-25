window.addEventListener("load", function(){

    var toast = document.getElementById("liveToast");

    function toastGone() {
        toast.style.display = "none";
    }

    if(toast != null) {
        this.setTimeout(toastGone,10000);

        document.getElementById("botonToast").addEventListener("click",function() {
            toastGone();
        });
    }

    function cargarFebrero(ligaFechaIniDia, max) {

        let seleccionado = ligaFechaIniDia.options[ligaFechaIniDia.selectedIndex].text;

        while(ligaFechaIniDia.firstElementChild) {
            ligaFechaIniDia.removeChild(ligaFechaIniDia.firstElementChild);
        }
        for(let i=1;i<=max;i++) {
            let op = document.createElement("option");
            op.setAttribute("value",i);
            op.innerText = i;
            
            if(seleccionado == i) {
                op.setAttribute("selected","selected");
            }
            if(i==28 && seleccionado > 28) {
                op.setAttribute("selected","selected");
            }

            ligaFechaIniDia.appendChild(op);
        }
    }

    var ligaFechaIniMes = document.getElementById('liga_fecha_inicio_date_month');
    if(ligaFechaIniMes != null) {
        let selected = ligaFechaIniMes.options[ligaFechaIniMes.selectedIndex].text;
        let ligaFechaIniDia = document.getElementById("liga_fecha_inicio_date_day");
        if(selected == "Feb") {
            cargarFebrero(ligaFechaIniDia, 28);
        } else if(["Jan","Mar","May","Jul","Aug","Oct","Dec"].indexOf(selected) !== -1) {
            cargarFebrero(ligaFechaIniDia, 31);
        } else {
            cargarFebrero(ligaFechaIniDia, 30);
        }
        
        ligaFechaIniMes.addEventListener('change', function() {
            let selected = ligaFechaIniMes.options[ligaFechaIniMes.selectedIndex].text;
            if(selected == "Feb") {
                cargarFebrero(ligaFechaIniDia, 28);
            } else if(["Jan","Mar","May","Jul","Aug","Oct","Dec"].indexOf(selected) !== -1) {
                cargarFebrero(ligaFechaIniDia, 31);
            } else {
                cargarFebrero(ligaFechaIniDia, 30);
            }
        })
    }
    

});