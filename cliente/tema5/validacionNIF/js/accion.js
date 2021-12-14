/**
 * La funcion validarNombre hace que si lo que se escribe en el 
 * apartado de nombre o de apellidos empieza por dos letras 
 * el recuadro se pone verde.
 */
function validarNombre(elemento){
    //La expresión Unicode: /^\[p{Letter}]{2}/u
    //es mejor para validar, pero aun no es 
    //compatible con todos los navegadores    
    if(/^[A-Za-zñÑçÇáéíóúüÁÉÍÓÚÜüÀÈÌÒÙàèìòù]{2}/
                            .test(elemento.value)){
        elemento.classList.add("verde");
    }
    else{
        elemento.classList.remove("verde");
    }
    comprobarTodoValido();
}
/**
 * La funcion validarEmail hace que si lo escrito en el apartado
 * de email es como minimo "A@a" el recuadro se pone verde. 
 */
function validarEmail(elemento){
    if(/.*[A-Za-z].*@.*[A-Za-z].*/.test(elemento.value)){
        elemento.classList.add("verde");
    }
    else{
        elemento.classList.remove("verde");
    }
    comprobarTodoValido();
}
/**
 * La funcion validarNIF comprueba que el nif esta bien escrito
 * mediante una peticion a una api. Si los datos devueltos y
 * pasados a JSON, el valor de error es 0 el
 * recuadro se pone verde.
 */
function validarNIF(elemento){
    //Preparación del parámetro
    let formData=new FormData();
    formData.append("nif",elemento.value);    
    
    fetch(`https://jorgesanchez.net/servicios/validarNIF.php`,{
        method:"POST",
        body:formData

    })
    .then(resp=>{
        return resp.json();
    })
    .then(datos=>{
        if(datos.error.codigo==0){
            elemento.classList.add("verde");
        }
        else{
            elemento.classList.remove("verde"); 
        }
        comprobarTodoValido();

    })
    .catch(error=>{
        document.getElementById("error").textContent=error;
        comprobarTodoValido();
    })
}

/**
 * Este metodo es llamado al final de todos los metodos
 * anteriores y comprueba que todos los recuadros de texto
 * esten en verde. En caso afirmativo hace que el boton de
 * enviar se active.
 */
function comprobarTodoValido(){
    if( 
        nombre.classList.contains("verde") && 
        apellidos.classList.contains("verde") && 
        email.classList.contains("verde") && 
        NIF.classList.contains("verde")
    ){
        //escribe aquí tus comentarios
        boton.disabled=false;        
    }
    else{
        boton.disabled=true; 
    }
}

//Se añaden los metodos a los nodos una vez se halla cargado el html
window.addEventListener("load",(ev)=>{
    var nombre=document.getElementById("nombre");
    var apellidos=document.getElementById("apellidos");
    var email=document.getElementById("email");
    var NIF=document.getElementById("NIF");
    var boton=document.getElementById("boton");  
    var telon=document.getElementById("telon");
    var mensaje=document.getElementById("mensaje"); 

    /**
     * Se añaden los metodos que hacen que cada vez que dejes de
     * presionar una tecla en el correspondiente recuadro de
     * texto, compruebe la validez de lo escrito.
     */
    nombre.addEventListener("keyup",(ev)=>{
        validarNombre(nombre);
    });
    apellidos.addEventListener("keyup",(ev)=>{
        validarNombre(apellidos);
    });
    email.addEventListener("keyup",(ev)=>{
        validarEmail(email);
    });
    NIF.addEventListener("keyup",(ev)=>{
        validarNIF(NIF);        
    });    

    /**
     * Se le añade al boton de enviar funcionalidad
     */
    boton.addEventListener("click",(ev)=>{
        ev.preventDefault(); //Se anula el comportamiento por defecto del boton
        //Se hace aparecer el mensaje de todo correcto
        telon.style.display="block";
        mensaje.style.display="block";
    });

    /**
     * Funcionalidades que hacen que si haces click en cualquier
     * parte del mensaje se recarga la pagina.
     */
    telon.addEventListener("click",(ev)=>{
        location="index.html";
    })
    mensaje.addEventListener("click",(ev)=>{
        location="index.html";
    })
});