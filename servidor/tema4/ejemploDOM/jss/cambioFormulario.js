window.addEventListener("load",function() {

    var contenedor = document.getElementById("div_form");
    var btnLogin = document.getElementById("btn_login");
    var btnRegister = document.getElementById("btn_register");

    function crearForm(e) {

        contenedor.removeChild(document.getElementById("form"));

        let div = e.target.value;
        let form = document.createElement("form");
        form.setAttribute("action","#");
        form.setAttribute("method","POST");
        form.setAttribute("id","form");
        let labelNom = document.createElement("label");
        labelNom.innerText = "Nombre: ";
        let inputNom = document.createElement("input");
        inputNom.setAttribute("type","text");
        inputNom.setAttribute("name","user");
        inputNom.setAttribute("id","usu");
        let labelContra = document.createElement("label");
        labelContra.innerText = "Contraseña: ";
        let inputContra = document.createElement("input");
        inputContra.setAttribute("type","password");
        inputContra.setAttribute("name","contrasenya");
        inputContra.setAttribute("id","contra");
        let btn = document.createElement("input");
        btn.setAttribute("type","submit");
        btn.setAttribute("name","submit");

        form.appendChild(labelNom);
        form.appendChild(inputNom);

        if(div == "register") {
            let labelMail = document.createElement("label");
            labelMail.innerText = "Correo: ";
            let inputMail = document.createElement("input");
            inputMail.setAttribute("type","email");
            inputMail.setAttribute("name","mail");
            inputMail.setAttribute("id","correo");
            form.appendChild(labelMail);
            form.appendChild(inputMail);
            btn.setAttribute("value","register");
        } else  {
            btn.setAttribute("value","login");
        }

        form.appendChild(labelContra);
        form.appendChild(inputContra);
        form.appendChild(btn);
        contenedor.appendChild(form);
    }

    btnLogin.addEventListener("click",crearForm);
    btnRegister.addEventListener("click",crearForm);
});