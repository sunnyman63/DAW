var headers = new Headers({
    "cache-control": "no-cache"
});
var conf={
    method: "GET",
    mode: "cors",
    headers: headers,
}

async function pedirUser(config) {
    try {
        const url = await fetch(
            "https://randomuser.me/api",
            config
        );
        let datos = await url.json();
        let user = datos.results[0];

        return datos.results[0];

    } catch(e) {
        console.log(e);
    }
}

async function ponerNUsers(users,loading) {
    for(let i = 0;i<users.length-1;i++) {

        const user = await pedirUser(conf);
        let data = users[i].firstElementChild.children;

        data[0].setAttribute("src",user.picture.large);

        data[1].innerText = user.name.first
                            +" "
                            +user.name.last;

        data[2].innerText = "Email: " + user.email;

        data[3].innerText = user.location.street.number
                            +" "
                            +user.location.street.name;

        data[4].innerText = user.location.city
                            +" ("
                            +user.location.state.toUpperCase()
                            +" "
                            +user.location.country.toUpperCase()
                            +")";
    }
    loading.style.visibility = "hidden";
}

async function cambiarUser(data) {
    const user = await pedirUser(conf);
    data[0].setAttribute("src",user.picture.large);

    data[1].innerText = user.name.first
                        +" "
                        +user.name.last;

    data[2].innerText = "Email: " + user.email;

    data[3].innerText = user.location.street.number
                        +" "
                        +user.location.street.name;

    data[4].innerText = user.location.city
                        +" ("
                        +user.location.state.toUpperCase()
                        +" "
                        +user.location.country.toUpperCase()
                        +")";
}

window.addEventListener("load",()=>{

    var users = document.body.children;
    var loading = users[10];//Es el div de loading
    //console.log(users[10]);
    ponerNUsers(users,loading);

    document.getElementById("btn").addEventListener("click",function() {
        console.log("hola");
    });
    
});