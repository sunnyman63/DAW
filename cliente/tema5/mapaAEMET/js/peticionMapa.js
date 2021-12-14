var headers = new Headers({
    "cache-control": "no-cache"
});
var conf={
    method: "GET",
    mode: "cors",
    headers: headers,
}

var hola = null;

async function pedirMapa(key,sitio) {
    try {
        const url = await fetch(
            "https://opendata.aemet.es/opendata/api/mapasygraficos/analisis?api_key="+key,
            conf
        );
        let datos = await url.json();
        const img = await fetch(
            datos.datos,
            conf
        );
        let imagen = document.createElement("img");
        const mapa = img.url;
        console.log(mapa);
        imagen.setAttribute("src",mapa);
        document.body.removeChild(sitio);
        document.body.appendChild(imagen);
    } catch(e) {
        console.log(e);
    }
}

window.addEventListener("load",()=>{
    
    var form = document.getElementById("form");
    var txtArea = document.getElementById("textarea");
    txtArea.value = "";
    var btn = document.getElementById("boton");
    
    btn.addEventListener("click",()=>{
        pedirMapa(txtArea.value,form);
    });
    //console.log(pedirMapa("eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJhbGVyb21waW4yQGFsdS5lZHUuZ3ZhLmVzIiwianRpIjoiNjIwMDQ3MjUtMGUyNS00MzU1LWExMzMtY2U4MGQ0ZjcyYTQ1IiwiaXNzIjoiQUVNRVQiLCJpYXQiOjE2Mzk0MjA2NzgsInVzZXJJZCI6IjYyMDA0NzI1LTBlMjUtNDM1NS1hMTMzLWNlODBkNGY3MmE0NSIsInJvbGUiOiIifQ.WZzIE4BfHvSYupetThD5SbavJ6FmfzU-RgCEWLcyA-o"));
});