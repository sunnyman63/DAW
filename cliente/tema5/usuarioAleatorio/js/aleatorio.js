window.addEventListener("load",()=>{

    var picture = document.getElementById("picture");
    var name = document.getElementById("name");
    var email = document.getElementById("email");
    var street = document.getElementById("street");
    var location = document.getElementById("location");
    var loading = document.getElementById("loading");

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
            //return datos.results[0].gender;
    
            picture.setAttribute("src",user.picture.large);

            name.innerText = user.name.first
                             +" "
                             +user.name.last;

            email.innerText = "Email: " + user.email;

            street.innerText = user.location.street.number
                               +" "
                               +user.location.street.name;

            location.innerText = user.location.city
                                 +" ("
                                 +user.location.state.toUpperCase()
                                 +" "
                                 +user.location.country.toUpperCase()
                                 +")";
            loading.style.display = "none";
        } catch(e) {
            console.log(e);
        }
    }

    pedirUser(conf);
});